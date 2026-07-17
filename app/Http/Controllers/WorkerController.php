<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkerApplication;
use App\Models\LaborRequest;
use App\Models\Notification;

class WorkerController extends Controller
    {
        public function dashboard()
        {
            $worker = auth()->user()->worker;
            $activeJobs = WorkerApplication::where('worker_id', $worker->id)
                ->where('status', 'accepted')
                ->count();
            $totalApplications = WorkerApplication::where('worker_id', $worker->id)->count();
            $completedJobs = WorkerApplication::where('worker_id', $worker->id)
                ->where('status', 'completed')
                ->count();
            $totalEarnings = WorkerApplication::where('worker_id', $worker->id)
                ->sum('agreed_wage');

            return view('worker.dashboard', compact('activeJobs', 'totalApplications', 'completedJobs', 'totalEarnings'));
        }

        public function availableJobs()
        {
            $jobs = LaborRequest::where('status', 'pending')
                ->orWhere('status', 'approved')
                ->paginate(10);
            return view('worker.available-jobs', compact('jobs'));
        }

        public function applyJob(Request $request)
        {
            $validated = $request->validate([
                'labor_request_id' => 'required|exists:labor_requests,id',
                'application_message' => 'nullable|string',
                'agreed_wage' => 'nullable|numeric',
            ]);

            $worker = auth()->user()->worker;
            $existingApplication = WorkerApplication::where('worker_id', $worker->id)
                ->where('labor_request_id', $validated['labor_request_id'])
                ->first();

            if ($existingApplication) {
                return back()->with('error', 'لقد قدمت بالفعل على هذا الطلب!');
            }

            WorkerApplication::create([
                'worker_id' => $worker->id,
                'labor_request_id' => $validated['labor_request_id'],
                'status' => 'pending',
                'application_message' => $validated['application_message'],
                'agreed_wage' => $validated['agreed_wage'],
            ]);

            return back()->with('success', 'تم تقديم طلبك بنجاح!');
        }

        public function myApplications()
        {
            $worker = auth()->user()->worker;
            $applications = WorkerApplication::where('worker_id', $worker->id)
                ->with('laborRequest')
                ->paginate(10);
            return view('worker.applications', compact('applications'));
        }

        public function profile()
        {
            $worker = auth()->user()->worker;
            return view('worker.profile', compact('worker'));
        }

        public function updateProfile(Request $request)
        {
            $validated = $request->validate([
                'national_id' => 'required|string',
                'skills' => 'nullable|string',
                'years_experience' => 'nullable|integer',
                'specialization' => 'nullable|string',
            ]);

            $worker = auth()->user()->worker;
            $worker->update($validated);

            return back()->with('success', 'تم تحديث الملف الشخصي بنجاح!');
        }

        public function notifications()
        {
            $notifications = Notification::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            return view('worker.notifications', compact('notifications'));
        }

        public function documents()
        {
            $documents = collect([
                [
                    'name' => 'بطاقة الهوية',
                    'icon' => '🪪',
                    'uploaded_at' => '2024-07-10',
                    'size_mb' => 2.5,
                    'status' => 'verified',
                    'status_label' => 'موثقة',
                    'status_icon' => '✓',
                ],
                [
                    'name' => 'رخصة العمل',
                    'icon' => '📋',
                    'uploaded_at' => '2024-07-08',
                    'size_mb' => 1.8,
                    'status' => 'pending',
                    'status_label' => 'قيد المراجعة',
                    'status_icon' => '⏳',
                ],
                [
                    'name' => 'شهادة التدريب',
                    'icon' => '🎓',
                    'uploaded_at' => '2024-07-05',
                    'size_mb' => 3.2,
                    'status' => 'rejected',
                    'status_label' => 'مرفوضة',
                    'status_icon' => '✗',
                ],
            ]);

            return view('worker.documents', compact('documents'));
        }
    }
