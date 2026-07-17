<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
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
            return view('pages.about');
        }

        public function services()
        {
            return view('pages.services');
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
