@extends('layouts.app')

@section('title', 'تأكيد الطلب - قطاف القصيم')

@section('styles')
<style>
    .confirmation-card {
        max-width: 760px;
        margin: 40px auto;
        padding: 32px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
    }

    .confirmation-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eef8eb;
        color: #2d5a27;
        padding: 8px 14px;
        border-radius: 999px;
        font-weight: 700;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin: 24px 0;
    }

    .detail-box {
        background: #f9f7f4;
        border: 1px solid #ece6db;
        border-radius: 12px;
        padding: 16px;
    }

    .detail-label {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #2c2c2c;
        font-weight: 700;
    }

    .action-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
    }

    .action-btn-primary {
        background: #2d5a27;
        color: white;
    }

    .action-btn-secondary {
        background: #f3efe8;
        color: #2d5a27;
    }
</style>
@endsection

@section('content')
<div class="confirmation-card">
    <div class="confirmation-badge">
        <i class="fas fa-check-circle"></i>
        تم إرسال طلبك بنجاح
    </div>

    <h1 class="mt-3" style="color: #2d5a27;">طلب رقم #{{ $laborRequest->id }}</h1>
    <p class="text-muted">تم استلام طلبك وسنراجع البيانات قبل تحويله إلى الخطوة التالية.</p>

    <div class="detail-grid">
        <div class="detail-box">
            <div class="detail-label">الخدمة المطلوبة</div>
            <div class="detail-value">{{ $laborRequest->service_type }}</div>
        </div>
        <div class="detail-box">
            <div class="detail-label">الحالة الحالية</div>
            <div class="detail-value">{{ $laborRequest->status_label }}</div>
        </div>
        <div class="detail-box">
            <div class="detail-label">عدد العمال</div>
            <div class="detail-value">{{ $laborRequest->number_of_workers }}</div>
        </div>
        <div class="detail-box">
            <div class="detail-label">الأجر اليومي</div>
            <div class="detail-value">{{ number_format($laborRequest->daily_wage, 2) }} ر.س</div>
        </div>
    </div>

    <div class="alert alert-info rounded-4" role="alert">
        سيتم مراجعة الطلب أولاً ثم سيتم إشعارك عند التقدم إلى مرحلة الموافقة أو الدفع.
    </div>

    <div class="action-row">
        <a href="{{ route('farmer.requests') }}" class="action-btn action-btn-primary">عرض الطلبات</a>
        <a href="{{ route('farmer.request.show', $laborRequest->id) }}" class="action-btn action-btn-secondary">تفاصيل الطلب</a>
    </div>
</div>
@endsection
