@extends('layouts.admin')

@section('title', 'التقارير - قطاف القصيم')

@section('page-title', 'التقارير')

@section('admin-content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">إجمالي الإيرادات</p>
            <h4 class="fw-bold mb-0">{{ $totalEarnings }} ر.س</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">إجمالي الطلبات</p>
            <h4 class="fw-bold mb-0">{{ $totalRequests }}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">الطلبات المكتملة</p>
            <h4 class="fw-bold mb-0">{{ $completedRequests }}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">العمال المعتمدين</p>
            <h4 class="fw-bold mb-0">{{ $approvedWorkers }}</h4>
        </div>
    </div>
</div>

<div class="card admin-card rounded-4 p-4">
    <h5 class="fw-bold mb-3" style="color: #2d5a27;">ملخص سريع</h5>
    <p class="text-muted mb-0">إجمالي العمال المسجلين: {{ $totalWorkers }}<br>طلبات معلقة: {{ $pendingRequests }}</p>
</div>
@endsection