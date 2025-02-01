@extends('layouts.app')

@section('title', $jobListing->job_title ?? 'Job Details')

@section('content')
<div class="container my-5">
    @if(!$jobListing)
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>Job not found
    </div>
    @else
    <div class="card shadow" style="width: 800px; margin: 0 auto; height: 650px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <h2 class="card-title text-primary">
                    <i class="fas fa-briefcase me-2"></i>
                    {{ $jobListing->job_title }}
                </h2>
                <span class="badge bg-primary px-3 py-2">{{ $jobListing->work_type }}</span>
            </div>

            <div class="row mb-4 border-bottom pb-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-2 fa-lg"></i>
                        <div>
                            <small class="text-muted d-block">Location</small>
                            <strong>{{ $jobListing->location }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-dollar-sign text-primary me-2 fa-lg"></i>
                        <div>
                            <small class="text-muted d-block">Salary Range</small>
                            <strong>${{ number_format($jobListing->salary_min) }} - ${{ number_format($jobListing->salary_max) }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="text-primary mb-3">
                    <i class="fas fa-file-alt me-2"></i>Job Description
                </h4>
                <div class="card bg-light border-0 p-3 mb-4">
                    <p class="card-text mb-0">{!! nl2br(e($jobListing->description)) !!}</p>
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('applications.create', $jobListing) }}"
                    class="btn btn-primary btn-lg px-4 py-2">
                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                </a>
                <a href="{{ route('jobs.index') }}"
                    class="btn btn-outline-primary btn-lg px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection