@extends('layouts.app')

@section('title', 'تسجيل عامل - قطاف القصيم')

@section('styles')
<style>
    .register-container {
        max-width: 800px;
        margin: 60px auto;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .register-container h1 {
        color: var(--primary-green);
        margin-bottom: 10px;
        text-align: center;
        font-size: 28px;
    }

    .register-container p {
        text-align: center;
        color: var(--light-text);
        margin-bottom: 30px;
    }

    .info-box {
        background-color: #d4edda;
        border-right: 4px solid #28a745;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 30px;
    }

    .info-box p {
        margin: 0;
        color: #155724;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--dark-text);
        font-weight: 600;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 5px rgba(45, 80, 22, 0.2);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-green);
        color: white;
        border: none;
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: var(--light-green);
    }

    .login-prompt {
        background-color: #e8dcc8;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        margin-top: 30px;
    }

    .login-prompt p {
        margin: 0 0 15px 0;
        color: var(--dark-text);
    }

    .login-prompt a {
        display: inline-block;
        background-color: var(--primary-green);
        color: white;
        padding: 10px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
        margin: 0 10px;
    }

    .login-prompt a:hover {
        background-color: var(--light-green);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .register-container {
            margin: 30px 20px;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="register-container">
    <h1>تسجيل عامل جديد</h1>
    <p>انضم إلى شبكة العمال المعتمدين في قطاف القصيم</p>

    <div class="info-box">
        <p><i class="fas fa-check-circle"></i> بعد التسجيل، سيتم مراجعة بيانات التقديم من قبل الفريق الإداري</p>
    </div>

    @if (!auth()->check())
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <input type="hidden" name="role" value="worker">

            <div class="form-row">
                <div class="form-group">
                    <label for="name">الاسم الكامل</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">المدينة</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                @error('city')
                    <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span style="color: #dc3545; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="submit-btn">تسجيل العامل</button>

            <div class="login-prompt">
                <p>هل لديك حساب بالفعل؟</p>
                <a href="{{ route('login') }}">تسجيل الدخول</a>
            </div>
        </form>
    @else
        <div class="login-prompt">
            <p>أنت مسجل دخول بالفعل. يرجى الانتقال إلى لوحة التحكم الخاصة بك</p>
            <div>
                @if (auth()->user()->role === 'worker')
                    <a href="{{ route('worker.dashboard') }}">لوحة تحكم العامل</a>
                @elseif (auth()->user()->role === 'farmer')
                    <a href="{{ route('farmer.dashboard') }}">لوحة تحكم المزارع</a>
                @else
                    <a href="{{ route('admin.dashboard') }}">لوحة تحكم الإدارة</a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
