@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden" style="min-height: calc(100vh - 80px);">
    <div class="auth-split row g-0 h-100 flex-lg-row-reverse">
        <!-- Right Side Image -->
        <div class="col-lg-6 d-none d-lg-block position-relative order-lg-2">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('/images/date-palm-plantation.jpg') center/cover no-repeat;"></div>
        </div>

        <div class="auth-divider" aria-hidden="true"></div>

        <!-- Left Side Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white py-5 order-lg-1">
            <div class="w-100 px-4" style="max-width: 500px;">
                <div class="text-center mb-5">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="mb-4" style="height: 120px;">
                    <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                        <div style="height: 2px; width: 40px; background: #d4c5b0;"></div>
                        <h2 class="fw-bold m-0" style="color: #2d5a27;">تسجيل الدخول</h2>
                        <div style="height: 2px; width: 40px; background: #d4c5b0;"></div>
                    </div>
                </div>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label text-secondary fw-bold">البريد الإلكتروني أو رقم الجوال</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-start-0"><i class="far fa-user text-muted"></i></span>
                            <input type="email" class="form-control bg-light border-end-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="أدخل بريدك الإلكتروني أو رقم جوالك" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-secondary fw-bold">كلمة المرور</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-start-0"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" class="form-control bg-light border-end-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="أدخل كلمة المرور" required>
                            <span class="input-group-text bg-light border-start-0"><i class="far fa-eye text-muted"></i></span>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-secondary small" for="remember">تذكرني</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-decoration-none small" style="color: #2d5a27;">نسيت كلمة المرور؟</a>
                    </div>

                    <button type="submit" class="btn btn-primary-qitaf w-100 py-3 fs-5 mb-4">دخول</button>

                    <div class="position-relative text-center mb-4">
                        <hr>
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">أو</span>
                    </div>

                    <a href="{{ route('register') }}" class="btn btn-outline-qitaf w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="fas fa-user-plus"></i> إنشاء حساب جديد
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group-text {
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
    }
    .form-control {
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
        padding: 12px;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #2d5a27;
    }
    .btn-primary-qitaf {
        background: linear-gradient(135deg, #2d5a27, #4f7f3f);
        border: none;
        color: white;
    }
    .btn-outline-qitaf {
        border: 1px solid #2d5a27;
        color: #2d5a27;
    }
    .btn-outline-qitaf:hover {
        background-color: #2d5a27;
        color: white;
    }
    .auth-split {
        position: relative;
    }
    .auth-divider {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 12px;
        transform: translateX(-50%);
        pointer-events: none;
        z-index: 3;
        background: linear-gradient(180deg, #d7b35d 0%, #c89b3c 45%, #8b6327 100%);
        clip-path: polygon(0 0, 100% 0, 100% 100%, 60% 100%, 46% 86%, 30% 72%, 18% 54%, 8% 24%, 0 0);
        box-shadow: 0 0 0 1px rgba(255,255,255,0.75);
        opacity: 1;
    }

    @media (max-width: 991.98px) {
        .auth-divider {
            display: none;
        }

        .auth-split {
            flex-direction: column !important;
        }

        .auth-split .col-lg-6 {
            width: 100%;
        }
    }
</style>
@endsection
