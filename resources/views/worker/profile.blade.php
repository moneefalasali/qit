@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 fw-bold" style="color: #2d5a27;">الملف الشخصي</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('worker.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="national_id" class="form-label">رقم الهوية / الإقامة</label>
                            <input type="text" name="national_id" id="national_id" class="form-control @error('national_id') is-invalid @enderror" value="{{ old('national_id', $worker->national_id) }}" required>
                            @error('national_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label">التخصص</label>
                            <input type="text" name="specialization" id="specialization" class="form-control" value="{{ old('specialization', $worker->specialization) }}" placeholder="مثال: جني التمور، تقليم النخيل">
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">المهارات</label>
                            <textarea name="skills" id="skills" class="form-control" rows="3">{{ old('skills', $worker->skills) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="years_experience" class="form-label">سنوات الخبرة</label>
                            <input type="number" name="years_experience" id="years_experience" class="form-control" value="{{ old('years_experience', $worker->years_experience) }}">
                        </div>

                        <button type="submit" class="btn btn-primary px-5" style="background-color: #2d5a27; border-color: #2d5a27;">تحديث البيانات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
