@extends('layouts.admin')

@section('title', 'إدارة المزارعين - قطاف القصيم')

@section('page-title', 'إدارة المزارعين')

@section('admin-content')
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة المزارعين</h5>
        <span class="badge bg-light text-dark">{{ $farmers->total() }} مزارع</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">#</th>
                    <th class="px-3 py-3 border-0">الاسم</th>
                    <th class="px-3 py-3 border-0">البريد</th>
                    <th class="px-3 py-3 border-0">الهاتف</th>
                    <th class="px-3 py-3 border-0">اسم المزرعة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($farmers as $farmer)
                    <tr>
                        <td class="px-3 py-3 border-0">{{ $farmer->id }}</td>
                        <td class="px-3 py-3 border-0">{{ $farmer->user->name ?? '-' }}</td>
                        <td class="px-3 py-3 border-0">{{ $farmer->user->email ?? '-' }}</td>
                        <td class="px-3 py-3 border-0">{{ $farmer->user->phone ?? '-' }}</td>
                        <td class="px-3 py-3 border-0">{{ $farmer->farm_name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">لا توجد مزارعين حتى الآن</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $farmers->links() }}</div>
</div>
@endsection