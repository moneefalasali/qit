@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 fw-bold" style="color: #2d5a27;">طلباتي المقدمة</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">الخدمة</th>
                                    <th class="px-4 py-3">المزارع</th>
                                    <th class="px-4 py-3">التاريخ</th>
                                    <th class="px-4 py-3">الأجر المتفق عليه</th>
                                    <th class="px-4 py-3">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                <tr>
                                    <td class="px-4 py-3">{{ $application->laborRequest->service->name ?? 'خدمة زراعية' }}</td>
                                    <td class="px-4 py-3">{{ $application->laborRequest->farmer->user->name }}</td>
                                    <td class="px-4 py-3">{{ $application->created_at->format('Y/m/d') }}</td>
                                    <td class="px-4 py-3">{{ $application->agreed_wage }} ر.س</td>
                                    <td class="px-4 py-3">
                                        @if($application->status == 'pending')
                                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                        @elseif($application->status == 'accepted')
                                            <span class="badge bg-success">مقبول</span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge bg-danger">مرفوض</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $application->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">لا يوجد طلبات مقدمة حالياً.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
