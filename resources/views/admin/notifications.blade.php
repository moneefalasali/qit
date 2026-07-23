@extends('layouts.admin')

@section('title', 'الإشعارات - قطاف القصيم')

@section('page-title', 'الإشعارات')

@section('admin-content')
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">الإشعارات</h5>
        <span class="badge bg-light text-dark">{{ $notifications->total() }} إشعار</span>
    </div>

    @forelse($notifications as $notification)
        <div class="border rounded-4 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="fw-bold mb-1">{{ $notification->title }}</h6>
                    <p class="mb-0 text-muted">{{ $notification->message }}</p>
                </div>
                <span class="badge bg-success-subtle text-success">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
        </div>
    @empty
        <div class="text-center py-5 text-muted">لا توجد إشعارات حالياً</div>
    @endforelse

    <div class="mt-3">{{ $notifications->links() }}</div>
</div>
@endsection
