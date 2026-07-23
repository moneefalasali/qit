<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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
            $unreadNotifications = Notification::where('user_id', auth()->id())
                ->whereNull('read_at')
                ->count();

            return view('worker.dashboard', compact('activeJobs', 'totalApplications', 'completedJobs', 'totalEarnings', 'unreadNotifications'));
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
                'application_message' => 'nullable|string|max:1000',
                'agreed_wage' => 'nullable|numeric|min:0',
            ]);

            $validated['application_message'] = $validated['application_message'] ?? null;
            $validated['agreed_wage'] = $validated['agreed_wage'] ?? null;

            $worker = auth()->user()->worker;
            $existingApplication = WorkerApplication::where('worker_id', $worker->id)
                ->where('labor_request_id', $validated['labor_request_id'])
                ->first();

            if ($existingApplication) {
                return back()->with('error', 'لقد قدمت بالفعل على هذا الطلب!');
            }

            $laborRequest = LaborRequest::findOrFail($validated['labor_request_id']);
            if (! in_array($laborRequest->status, ['pending', 'approved'])) {
                return back()->with('error', 'لا يمكن التقدم لهذا الطلب في الوقت الحالي.');
            }

            WorkerApplication::create([
                'worker_id' => $worker->id,
                'labor_request_id' => $validated['labor_request_id'],
                'status' => 'pending',
                'application_message' => $validated['application_message'],
                'agreed_wage' => $validated['agreed_wage'],
            ]);

            Notification::create([
                'user_id' => auth()->id(),
                'title' => 'تم تقديم الطلب',
                'message' => 'تم تقديم طلبك بنجاح وسيتم مراجعته قريباً.',
                'type' => 'application_submitted',
                'related_model' => 'WorkerApplication',
                'related_id' => null,
                'is_read' => false,
            ]);

            return back()->with('success', 'تم تقديم طلبك بنجاح!');
        }

        public function updateProfile(Request $request)
        {
            $worker = auth()->user()->worker;

            $validated = $request->validate([
                'national_id' => ['required', 'string', Rule::unique('workers', 'national_id')->ignore($worker->id)],
                'skills' => 'nullable|string|max:1000',
                'years_experience' => 'nullable|integer|min:0|max:100',
                'specialization' => 'nullable|string|max:255',
            ]);

            $worker->update($validated);

            return back()->with('success', 'تم تحديث الملف الشخصي بنجاح!');
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

        public function notifications()
        {
            $notifications = Notification::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            return view('worker.notifications', compact('notifications'));
        }

        public function documents()
        {
            $worker = auth()->user()->worker;

            $documents = collect([]);

            if ($worker->document_path) {
                $documents->push([
                    'name' => 'وثيقة العمل',
                    'icon' => '📄',
                    'uploaded_at' => $worker->updated_at?->format('Y-m-d') ?? now()->format('Y-m-d'),
                    'size_mb' => $this->getDocumentSizeInMb($worker->document_path),
                    'status' => 'pending',
                    'status_label' => 'قيد المراجعة',
                    'status_icon' => '⏳',
                    'path' => $worker->document_path,
                ]);
            }

            return view('worker.documents', compact('documents', 'worker'));
        }

        private function getDocumentSizeInMb(?string $path): float
        {
            if (! $path) {
                return 0;
            }

            $fullPath = storage_path('app/public/' . $path);

            if (! file_exists($fullPath)) {
                return 0;
            }

            return round(filesize($fullPath) / 1024 / 1024, 1);
        }

        public function uploadDocument(Request $request)
        {
            $validated = $request->validate([
                'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'document_type' => 'required|in:id,license,certificate,medical,other',
            ]);

            $worker = auth()->user()->worker;
            $file = $request->file('document');
            $path = $file->storeAs(
                'worker_documents',
                'worker_' . $worker->id . '_' . time() . '.' . $file->extension(),
                'public'
            );

            if ($worker->document_path && Storage::disk('public')->exists($worker->document_path)) {
                Storage::disk('public')->delete($worker->document_path);
            }

            $worker->update(['document_path' => $path]);

            return back()->with('success', 'تم رفع الوثيقة بنجاح وسيتم مراجعتها قريباً.');
        }

        public function deleteDocument(Request $request)
        {
            $request->validate([
                'delete_document' => 'required|in:1',
            ]);

            $worker = auth()->user()->worker;

            if ($worker->document_path && Storage::disk('public')->exists($worker->document_path)) {
                Storage::disk('public')->delete($worker->document_path);
            }

            $worker->update(['document_path' => null]);

            return back()->with('success', 'تم حذف الوثيقة بنجاح.');
        }

        public function downloadDocument()
        {
            $worker = auth()->user()->worker;

            if (! $worker->document_path || ! Storage::disk('public')->exists($worker->document_path)) {
                return back()->with('error', 'لا توجد وثيقة جاهزة للتحميل.');
            }

            return Storage::disk('public')->download($worker->document_path);
        }
    }
