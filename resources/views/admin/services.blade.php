@extends('layouts.admin')

@section('title', 'إدارة الخدمات - قطاف القصيم')

@section('page-title', 'إدارة الخدمات')

@section('admin-content')
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة الخدمات</h5>
        <span class="badge bg-light text-dark">{{ $services->total() }} خدمة</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">#</th>
                    <th class="px-3 py-3 border-0">الاسم</th>
                    <th class="px-3 py-3 border-0">الوصف</th>
                    <th class="px-3 py-3 border-0">الحالة</th>
                    <th class="px-3 py-3 border-0">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr>
                        <td class="px-3 py-3 border-0">{{ $service->id }}</td>
                        <td class="px-3 py-3 border-0">{{ $service->name }}</td>
                        <td class="px-3 py-3 border-0">{{ $service->description }}</td>
                        <td class="px-3 py-3 border-0">
                            <span class="badge {{ $service->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                {{ $service->is_active ? 'نشط' : 'غير نشط' }}
                            </span>
                        </td>
                        <td class="px-3 py-3 border-0">
                            <form method="POST" action="{{ route('admin.service.toggle', $service->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                    {{ $service->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">لا توجد خدمات حتى الآن</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $services->links() }}</div>
</div>
@endsection