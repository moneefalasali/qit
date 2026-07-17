@extends('layouts.app')

@section('title', 'الصفحة غير موجودة - قطاف القصيم')

@section('styles')
<style>
    .error-container {
        max-width: 800px;
        margin: 100px auto;
        padding: 40px;
        text-align: center;
    }

    .error-code {
        font-size: 120px;
        font-weight: 800;
        color: var(--beige);
        margin-bottom: 20px;
        line-height: 1;
    }

    .error-title {
        font-size: 32px;
        color: var(--primary-green);
        margin-bottom: 15px;
        font-weight: 700;
    }

    .error-message {
        font-size: 18px;
        color: var(--light-text);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .error-icon {
        font-size: 80px;
        color: var(--beige);
        margin-bottom: 20px;
    }

    .error-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .error-btn {
        padding: 12px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .error-btn-primary {
        background-color: var(--primary-green);
        color: white;
    }

    .error-btn-primary:hover {
        background-color: var(--light-green);
    }

    .error-btn-secondary {
        background-color: transparent;
        color: var(--primary-green);
        border: 2px solid var(--primary-green);
    }

    .error-btn-secondary:hover {
        background-color: var(--primary-green);
        color: white;
    }

    @media (max-width: 768px) {
        .error-code {
            font-size: 80px;
        }

        .error-title {
            font-size: 24px;
        }

        .error-message {
            font-size: 16px;
        }

        .error-buttons {
            flex-direction: column;
        }

        .error-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="error-container">
    <div class="error-icon">
        <i class="fas fa-search"></i>
    </div>
    <div class="error-code">404</div>
    <h1 class="error-title">الصفحة غير موجودة</h1>
    <p class="error-message">
        عذراً، الصفحة التي تبحث عنها غير موجودة أو قد تم حذفها. يرجى التحقق من الرابط والمحاولة مرة أخرى.
    </p>
    <div class="error-buttons">
        <a href="/" class="error-btn error-btn-primary">
            <i class="fas fa-home"></i> العودة إلى الرئيسية
        </a>
        <a href="/services" class="error-btn error-btn-secondary">
            <i class="fas fa-info-circle"></i> الخدمات
        </a>
    </div>
</div>
@endsection
