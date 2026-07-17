@extends('layouts.admin')

@section('title', 'سجل النشاطات - قطاف القصيم')

@section('page-title', 'سجل النشاطات')

@section('admin-content')
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1" style="color: #2d5a27;">تتبع جميع النشاطات والعمليات</h5>
            <p class="text-muted mb-0">سجلات حقيقية من النظام</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">المستخدم</th>
                    <th class="px-3 py-3 border-0">نوع النشاط</th>
                    <th class="px-3 py-3 border-0">الوصف</th>
                    <th class="px-3 py-3 border-0">التاريخ والوقت</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td class="px-3 py-3 border-0">{{ $activity['user'] }}</td>
                        <td class="px-3 py-3 border-0"><span class="badge {{ $activity['badge_class'] }}">{{ $activity['type'] }}</span></td>
                        <td class="px-3 py-3 border-0">{{ $activity['description'] }}</td>
                        <td class="px-3 py-3 border-0">{{ $activity['time'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">لا توجد نشاطات مسجلة</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
