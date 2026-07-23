<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\LaborRequest;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
    {
        public function index()
        {
            $totalFarmers = Schema::hasTable('farmers') ? Farmer::count() : 0;
            $totalWorkers = Schema::hasTable('workers') ? Worker::count() : 0;
            $services = Schema::hasTable('services')
                ? Service::where('is_active', true)->orderBy('sort_order')->get()
                : collect();

            return view('home', compact('totalFarmers', 'totalWorkers', 'services'));
        }

        public function about()
        {
            $totalFarmers = Schema::hasTable('farmers') ? Farmer::count() : 0;
            $totalWorkers = Schema::hasTable('workers') ? Worker::count() : 0;
            $totalServices = Schema::hasTable('services') ? Service::where('is_active', true)->count() : 0;
            $completedRequests = Schema::hasTable('labor_requests') ? LaborRequest::where('status', 'completed')->count() : 0;

            return view('pages.about', compact('totalFarmers', 'totalWorkers', 'totalServices', 'completedRequests'));
        }

        public function services()
        {
            $totalServices = Schema::hasTable('services') ? Service::where('is_active', true)->count() : 0;
            $totalWorkers = Schema::hasTable('workers') ? Worker::count() : 0;

            return view('pages.services', compact('totalServices', 'totalWorkers'));
        }

        public function contact()
        {
            return view('pages.contact');
        }

        public function requestLabor()
        {
            return view('pages.request-labor');
        }

        public function registerWorker()
        {
            return view('pages.register-worker');
        }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1200',
        ],[
            'phone.regex' => 'يرجى إدخال رقم هاتف صحيح',
        ]);

        Log::info('Contact message received', array_merge($validated, ['ip' => request()->ip()]));

        return back()->with('success', 'تم إرسال رسالتك بنجاح. سنعود إليك قريباً.');
    }

    }