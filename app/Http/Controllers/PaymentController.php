<?php

namespace App\Http\Controllers;

use App\Models\LaborRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private $payTabsApiUrl = 'https://secure-sa.paytabs.com/payment/request';
    private $payTabsServerKey;
    private $payTabsClientKey;

    public function __construct()
    {
        $this->payTabsServerKey = env('PAYTABS_SERVER_KEY', '');
        $this->payTabsClientKey = env('PAYTABS_CLIENT_KEY', '');
    }

    /**
     * Show payment form for labor request
     */
    public function showPaymentForm($requestId)
    {
        $laborRequest = LaborRequest::findOrFail($requestId);

        if ($laborRequest->farmer->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بالوصول إلى هذا الطلب');
        }

        $amount = abs($this->calculateRequestAmount($laborRequest));
        $commissionRate = 0.065;
        $commissionAmount = round($amount * $commissionRate, 2);
        $finalAmount = round($amount + $commissionAmount, 2);

        return view('payment.form', compact('laborRequest', 'amount', 'commissionAmount', 'finalAmount', 'commissionRate'));
    }

    /**
     * Process payment with PayTabs
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'labor_request_id' => 'required|exists:labor_requests,id',
            'payment_method' => 'required|in:credit_card,debit_card,apple_pay,google_pay',
            'agree_terms' => 'accepted',
        ],[
            'agree_terms.accepted' => 'يجب الموافقة على شروط الدفع وسياسة الخصوصية قبل المتابعة.',
        ]);

        $laborRequest = LaborRequest::findOrFail($request->labor_request_id);

        if ($laborRequest->farmer->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بالوصول إلى هذا الطلب');
        }

        $amount = abs($this->calculateRequestAmount($laborRequest));
        $commissionRate = 0.065;
        $commissionAmount = round($amount * $commissionRate, 2);
        $finalAmount = round($amount + $commissionAmount, 2);

        $payment = Payment::create([
            'labor_request_id' => $laborRequest->id,
            'user_id' => auth()->id(),
            'amount' => $finalAmount,
            'currency' => 'SAR',
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        $payTabsConfigured = !empty(env('PAYTABS_PROFILE_ID')) && !empty($this->payTabsServerKey) && !empty($this->payTabsClientKey);

        if (! $payTabsConfigured) {
            $payment->update([
                'status' => 'pending',
                'response_data' => json_encode([
                    'message' => 'لم يتم تهيئة بيانات PayTabs بعد. يرجى إدخال مفاتيح الدفع الفعلية في ملف البيئة.',
                    'payment_method' => $request->payment_method,
                ]),
            ]);

            return view('payment.form', compact('laborRequest', 'amount', 'commissionAmount', 'finalAmount', 'commissionRate'))
                ->with('payment_error', 'لم يتم تهيئة بوابة الدفع بعد. أضف بيانات PayTabs في ملف .env للمتابعة إلى دفع حقيقي.')
                ->with('selected_method', $request->payment_method);
        }

        $paymentData = [
            'profile_id' => (int)env('PAYTABS_PROFILE_ID'),
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => 'payment_' . $payment->id,
            'cart_currency' => 'SAR',
            'cart_amount' => (float)$finalAmount,
            'cart_description' => 'طلب عمالة: ' . $laborRequest->service_type,
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
            ],
            'order_details' => [
                'order_reference' => 'order_' . $laborRequest->id,
                'order_description' => 'طلب عمالة: ' . $laborRequest->service_type,
            ],
            'return_url' => route('payment.callback'),
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->payTabsServerKey,
                'Content-Type' => 'application/json',
            ])->post($this->payTabsApiUrl, $paymentData);

            if ($response->successful()) {
                $responseData = $response->json();

                $payment->update([
                    'transaction_id' => $responseData['tran_ref'] ?? null,
                    'payment_url' => $responseData['redirect_url'] ?? null,
                    'response_data' => json_encode($responseData),
                ]);

                if (isset($responseData['redirect_url'])) {
                    return redirect($responseData['redirect_url']);
                }

                return redirect()->back()->with('error', 'فشل في الحصول على رابط الدفع');
            }

            $payment->update(['status' => 'failed']);
            return redirect()->back()->with('error', 'فشل في معالجة الدفع');
        } catch (\Exception $e) {
            \Log::error('Payment processing error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'labor_request_id' => $laborRequest->id,
                'exception' => $e
            ]);
            $payment->update(['status' => 'failed']);
            return redirect()->back()->with('error', 'عذراً، حدث خطأ أثناء معالجة عملية الدفع. يرجى المحاولة مرة أخرى لاحقاً.');
        }
    }

    /**
     * Handle PayTabs callback
     */
    public function handleCallback(Request $request)
    {
        // PayTabs returns data in POST for return_url, but we should also check the transaction reference
        $tranRef = $request->input('tran_ref');
        $cartId = $request->input('cart_id');

        if (!$cartId || !str_starts_with($cartId, 'payment_')) {
            return redirect('/')->with('error', 'معرف الدفع غير صحيح');
        }

        $paymentId = str_replace('payment_', '', $cartId);
        $payment = Payment::findOrFail($paymentId);

        try {
            // Verify the transaction status
            $verifyUrl = 'https://secure-sa.paytabs.com/payment/query';
            $response = Http::withHeaders([
                'Authorization' => $this->payTabsServerKey,
                'Content-Type' => 'application/json',
            ])->post($verifyUrl, [
                'profile_id' => (int)env('PAYTABS_PROFILE_ID'),
                'tran_ref' => $tranRef ?? $payment->transaction_id,
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                if (isset($responseData['payment_result']['response_status']) && $responseData['payment_result']['response_status'] === 'A') {
                    $payment->update([
                        'status' => 'completed',
                        'transaction_reference' => $responseData['tran_ref'] ?? null,
                        'response_data' => json_encode($responseData),
                    ]);

                    $payment->laborRequest->update(['status' => 'in_progress']);

                    if (method_exists($payment->laborRequest, 'notifications')) {
                        $payment->laborRequest->notifications()->create([
                            'user_id' => auth()->id(),
                            'title' => 'تمت معالجة الدفع',
                            'message' => 'تمت عملية الدفع بنجاح وسيبدأ التنفيذ قريباً.',
                            'is_read' => false,
                        ]);
                    }

                    return redirect()->route('farmer.requests')->with('success', 'تم الدفع بنجاح!');
                } else {
                    $payment->update([
                        'status' => 'failed',
                        'response_data' => json_encode($responseData),
                    ]);
                    return redirect()->route('farmer.requests')->with('error', 'فشل الدفع: ' . ($responseData['payment_result']['response_message'] ?? 'غير معروف'));
                }
            }

            return redirect()->route('farmer.requests')->with('error', 'فشل التحقق من الدفع');
        } catch (\Exception $e) {
            \Log::error('Payment callback error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'exception' => $e
            ]);
            return redirect()->route('farmer.requests')->with('error', 'عذراً، حدث خطأ أثناء التحقق من عملية الدفع. يرجى التواصل مع الدعم الفني.');
        }
    }

    /**
     * Calculate total amount for labor request
     */
    private function calculateRequestAmount($laborRequest)
    {
        $days = $laborRequest->end_date
            ? $laborRequest->end_date->diffInDays($laborRequest->start_date) + 1
            : 1;

        return abs($laborRequest->daily_wage * $laborRequest->number_of_workers * $days);
    }

    /**
     * Show payment history
     */
    public function history()
    {
        $payments = Payment::where('user_id', auth()->id())
            ->with('laborRequest')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('payment.history', compact('payments'));
    }

    /**
     * Show payment receipt
     */
    public function receipt($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        if ($payment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بعرض هذا الإيصال');
        }

        return view('payment.receipt', compact('payment'));
    }
}
