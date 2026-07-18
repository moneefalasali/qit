<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\LaborRequest;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
    {
        public function index()
        {
            $totalFarmers = Farmer::count();
            $totalWorkers = Worker::count();
            $services = Service::where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            return view('home', compact('totalFarmers', 'totalWorkers', 'services'));
        }

        public function about()
        {
            $totalFarmers = Farmer::count();
            $totalWorkers = Worker::count();
            $totalServices = Service::where('is_active', true)->count();
            $completedRequests = LaborRequest::where('status', 'completed')->count();

            return view('pages.about', compact('totalFarmers', 'totalWorkers', 'totalServices', 'completedRequests'));
        }

        public function services()
        {
            $totalServices = Service::where('is_active', true)->count();
            $totalWorkers = Worker::count();

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

        public function notFound()
        {
            return view('pages.404');
        }
    }
