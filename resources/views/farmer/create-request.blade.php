@extends('layouts.app')

@section('title', 'إنشاء طلب عمالة - قطاف القصيم')

@section('styles')
<style>
    .create-request-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .create-request-container h1 {
        color: var(--primary-green);
        margin-bottom: 10px;
        font-size: 28px;
    }

    .create-request-container p {
        color: var(--light-text);
        margin-bottom: 30px;
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

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
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

    .cancel-btn {
        display: inline-block;
        margin-top: 15px;
        color: var(--primary-green);
        text-decoration: none;
        text-align: center;
    }

    .cancel-btn:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .create-request-container {
            margin: 20px;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="create-request-container">
    <h1>إنشاء طلب عمالة جديد</h1>
    <p>قم بملء النموذج أدناه لإنشاء طلب عمالة جديد</p>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('farmer.request.store') }}">
        @csrf

        <div class="form-group">
            <label for="service_type">نوع الخدمة المطلوبة *</label>
            <select id="service_type" name="service_type" required>
                <option value="">اختر نوع الخدمة</option>
                <option value="جني_التمور" {{ old('service_type') === 'جني_التمور' ? 'selected' : '' }}>جني التمور</option>
                <option value="تلقيح_النخيل" {{ old('service_type') === 'تلقيح_النخيل' ? 'selected' : '' }}>تلقيح النخيل</option>
                <option value="تقليم_النخيل" {{ old('service_type') === 'تقليم_النخيل' ? 'selected' : '' }}>تقليم النخيل</option>
                <option value="الري_والعناية" {{ old('service_type') === 'الري_والعناية' ? 'selected' : '' }}>الري والعناية</option>
                <option value="الفرز_والتعبئة" {{ old('service_type') === 'الفرز_والتعبئة' ? 'selected' : '' }}>الفرز والتعبئة</option>
                <option value="تحميل_ونقل" {{ old('service_type') === 'تحميل_ونقل' ? 'selected' : '' }}>تحميل ونقل</option>
                <option value="خدمات_أخرى" {{ old('service_type') === 'خدمات_أخرى' ? 'selected' : '' }}>خدمات أخرى</option>
            </select>
            @error('service_type')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="number_of_workers">عدد العمال المطلوبين *</label>
                <input type="number" id="number_of_workers" name="number_of_workers" value="{{ old('number_of_workers') }}" min="1" required>
                @error('number_of_workers')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="daily_wage">الأجر اليومي (ر.س) *</label>
                <input type="number" id="daily_wage" name="daily_wage" value="{{ old('daily_wage') }}" min="0" step="0.01" required>
                @error('daily_wage')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">تاريخ البداية *</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_date">تاريخ النهاية (اختياري)</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">وصف الخدمة المطلوبة (اختياري)</label>
            <textarea id="description" name="description" placeholder="أضف تفاصيل إضافية عن الخدمة المطلوبة...">{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-btn">إنشاء الطلب</button>
        <a href="{{ route('farmer.requests') }}" class="cancel-btn">← العودة إلى الطلبات</a>
    </form>
</div>
@endsection
