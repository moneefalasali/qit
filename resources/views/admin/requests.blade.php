@extends('layouts.admin')

@section('title', 'طلبات المزارعين - قطاف القصيم')

@section('page-title', 'طلبات المزارعين')

@section('admin-content')
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة الطلبات</h5>
        <span class="badge bg-light text-dark">{{ $requests->total() }} طلب</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">#</th>
                    <th class="px-3 py-3 border-0">المزارع</th>
                    <th class="px-3 py-3 border-0">الخدمة</th>
                    <th class="px-3 py-3 border-0">عدد العمال</th>
                    <th class="px-3 py-3 border-0">الحالة</th>
                    <th class="px-3 py-3 border-0">الإجراءات</th>
                    <th class="px-3 py-3 border-0">تاريخ البداية</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td class="px-3 py-3 border-0">{{ $request->id }}</td>
                        <td class="px-3 py-3 border-0">{{ $request->farmer->user->name ?? '-' }}</td>
                        <td class="px-3 py-3 border-0">{{ $request->service_type ?? '-' }}</td>
                        <td class="px-3 py-3 border-0">{{ $request->number_of_workers }}</td>
                        <td class="px-3 py-3 border-0">
                            <span class="badge bg-warning-subtle text-warning">{{ $request->status }}</span>
                        </td>
                        <td class="px-3 py-3 border-0">
                            <form method="POST" action="{{ route('admin.request.status', $request->id) }}" class="d-inline">
                                @csrf
                                <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                    <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                    <option value="approved" {{ $request->status === 'approved' ? 'selected' : '' }}>موافق</option>
                                    <option value="in_progress" {{ $request->status === 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                                    <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>مكتمل</option>
                                    <option value="cancelled" {{ $request->status === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-3 py-3 border-0">{{ $request->start_date ? $request->start_date->format('Y-m-d') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">لا توجد طلبات حتى الآن</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $requests->links() }}</div>
</div>
@endsection