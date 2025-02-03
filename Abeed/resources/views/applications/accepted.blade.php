@extends('layouts.app')

@section('title', 'Accepted Applications')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-white"><i class="fas fa-check-circle me-2"></i>Accepted Applications</h2>

    @if($applications->isEmpty())
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>No accepted applications found.
    </div>
    @else
    <div class="row g-4">
        @foreach($applications as $application)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">{{ $application->jobListing->title }}</h5>

                    <div class="mb-3">
                        <p class="text-muted mb-2">
                            <i class="fas fa-building me-2"></i>{{ $application->jobListing->location }}
                        </p>
                        <p class="text-muted mb-2">
                            <i class="fas fa-dollar-sign me-2"></i>${{ number_format($application->jobListing->salary_min) }} - ${{ number_format($application->jobListing->salary_max) }}
                        </p>
                        <p class="text-muted mb-2">
                            <i class="fas fa-envelope me-2"></i>{{ $application->contact_email }}
                        </p>
                        @if($application->contact_phone)
                        <p class="text-muted mb-2">
                            <i class="fas fa-phone me-2"></i>{{ $application->contact_phone }}
                        </p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted">Job Description:</h6>
                        <p class="text-muted">{{ Str::limit($application->jobListing->description, 100) }}</p>
                    </div>

                    <div class="">
                        <span class="badge bg-success px-3 py-2  w-100">Accepted</span>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
