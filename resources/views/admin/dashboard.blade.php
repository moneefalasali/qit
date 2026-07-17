@extends('layouts.admin')

@section('title', 'لوحة تحكم الإدارة - قطاف القصيم')

@section('page-title', 'لوحة تحكم الإدارة')

@section('admin-content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">إجمالي الطلبات</p>
                    <h4 class="fw-bold mb-1">{{ $totalRequests }}</h4>
                    <span class="text-success small">{{ $completedRequests }} مكتملة</span>
                </div>
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="fas fa-list-ul fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">إجمالي المزارعين</p>
                    <h4 class="fw-bold mb-1">{{ $totalFarmers }}</h4>
                    <span class="text-success small">مستخدمون مسجلون</span>
                </div>
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="fas fa-tractor fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">طلبات قيد المراجعة</p>
                    <h4 class="fw-bold mb-1 text-warning">{{ $pendingWorkers }}</h4>
                    <span class="text-muted small">تحتاج إلى إجراء</span>
                </div>
                <div class="stat-icon bg-info-subtle text-info">
                    <i class="fas fa-clipboard-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">إجمالي العمالة المسجلة</p>
                    <h4 class="fw-bold mb-1">{{ $totalWorkers }}</h4>
                    <span class="text-success small">{{ $totalEarnings }} ر.س دخل</span>
                </div>
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="fas fa-users fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card admin-card rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(90deg, #d4c5b0 0%, #e8dcc8 100%);">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-danger p-2 rounded-circle text-white shadow-sm">
                <i class="fas fa-bell"></i>
            </div>
            <h5 class="m-0 fw-bold" style="color: #2d5a27;">طلبات تسجيل عمال جديدة تحتاج مراجعة</h5>
            <span class="badge bg-danger rounded-pill">{{ $pendingWorkers }}</span>
        </div>
        <a href="{{ route('admin.workers') }}" class="btn btn-outline-dark border-0 fw-bold">عرض الطلبات ←</a>
    </div>
</div>

<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold m-0">أحدث الطلبات</h6>
        <a href="{{ route('admin.requests') }}" class="btn btn-sm btn-outline-qitaf">عرض الكل</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 border-0">#</th>
                    <th class="px-4 py-3 border-0">المزارع</th>
                    <th class="px-4 py-3 border-0">الخدمة</th>
                    <th class="px-4 py-3 border-0">عدد العمال</th>
                    <th class="px-4 py-3 border-0">الحالة</th>
                    <th class="px-4 py-3 border-0">تاريخ البداية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentRequests as $request)
                    <tr>
                        <td class="px-4 py-3 border-0">{{ $request->id }}</td>
                        <td class="px-4 py-3 border-0 fw-bold">{{ $request->farmer->user->name ?? '-' }}</td>
                        <td class="px-4 py-3 border-0">{{ $request->service_type ?? '-' }}</td>
                        <td class="px-4 py-3 border-0">{{ $request->number_of_workers }}</td>
                        <td class="px-4 py-3 border-0"><span class="badge bg-warning-subtle text-warning px-3 py-2">{{ $request->status }}</span></td>
                        <td class="px-4 py-3 border-0">{{ $request->start_date ? $request->start_date->format('Y-m-d') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">لا توجد طلبات بعد</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
