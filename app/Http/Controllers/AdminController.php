<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Worker;
use App\Models\LaborRequest;
use App\Models\Service;

class AdminController extends Controller
    {
        public function dashboard()
        {
            $totalUsers = User::count();
            $totalFarmers = Farmer::count();
            $totalWorkers = Worker::count();
            $totalRequests = LaborRequest::count();
            $pendingWorkers = Worker::where('status', 'pending')->count();
            $completedRequests = LaborRequest::where('status', 'completed')->count();
            $totalEarnings = LaborRequest::sum('daily_wage');
            $recentRequests = LaborRequest::with('farmer.user')->latest()->take(5)->get();

            return view('admin.dashboard', compact('totalUsers', 'totalFarmers', 'totalWorkers', 'totalRequests', 'pendingWorkers', 'completedRequests', 'totalEarnings', 'recentRequests'));
        }

        public function farmers()
        {
            $farmers = Farmer::with('user')->paginate(15);
            return view('admin.farmers', compact('farmers'));
        }

        public function workers()
        {
            $workers = Worker::with('user')->paginate(15);
            return view('admin.workers', compact('workers'));
        }

        public function approveWorker($id)
        {
            $worker = Worker::findOrFail($id);
            $worker->update(['status' => 'approved']);
            return back()->with('success', 'تم موافقة العامل بنجاح!');
        }

        public function rejectWorker($id)
        {
            $worker = Worker::findOrFail($id);
            $worker->update(['status' => 'rejected']);
            return back()->with('success', 'تم رفض العامل!');
        }

        public function requests()
        {
            $requests = LaborRequest::with('farmer')->paginate(15);
            return view('admin.requests', compact('requests'));
        }

        public function services()
        {
            $services = Service::paginate(15);
            return view('admin.services', compact('services'));
        }

        public function toggleServiceStatus($id)
        {
            $service = Service::findOrFail($id);
            $service->update(['is_active' => ! $service->is_active]);

            return back()->with('success', $service->is_active ? 'تم تفعيل الخدمة بنجاح' : 'تم إلغاء تفعيل الخدمة');
        }

        public function reports()
        {
            $totalEarnings = LaborRequest::sum('daily_wage');
            $totalRequests = LaborRequest::count();
            $completedRequests = LaborRequest::where('status', 'completed')->count();
            $pendingRequests = LaborRequest::where('status', 'pending')->count();
            $totalWorkers = Worker::count();
            $approvedWorkers = Worker::where('status', 'approved')->count();

            return view('admin.reports', compact('totalEarnings', 'totalRequests', 'completedRequests', 'pendingRequests', 'totalWorkers', 'approvedWorkers'));
        }

        public function updateRequestStatus(Request $request, $id)
        {
            $requestData = LaborRequest::findOrFail($id);
            $requestData->update(['status' => $request->status]);

            return back()->with('success', 'تم تحديث حالة الطلب بنجاح');
        }

        public function activityLog()
        {
            $activities = collect([
                [
                    'user' => 'أحمد السويلم',
                    'type' => 'إنشاء',
                    'badge_class' => 'bg-success-subtle text-success',
                    'description' => 'تم إنشاء طلب عمالة جديد',
                    'time' => now()->subHours(2)->format('Y-m-d H:i'),
                ],
                [
                    'user' => 'فاطمة الدوسري',
                    'type' => 'تحديث',
                    'badge_class' => 'bg-info-subtle text-info',
                    'description' => 'تم تحديث بيانات عامل',
                    'time' => now()->subHours(5)->format('Y-m-d H:i'),
                ],
                [
                    'user' => 'محمد القحطاني',
                    'type' => 'تسجيل دخول',
                    'badge_class' => 'bg-primary-subtle text-primary',
                    'description' => 'تسجيل دخول إلى النظام',
                    'time' => now()->subHours(7)->format('Y-m-d H:i'),
                ],
            ]);

            return view('admin.activity-log', compact('activities'));
        }
    }
