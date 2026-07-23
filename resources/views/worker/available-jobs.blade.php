@extends('layouts.app')

@section('title', 'الوظائف المتاحة - قطاف القصيم')

@section('styles')
<style>
    .jobs-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: var(--primary-green);
        font-size: 28px;
        margin-bottom: 10px;
    }

    .search-box {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .search-box input {
        flex: 1;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
    }

    .search-box button {
        padding: 12px 30px;
        background-color: var(--primary-green);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .search-box button:hover {
        background-color: goldenrod;
    }

    .jobs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .job-card {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .job-header {
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 20px;
    }

    .job-header h3 {
        margin-bottom: 5px;
        font-size: 18px;
    }

    .job-header p {
        opacity: 0.9;
        font-size: 13px;
    }

    .job-body {
        padding: 20px;
    }

    .job-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .job-info-item {
        text-align: center;
        padding: 10px;
        background-color: #f9f7f4;
        border-radius: 5px;
    }

    .job-info-label {
        font-size: 12px;
        color: var(--light-text);
        margin-bottom: 5px;
    }

    .job-info-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--primary-green);
    }

    .job-description {
        color: var(--light-text);
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .job-dates {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 13px;
        color: var(--light-text);
    }

    .job-dates i {
        color: var(--primary-green);
    }

    .job-actions {
        display: flex;
        gap: 10px;
    }

    .job-btn {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
    }

    .job-btn-apply {
        background-color: var(--primary-green);
        color: white;
    }

    .job-btn-apply:hover {
        background-color: goldenrod;
    }

    .job-btn-view {
        background-color: transparent;
        color: var(--primary-green);
        border: 2px solid var(--primary-green);
    }

    .job-btn-view:hover {
        background-color: var(--primary-green);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: var(--beige);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--light-text);
        margin-bottom: 10px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        text-decoration: none;
        color: var(--primary-green);
    }

    .pagination a:hover {
        background-color: var(--primary-green);
        color: white;
    }

    .pagination .active {
        background-color: var(--primary-green);
        color: white;
    }

    @media (max-width: 768px) {
        .jobs-grid {
            grid-template-columns: 1fr;
        }

        .search-box {
            flex-direction: column;
        }

        .job-info {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="jobs-container">
    <div class="page-header">
        <h1>الوظائف المتاحة</h1>
        <p style="color: var(--light-text);">اختر من بين الوظائف المتاحة وقدم طلبك الآن</p>
    </div>

    <div class="search-box">
        <input type="text" placeholder="ابحث عن وظيفة...">
        <button>بحث</button>
    </div>

    @if ($jobs->count() > 0)
        <div class="jobs-grid">
            @foreach ($jobs as $job)
                <div class="job-card">
                    <div class="job-header">
                        <h3>{{ $job->service_type }}</h3>
                        <p>من {{ $job->farmer->user->name ?? 'مزارع' }}</p>
                    </div>
                    <div class="job-body">
                        <div class="job-info">
                            <div class="job-info-item">
                                <div class="job-info-label">عدد العمال</div>
                                <div class="job-info-value">{{ $job->number_of_workers }}</div>
                            </div>
                            <div class="job-info-item">
                                <div class="job-info-label">الأجر اليومي</div>
                                <div class="job-info-value">{{ $job->daily_wage }} ر.س</div>
                            </div>
                        </div>

                        @if ($job->description)
                            <div class="job-description">
                                {{ Str::limit($job->description, 100) }}
                            </div>
                        @endif

                        <div class="job-dates">
                            <span><i class="fas fa-calendar"></i> من {{ $job->start_date->format('Y-m-d') }}</span>
                            @if ($job->end_date)
                                <span><i class="fas fa-calendar"></i> إلى {{ $job->end_date->format('Y-m-d') }}</span>
                            @endif
                        </div>

                        <div class="job-actions">
                            <form method="POST" action="{{ route('worker.apply') }}" style="flex: 1;">
                                @csrf
                                <input type="hidden" name="labor_request_id" value="{{ $job->id }}">
                                <button type="submit" class="job-btn job-btn-apply">تقديم طلب</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-briefcase"></i>
            <h3>لا توجد وظائف متاحة حالياً</h3>
            <p style="color: var(--light-text);">تحقق لاحقاً من الوظائف الجديدة</p>
        </div>
    @endif
</div>
@endsection
