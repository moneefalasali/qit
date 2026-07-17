@extends('layouts.app')

@section('title', 'لوحة تحكم العامل - قطاف القصيم')

@section('styles')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .dashboard-header h1 {
        color: var(--primary-green);
        font-size: 32px;
    }

    .dashboard-header a {
        background-color: var(--primary-green);
        color: white;
        padding: 12px 24px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .dashboard-header a:hover {
        background-color: var(--light-green);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-right: 5px solid var(--primary-green);
    }

    .stat-card h3 {
        color: var(--light-text);
        font-size: 14px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .stat-card .value {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary-green);
    }

    .dashboard-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .content-card {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .content-card h2 {
        color: var(--primary-green);
        margin-bottom: 20px;
        font-size: 20px;
    }

    .job-item {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .job-item:last-child {
        border-bottom: none;
    }

    .job-info h4 {
        margin-bottom: 5px;
        color: var(--dark-text);
    }

    .job-info p {
        font-size: 13px;
        color: var(--light-text);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-accepted {
        background-color: #d4edda;
        color: #155724;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .quick-action-btn {
        padding: 12px;
        border: 2px solid var(--primary-green);
        background-color: transparent;
        color: var(--primary-green);
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s;
    }

    .quick-action-btn:hover {
        background-color: var(--primary-green);
        color: white;
    }

    .document-alert {
        background-color: #fff8e1;
        border: 1px solid #f0b429;
        border-right: 4px solid #f0b429;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        color: #7a4b00;
    }

    .document-alert strong {
        display: block;
        margin-bottom: 6px;
        color: #6b3b00;
    }

    .document-alert a {
        background-color: var(--primary-green);
        color: white;
        padding: 10px 16px;
        border-radius: 5px;
        text-decoration: none;
        white-space: nowrap;
    }

    .document-alert a:hover {
        background-color: #2f6d3a;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--light-text);
    }

    .empty-state i {
        font-size: 48px;
        color: var(--beige);
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .dashboard-content {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>لوحة تحكم العامل</h1>
        <a href="{{ route('worker.jobs') }}">+ البحث عن وظائف</a>
    </div>

    <div class="document-alert">
        <div>
            <strong>تنبيه مهم:</strong>
            <span>يجب عليك إكمال التوثيق والتأكد من رفع المستندات اللازمة قبل اعتماد حسابك كمركز عامل.</span>
        </div>
        <a href="{{ route('worker.documents') }}">إكمال التوثيق</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>الوظائف النشطة</h3>
            <div class="value">{{ $activeJobs }}</div>
        </div>
        <div class="stat-card">
            <h3>إجمالي الطلبات</h3>
            <div class="value">{{ $totalApplications }}</div>
        </div>
        <div class="stat-card">
            <h3>الوظائف المنجزة</h3>
            <div class="value">{{ $completedJobs }}</div>
        </div>
        <div class="stat-card">
            <h3>إجمالي الأرباح</h3>
            <div class="value">{{ number_format($totalEarnings, 0) }} ر.س</div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="content-card">
            <h2>آخر الطلبات</h2>
            <div id="recent-applications">
                <!-- Applications will be loaded here -->
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>لا توجد طلبات حالياً</p>
                </div>
            </div>
            <a href="{{ route('worker.applications') }}" style="display: block; margin-top: 15px; text-align: center; color: var(--primary-green); text-decoration: none;">عرض جميع الطلبات →</a>
        </div>

        <div class="content-card">
            <h2>الإجراءات السريعة</h2>
            <div class="quick-actions">
                <a href="{{ route('worker.jobs') }}" class="quick-action-btn">
                    <i class="fas fa-search"></i> البحث عن وظائف
                </a>
                <a href="{{ route('worker.applications') }}" class="quick-action-btn">
                    <i class="fas fa-list"></i> طلباتي
                </a>
                <a href="{{ route('worker.profile') }}" class="quick-action-btn">
                    <i class="fas fa-user"></i> الملف الشخصي
                </a>
                <a href="{{ route('worker.notifications') }}" class="quick-action-btn">
                    <i class="fas fa-bell"></i> الإشعارات
                </a>
                <a href="{{ route('worker.documents') }}" class="quick-action-btn">
                    <i class="fas fa-file-alt"></i> التوثيق
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
