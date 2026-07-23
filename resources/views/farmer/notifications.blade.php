@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 fw-bold" style="color: #2d5a27;">الإشعارات</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($notifications as $notification)
                        <div class="list-group-item p-4 {{ $notification->read_at ? '' : 'bg-light' }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 fw-bold">{{ $notification->title }}</h5>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-secondary">{{ $notification->message }}</p>
                        </div>
                        @empty
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-bell-slash fs-1 d-block mb-3"></i>
                            لا يوجد إشعارات جديدة.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
