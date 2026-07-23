@extends('layouts.app')

@section('title', 'إيصال الدفع - قطاف القصيم')

@section('styles')
<style>
    .receipt-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .receipt-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .receipt-header h1 {
        color: var(--primary-green);
        font-size: 24px;
        margin-bottom: 10px;
    }

    .receipt-status {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: 600;
        margin-top: 10px;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-failed {
        background-color: #f8d7da;
        color: #721c24;
    }

    .receipt-section {
        margin-bottom: 30px;
    }

    .receipt-section h3 {
        color: var(--primary-green);
        font-size: 16px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .receipt-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 12px;
    }

    .receipt-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .receipt-label {
        color: var(--light-text);
        font-weight: 600;
    }

    .receipt-value {
        color: var(--dark-text);
        font-weight: 600;
    }

    .receipt-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding: 20px;
        background-color: #f9f7f4;
        border-radius: 5px;
        font-size: 18px;
    }

    .receipt-total .value {
        color: var(--primary-green);
        font-weight: 700;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .action-btn {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s;
    }

    .action-btn-print {
        background-color: var(--primary-green);
        color: white;
    }

    .action-btn-print:hover {
        background-color: goldenrod;
    }

    .action-btn-back {
        background-color: transparent;
        color: var(--primary-green);
        border: 2px solid var(--primary-green);
    }

    .action-btn-back:hover {
        background-color: var(--primary-green);
        color: white;
    }

    @media print {
        body {
            background-color: white;
        }

        .action-buttons {
            display: none;
        }

        .receipt-container {
            box-shadow: none;
            margin: 0;
            padding: 0;
        }
    }

    @media (max-width: 768px) {
        .receipt-container {
            margin: 20px;
            padding: 20px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="receipt-container">
    <div class="receipt-header">
        <h1>إيصال الدفع</h1>
        <p style="color: var(--light-text);">رقم الإيصال: #{{ $payment->id }}</p>
        <span class="receipt-status status-{{ $payment->status }}">
            @if ($payment->status === 'completed')
                مكتمل ✓
            @elseif ($payment->status === 'pending')
                قيد الانتظار
            @else
                فشل
            @endif
        </span>
    </div>

    <div class="receipt-section">
        <h3>معلومات الطلب</h3>
        <div class="receipt-item">
            <span class="receipt-label">رقم الطلب</span>
            <span class="receipt-value">#{{ $payment->laborRequest->id }}</span>
        </div>
        <div class="receipt-item">
            <span class="receipt-label">نوع الخدمة</span>
            <span class="receipt-value">{{ $payment->laborRequest->service_type }}</span>
        </div>
        <div class="receipt-item">
            <span class="receipt-label">عدد العمال</span>
            <span class="receipt-value">{{ $payment->laborRequest->number_of_workers }}</span>
        </div>
        <div class="receipt-item">
            <span class="receipt-label">الأجر اليومي</span>
            <span class="receipt-value">{{ $payment->laborRequest->daily_wage }} ر.س</span>
        </div>
    </div>

    <div class="receipt-section">
        <h3>معلومات الدفع</h3>
        <div class="receipt-item">
            <span class="receipt-label">طريقة الدفع</span>
            <span class="receipt-value">
                @if ($payment->payment_method === 'credit_card')
                    بطاقة ائتمان
                @elseif ($payment->payment_method === 'debit_card')
                    بطاقة خصم
                @elseif ($payment->payment_method === 'apple_pay')
                    Apple Pay
                @elseif ($payment->payment_method === 'google_pay')
                    Google Pay
                @else
                    {{ $payment->payment_method }}
                @endif
            </span>
        </div>
        <div class="receipt-item">
            <span class="receipt-label">رقم المعاملة</span>
            <span class="receipt-value">{{ $payment->transaction_reference ?? $payment->transaction_id ?? '-' }}</span>
        </div>
        <div class="receipt-item">
            <span class="receipt-label">تاريخ الدفع</span>
            <span class="receipt-value">{{ $payment->created_at->format('Y-m-d H:i') }}</span>
        </div>
        <div class="receipt-item">
            <span class="receipt-label">العملة</span>
            <span class="receipt-value">{{ $payment->currency }}</span>
        </div>
    </div>

    <div class="receipt-total">
        <span class="receipt-label">المبلغ الإجمالي</span>
        <span class="value">{{ number_format($payment->amount, 2) }} ر.س</span>
    </div>

    <div class="action-buttons">
        <button onclick="window.print()" class="action-btn action-btn-print">
            <i class="fas fa-print"></i> طباعة الإيصال
        </button>
        <a href="{{ route('payment.history') }}" class="action-btn action-btn-back">
            ← العودة إلى السجل
        </a>
    </div>
</div>
@endsection
