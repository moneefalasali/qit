@extends('layouts.app')

@section('title', 'تفاصيل الطلب - قطاف القصيم')

@section('styles')
<style>
    .request-shell {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px 40px;
    }

    .request-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .request-header {
        background: linear-gradient(135deg, #f7f0e2 0%, #fff 100%);
        padding: 28px 32px;
        border-bottom: 1px solid #eee3ce;
    }

    .request-body {
        padding: 24px 32px 32px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .detail-box {
        background: #f8f7f3;
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
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .btn-primary-soft {
        background: #2d5a27;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
    }

    .btn-secondary-soft {
        background: #f3efe8;
        color: #2d5a27;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
    }

    .table-responsive {
        margin-top: 16px;
    }
</style>
@endsection

@section('content')
<div class="request-shell">
    <div class="request-card">
        <div class="request-header">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h2 class="mb-2" style="color: #2d5a27;">طلب رقم #{{ $laborRequest->id }}</h2>
                    <p class="mb-0 text-muted">تفاصيل الطلب والحالة الحالية</p>
                </div>
                <span class="badge {{ $laborRequest->status_badge_class }}">{{ $laborRequest->status_label }}</span>
            </div>
        </div>

        <div class="request-body">
            <div class="detail-grid">
                <div class="detail-box">
                    <div class="detail-label">الخدمة المطلوبة</div>
                    <div class="detail-value">{{ $laborRequest->service_type }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">عدد العمال</div>
                    <div class="detail-value">{{ $laborRequest->number_of_workers }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">تاريخ البداية</div>
                    <div class="detail-value">{{ optional($laborRequest->start_date)->format('Y-m-d') }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">الأجر اليومي</div>
                    <div class="detail-value">{{ number_format($laborRequest->daily_wage, 2) }} ر.س</div>
                </div>
            </div>

            @if ($laborRequest->description)
                <div class="detail-box mb-3">
                    <div class="detail-label">الوصف</div>
                    <div class="detail-value">{{ $laborRequest->description }}</div>
                </div>
            @endif

            <div class="action-row">
                <a href="{{ route('farmer.requests') }}" class="btn-secondary-soft">العودة إلى القائمة</a>
                @if(in_array($laborRequest->status, ['approved', 'waiting_for_payment']))
                    <a href="{{ route('payment.form', $laborRequest->id) }}" class="btn-primary-soft">إتمام الدفع</a>
                @endif
            </div>

            <h4 class="mt-4" style="color: #2d5a27;">الطلبات المقدمة من العمال</h4>
            @if ($applications->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الرسالة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $application->worker->user->name ?? '-' }}</td>
                                    <td>{{ $application->application_message ?? '-' }}</td>
                                    <td>{{ $application->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $applications->links() }}</div>
            @else
                <div class="alert alert-light mt-3" role="alert">
                    لا توجد طلبات من العمال حتى الآن.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
