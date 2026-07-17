@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('logo.png') }}" alt="Logo" style="max-width: 150px;">
                        <h2 class="mt-3 fw-bold" style="color: #2d5a27;">نسيت كلمة المرور؟</h2>
                        <p class="text-muted">أدخل بريدك الإلكتروني لإرسال رابط استعادة كلمة المرور</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2" style="background-color: #2d5a27; border-color: #2d5a27;">
                            إرسال رابط الاستعادة
                        </button>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-decoration-none" style="color: #2d5a27;">العودة لتسجيل الدخول</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
