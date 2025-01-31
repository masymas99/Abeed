@extends('layouts.app')

@section('title', 'Apply for ' . $jobListing->job_title)

@section('content')
<div class="container my-5">
    <div class="card shadow" style="width: 800px; margin: 0 auto; min-height: 700px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <h3 class="card-title text-primary">
                    <i class="fas fa-paper-plane me-2"></i>
                    Apply for Position
                </h3>
                <span class="badge bg-primary px-3 py-2">{{ $jobListing->work_type }}</span>
            </div>

            <div class="mb-4 border-bottom pb-3">
                <h5 class="text-muted">{{ $jobListing->job_title }}</h5>
                <div class="d-flex gap-4">
                    <span><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $jobListing->location }}</span>
                    <span><i class="fas fa-dollar-sign text-primary me-2"></i>${{ number_format($jobListing->salary_min) }} - ${{ number_format($jobListing->salary_max) }}</span>
                </div>
            </div>

            <form action="{{ route('applications.store', $jobListing) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold mb-2">Full Name</label>
                            <input type="text" class="form-control form-control-lg @error('full_name') is-invalid @enderror"
                                   name="full_name" required
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
                                   name="email" required
                                   style="border-radius: 10px; border: 1px solid #B05476;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label fw-bold mb-2">Resume</label>
                            <input type="file" class="form-control form-control-lg @error('resume') is-invalid @enderror"
                                   name="resume" required
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
                                      style="border-radius: 10px; border: 1px solid #B05476;"></textarea>
                            @error('cover_letter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-check me-2"></i>Submit Application
                    </button>
                    <a href="{{ route('jobs.show', $jobListing) }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
