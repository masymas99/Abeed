@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="container py-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mb-4 text-white"><i class="fas fa-file-alt me-2"></i>My Applications</h2>

    @if($applications->isEmpty())
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>You haven't submitted any applications yet.
        <a href="{{ route('jobs.index') }}" class="alert-link">Browse available jobs</a>
    </div>
    @else
    <div class="row g-4">
        @foreach($applications as $application)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body position-relative pb-5">
                    @if($application->jobListing)
                    <h5 class="card-title text-primary mb-3">
                        {{ $application->jobListing->job_title }}
                    </h5>
                    <p class="text-muted mb-2">
                        <i class="fas fa-building me-2"></i>{{ $application->jobListing->location }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="fas fa-dollar-sign me-2"></i>${{ number_format($application->jobListing->salary_min) }}
                    </p>
                    @else
                    <h5 class="card-title text-muted mb-3">Job no longer available</h5>
                    @endif
                    <p class="text-muted">
                        <i class="fas fa-clock me-2"></i>{{ $application->created_at->diffForHumans() }}
                    </p>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <span class="badge bg-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'accepted' ? 'success' : 'danger') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                        <a href="{{ route('applications.edit', $application) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection