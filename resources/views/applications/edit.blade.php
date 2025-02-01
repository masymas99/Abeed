@extends('layouts.app')

@section('title', 'Edit Application')

@section('content')
<div class="container my-5">
    <div class="card shadow" style="width: 800px; margin: 0 auto; min-height: 700px;">
        <div class="card-body p-4">
            <h3 class="card-title text-primary mb-4">
                <i class="fas fa-edit me-2"></i>
                Edit Application
            </h3>

            <form action="{{ route('applications.update', $application) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold mb-2">Full Name</label>
                            <input type="text" class="form-control form-control-lg @error('full_name') is-invalid @enderror"
                                name="full_name" required value="{{ old('full_name', $application->full_name) }}"
                                style="border-radius: 10px; border: 1px solid #B05476;">
                            @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold mb-2">Email</label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                name="email" required value="{{ old('email', $application->email) }}"
                                style="border-radius: 10px; border: 1px solid #B05476;">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label fw-bold mb-2">Resume (Leave empty to keep current resume)</label>
                            <input type="file" class="form-control form-control-lg @error('resume') is-invalid @enderror"
                                name="resume"
                                style="border-radius: 10px; border: 1px solid #B05476;">
                            @error('resume')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label fw-bold mb-2">Cover Letter</label>
                            <textarea class="form-control form-control-lg @error('cover_letter') is-invalid @enderror"
                                name="cover_letter" rows="6" required
                                style="border-radius: 10px; border: 1px solid #B05476;">{{ old('cover_letter', $application->cover_letter) }}</textarea>
                            @error('cover_letter')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                    <a href="{{ route('applications.my') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection