@extends('layouts.app')

@section('title', 'الطلبات - قطاف القصيم')

@section('styles')
<style>
    .requests-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: var(--primary-green);
        font-size: 28px;
    }

    .page-header a {
        background-color: var(--primary-green);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .page-header a:hover {
        background-color: var(--light-green);
    }

    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 2px solid var(--border-color);
        background-color: white;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        transition: all 0.3s;
    }

    .filter-btn.active {
        background-color: var(--primary-green);
        color: white;
        border-color: var(--primary-green);
    }

    .requests-table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table thead {
        background-color: #f9f7f4;
        border-bottom: 2px solid var(--border-color);
    }

    .table th {
        padding: 15px;
        text-align: right;
        color: var(--primary-green);
        font-weight: 600;
    }

    .table td {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: #f9f7f4;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background-color: #d4edda;
        color: #155724;
    }

    .status-in-progress {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .action-btn-view {
        background-color: var(--primary-green);
        color: white;
    }

    .action-btn-view:hover {
        background-color: var(--light-green);
    }

    .action-btn-edit {
        background-color: #17a2b8;
        color: white;
    }

    .action-btn-edit:hover {
        background-color: #138496;
    }

    .action-btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .action-btn-delete:hover {
        background-color: #c82333;
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
        .table {
            font-size: 13px;
        }

        .table th, .table td {
            padding: 10px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="requests-container">
    <div class="page-header">
        <h1>طلبات العمالة</h1>
        <a href="{{ route('farmer.request.create') }}">+ طلب جديد</a>
    </div>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="filters">
        <button class="filter-btn active">الكل</button>
        <button class="filter-btn">قيد الانتظار</button>
        <button class="filter-btn">موافق عليه</button>
        <button class="filter-btn">قيد التنفيذ</button>
        <button class="filter-btn">منجز</button>
    </div>

    @if ($requests->count() > 0)
        <div class="requests-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>نوع الخدمة</th>
                        <th>عدد العمال</th>
                        <th>الأجر اليومي</th>
                        <th>تاريخ البداية</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->service_type }}</td>
                            <td>{{ $request->number_of_workers }}</td>
                            <td>{{ $request->daily_wage }} ر.س</td>
                            <td>{{ $request->start_date->format('Y-m-d') }}</td>
                            <td>
                                <span class="status-badge status-{{ $request->status }}">
                                    @if ($request->status === 'pending')
                                        قيد الانتظار
                                    @elseif ($request->status === 'approved')
                                        موافق عليه
                                    @elseif ($request->status === 'in_progress')
                                        قيد التنفيذ
                                    @else
                                        منجز
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('farmer.request.show', $request->id) }}" class="action-btn action-btn-view">عرض</a>
                                    @if($request->status === 'pending')
                                        <a href="{{ route('payment.form', $request->id) }}" class="action-btn" style="background-color: #ffc107; color: #000;">دفع</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $requests->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>لا توجد طلبات حالياً</h3>
            <p style="color: var(--light-text); margin-bottom: 20px;">ابدأ بإنشاء طلب عمالة جديد</p>
            <a href="{{ route('farmer.request.create') }}" style="display: inline-block; background-color: var(--primary-green); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">+ طلب جديد</a>
        </div>
    @endif
</div>
@endsection
