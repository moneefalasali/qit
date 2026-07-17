@extends('layouts.admin')

@section('title', 'إدارة العمال - قطاف القصيم')

@section('page-title', 'إدارة العمال')

@section('admin-content')
@if (session('success'))
    <div class="alert alert-success rounded-4 mb-3">
        {{ session('success') }}
    </div>
@endif

<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة العمال</h5>
        <span class="badge bg-light text-dark">{{ $workers->total() }} عامل</span>
    </div>

    @if ($workers->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-3 py-3 border-0">الاسم</th>
                        <th class="px-3 py-3 border-0">البريد</th>
                        <th class="px-3 py-3 border-0">الهاتف</th>
                        <th class="px-3 py-3 border-0">الحالة</th>
                        <th class="px-3 py-3 border-0">الخبرة</th>
                        <th class="px-3 py-3 border-0">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workers as $worker)
                        <tr>
                            <td class="px-3 py-3 border-0">{{ $worker->user->name ?? '-' }}</td>
                            <td class="px-3 py-3 border-0">{{ $worker->user->email ?? '-' }}</td>
                            <td class="px-3 py-3 border-0">{{ $worker->user->phone ?? '-' }}</td>
                            <td class="px-3 py-3 border-0">
                                <span class="badge {{ $worker->status === 'approved' ? 'bg-success-subtle text-success' : ($worker->status === 'rejected' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning') }}">
                                    {{ $worker->status === 'approved' ? 'موافق عليه' : ($worker->status === 'rejected' ? 'مرفوض' : 'قيد الانتظار') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 border-0">{{ $worker->years_experience ?? '-' }} سنة</td>
                            <td class="px-3 py-3 border-0">
                                @if ($worker->status === 'pending')
                                    <form method="POST" action="{{ route('admin.worker.approve', $worker->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success ms-1">موافقة</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.worker.reject', $worker->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">رفض</button>
                                    </form>
                                @else
                                    <span class="text-muted">تمت المعالجة</span>
                                @endif
                                <a href="#" class="btn btn-sm btn-outline-secondary">عرض</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $workers->links() }}</div>
    @else
        <div class="text-center py-5 text-muted">لا يوجد عمال مسجلين</div>
    @endif
</div>
@endsection
