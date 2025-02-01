@extends('layouts.app')

@section('title', 'Available Jobs')

@section('content')
<!-- Add Search Section -->
<div class="container mt-4 mb-5">
    <h3 class="text-white mb-4">Search for jobs</h3>
    <form action="{{ route('jobs.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control form-control-lg"
                name="search"
                placeholder="Search for jobs..."
                value="{{ request('search') }}"
                style="border-radius: 10px 0 0 10px; border: 1px solid #ffb6c1;">
            <button class="btn btn-primary px-4" type="submit"
                style="border-radius: 0 10px 10px 0;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>

<div class="container my-5">
    @if($jobs->isEmpty())
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>No jobs found.
    </div>
    @else
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($jobs as $job)
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary mb-3">{{ $job->job_title }}</h5>
                    <p class="card-text text-muted flex-grow-1">{{ Str::limit($job->description, 100) }}</p>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-light text-dark border me-2">{{ $job->work_type }}</span>
                            <span class="text-primary">${{ number_format($job->salary_min) }}</span>
                        </div>
                        <p class="mb-3"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</p>
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('applications.create', $job) }}" class="btn btn-primary">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection