@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden py-4" style="background: url('/images/images.jpg') center/cover no-repeat; background-position: center 35%; min-height: 300px;">
    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="container position-relative py-4">
        <div class="row align-items-center">
            <div class="col-lg-7 ms-auto text-end">
                <div class="hero-card p-3 p-lg-4 rounded-4 shadow-lg" style="background: rgba(255,255,255,0.88); backdrop-filter: blur(2px); border: 1px solid rgba(245, 243, 240, 0.8);">
                    <h1 class="display-6 fw-bold mb-2" style="color: #5e3d03;">{{ __('messages.app_name') }}</h1>
                    <h2 class="fs-5 fw-bold mb-3" style="color: #284915;">{{ __('messages.welcome') }}</h2>
                    <p class="mb-3 text-dark">{{ __('messages.about_text') }}</p>
                    <div class="d-flex gap-2 justify-content-end flex-wrap">
                        <a href="{{ route('request-labor') }}" class="btn btn-primary-qitaf btn-sm px-3 py-2">
                            <i class="fas fa-users ms-2"></i> {{ __('messages.request_labor') }}
                        </a>
                        <a href="{{ route('register-worker') }}" class="btn btn-sm px-3 py-2" style="background-color: #d4c5b0; color: #2d5a27; border: none; font-weight: 600;">
                            <i class="fas fa-user-plus ms-2"></i> {{ __('messages.register_worker') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-4 bg-white shadow-sm">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color: #2d5a27;">
                <span style="color: #d4c5b0;">←</span> {{ __('messages.why_choose_us') }} <span style="color: #d4c5b0;">→</span>
            </h3>
        </div>
        <div class="row g-4 text-center">
            @php
                $features = [
                    ['icon' => 'fas fa-check-circle', 'title' => 'موثوقية عالية', 'text' => 'منصة معتمدة وآمنة'],
                    ['icon' => 'fas fa-leaf', 'title' => 'جودة وكفاءة', 'text' => 'نضمن أفضل جودة في العمل'],
                    ['icon' => 'fas fa-certificate', 'title' => 'عمالة معتمدة', 'text' => 'عمالة مدربة وموثوقة'],
                    ['icon' => 'fas fa-mobile-alt', 'title' => 'سهولة الاستخدام', 'text' => 'منصة ذكية وسهلة الاستخدام'],
                    ['icon' => 'fas fa-headset', 'title' => 'دعم مستمر', 'text' => 'فريق دعم جاهز لخدمتكم'],
                ];
            @endphp
            @foreach ($features as $feature)
                <div class="col-md-2-4 col-sm-6">
                    <div class="feature-card p-3 h-100 rounded-4">
                        <div class="mb-2 text-success fs-4"><i class="{{ $feature['icon'] }}"></i></div>
                        <h6 class="fw-bold">{{ $feature['title'] }}</h6>
                        <p class="small text-muted mb-0">{{ $feature['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-4" style="background: linear-gradient(180deg, #f9f7f4 0%, #ffffff 100%);">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color: #2d5a27;">{{ __('messages.our_services') }}</h3>
        </div>
        <div class="row g-4">
            @php
                $serviceImages = [
                    'حصاد المزروعات' => '/images/date-harvest-1.jpg',
                    'ري المزروعات' => '/images/palm-grove.jpg',
                    'تنظيف الأرض' => '/images/palm-tree-farm.jpg',
                    'رش المبيدات' => '/images/date-palm-plantation.jpg',
                    'نقل المنتجات' => '/images/date-harvest-machine.jpg',
                    'العناية بالحيوانات' => '/images/farm-workers.jpg',
                ];
            @endphp
            @foreach ($services as $service)
                @php
                    $serviceImage = $service->image
                        ? asset('storage/' . $service->image)
                        : ($serviceImages[$service->name] ?? '/images/default-service.jpg');
                @endphp
                <div class="col-lg-2-4 col-md-4 col-sm-6">
                    <div class="service-card h-100 rounded-4 overflow-hidden border-0 shadow-sm">
                        <img src="{{ $serviceImage }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $service->name }}">
                        <div class="card-body p-3 text-center">
                            <div class="mb-2 text-success fs-4"><i class="{{ $service->icon ?: 'fas fa-tools' }}"></i></div>
                            <h6 class="fw-bold" style="color: #2d5a27;">{{ $service->name }}</h6>
                            <p class="small text-muted mb-0">{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Section -->

<!-- Stats Section -->
<section class="py-4 bg-white border-top">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="stat-box rounded-4 p-4 h-100">
                    <div class="d-flex align-items-center justify-content-center gap-4">
                        <div>
                            <h2 class="fw-bold display-5 mb-0" style="color: #2d5a27;">{{ $totalWorkers }}+</h2>
                            <p class="text-muted mb-0">{{ __('messages.trusted_by') }}</p>
                        </div>
                        <div class="fs-3 text-secondary"><i class="fas fa-user-check"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-box rounded-4 p-4 h-100">
                    <div class="d-flex align-items-center justify-content-center gap-4">
                        <div>
                            <h2 class="fw-bold display-5 mb-0" style="color: #2d5a27;">{{ $totalFarmers }}+</h2>
                            <p class="text-muted mb-0">{{ __('messages.about') }}</p>
                        </div>
                        <div class="fs-3 text-secondary"><i class="fas fa-tractor"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .col-md-2-4 {
        flex: 0 0 auto;
        width: 20%;
    }
    @media (max-width: 991px) {
        .col-md-2-4 {
            width: 33.33%;
        }
    }
    @media (max-width: 767px) {
        .col-md-2-4 {
            width: 50%;
        }
    }
    .col-lg-2-4 {
        flex: 0 0 auto;
        width: 20%;
    }
    @media (max-width: 1199px) {
        .col-lg-2-4 {
            width: 33.33%;
        }
    }
    @media (max-width: 767px) {
        .col-lg-2-4 {
            width: 50%;
        }
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.12) 35%, rgba(255,255,255,0.28) 65%, rgba(255,255,255,0.45) 100%);
        pointer-events: none;
        z-index: 0;
    }
    .feature-card {
        background: linear-gradient(145deg, #ffffff, #f7f3eb);
        border: 1px solid #eee4d5;
        box-shadow: 0 8px 20px rgba(45, 90, 39, 0.08);
    }
    .service-card {
        background: white;
        border: 1px solid #f0e7dc;
        box-shadow: 0 10px 25px rgba(45, 90, 39, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(45, 90, 39, 0.14);
    }
    .gallery-card {
        background: #fff;
        border: 1px solid #f0e7dc;
    }
    .gallery-card img {
        display: block;
    }
    .stat-box {
        background: linear-gradient(135deg, #f8f4ea, #ffffff);
        border: 1px solid #e9dfcf;
    }
</style>
@endsection
