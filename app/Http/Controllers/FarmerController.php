<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaborRequest;
use App\Models\WorkerApplication;
use App\Models\Notification;

class FarmerController extends Controller
    {
        public function dashboard()
        {
            $farmer = auth()->user()->farmer;
            $activeRequests = LaborRequest::where('farmer_id', $farmer->id)
                ->whereIn('status', ['approved', 'in_progress'])
                ->count();
            $totalRequests = LaborRequest::where('farmer_id', $farmer->id)->count();
            $completedRequests = LaborRequest::where('farmer_id', $farmer->id)
                ->where('status', 'completed')
                ->count();
            $totalSpent = LaborRequest::where('farmer_id', $farmer->id)
                ->sum('daily_wage');
            $activeWorkers = LaborRequest::where('farmer_id', $farmer->id)
                ->whereIn('status', ['approved', 'in_progress'])
                ->sum('number_of_workers');
            $recentRequests = LaborRequest::where('farmer_id', $farmer->id)
                ->orderByDesc('created_at')
                ->take(4)
                ->get();

            return view('farmer.dashboard', compact('activeRequests', 'totalRequests', 'completedRequests', 'totalSpent', 'activeWorkers', 'recentRequests'));
        }

        public function myRequests()
        {
            $farmer = auth()->user()->farmer;
            $requests = LaborRequest::where('farmer_id', $farmer->id)->paginate(10);
            return view('farmer.requests', compact('requests'));
        }

        public function workers()
        {
            $farmer = auth()->user()->farmer;
            $workers = WorkerApplication::whereHas('laborRequest', function ($query) use ($farmer) {
                    $query->where('farmer_id', $farmer->id);
                })
                ->whereIn('status', ['accepted', 'completed'])
                ->with(['worker.user', 'laborRequest'])
                ->latest()
                ->paginate(12);

            return view('farmer.workers', compact('workers'));
        }

        public function createRequest()
        {
            return view('farmer.create-request');
        }

        public function storeRequest(Request $request)
        {
            $validated = $request->validate([
                'service_type' => 'required|string',
                'number_of_workers' => 'required|integer|min:1',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'nullable|date|after:start_date',
                'description' => 'nullable|string|max:1000',
                'daily_wage' => 'required|numeric|min:0',
            ], [
                'start_date.after_or_equal' => 'لا يمكن اختيار تاريخ سابق على اليوم.',
                'end_date.after' => 'يجب أن يكون تاريخ النهاية بعد تاريخ البداية.',
            ]);

            $farmer = auth()->user()->farmer;
            $laborRequest = LaborRequest::create([
                'farmer_id' => $farmer->id,
                'service_type' => $validated['service_type'],
                'number_of_workers' => $validated['number_of_workers'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'description' => $validated['description'],
                'daily_wage' => $validated['daily_wage'],
                'status' => 'pending',
            ]);

            return redirect()->route('farmer.request.confirmation', $laborRequest->id)
                ->with('success', 'تم إرسال طلبك بنجاح، وسيتم مراجعته قريباً.');
        }

        public function confirmation($id)
        {
            $laborRequest = LaborRequest::where('id', $id)
                ->where('farmer_id', auth()->user()->farmer->id)
                ->firstOrFail();

            return view('farmer.request-confirmation', compact('laborRequest'));
        }

        public function showRequest($id)
        {
            $laborRequest = LaborRequest::where('id', $id)
                ->where('farmer_id', auth()->user()->farmer->id)
                ->firstOrFail();

            $applications = WorkerApplication::where('labor_request_id', $id)
                ->with('worker.user')
                ->paginate(10);

            return view('farmer.show-request', compact('laborRequest', 'applications'));
        }

        public function profile()
        {
            $farmer = auth()->user()->farmer;
            return view('farmer.profile', compact('farmer'));
        }

        public function updateProfile(Request $request)
        {
            $validated = $request->validate([
                'farm_name' => 'required|string',
                'farm_description' => 'nullable|string',
                'farm_location' => 'required|string',
                'farm_area' => 'nullable|numeric',
                'farm_type' => 'nullable|string',
            ]);

            $farmer = auth()->user()->farmer;
            $farmer->update($validated);

            return back()->with('success', 'تم تحديث الملف الشخصي بنجاح!');
        }

        public function notifications()
        {
            $notifications = Notification::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            return view('farmer.notifications', compact('notifications'));
        }

        public function settings()
        {
            return view('farmer.settings');
        }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:ar,en,hi,ur,bn,fa-AF,ps',
            'timezone' => 'required|in:Asia/Riyadh,UTC',
        ]);

        session(['user_settings' => $validated]);

        return back()->with('success', 'تم حفظ تفضيلات الإعدادات بنجاح.');
    }
    }