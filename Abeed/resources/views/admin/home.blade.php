@extends('admin.layout')

@section('content')

    <div class="jobs-container">
        @foreach ($jobs as $job)
            <div class="job-card">
                <h3>{{ $job->title }}</h3>  
                <p><strong>Company Name:</strong> {{ $job->user->company_name ?? 'N/A' }}</p>
                <p><strong>Salary Min:</strong> {{ $job->salary_min }}</p>
                <p><strong>Salary Max:</strong> {{ $job->salary_max }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Application Deadline:</strong> {{ \Carbon\Carbon::parse($job->application_deadline)->format('d M Y') }}</p>

                <div class="d-flex justify-content-center gap-2 mt-3">
                    <form action="{{ route('admin.acceptJob', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success accept-btn">Accept</button>
                    </form>

                    <form action="{{ route('admin.rejectJob', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger reject-btn">Reject</button>
                    </form>

                    <a href="{{ route('admin.viewJob', $job->id) }}" class="btn btn-secondary view-btn">View</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .jobs-container {
        padding: 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .job-card {
        background-color: #D9D9D9;
        border: 15px solid #B05476;
        padding: 20px;
        border-radius: 20px;
        text-align: center;
        width: 350px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .job-card h3 {
        color: #812222;
    }

    .job-card p {
        color: #555;
    }

    .d-flex {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .btn {
        width: 100px;
        height: 40px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
    }

    .accept-btn {
        background-color: #366D56;
        color: white;
    }

    .reject-btn {
        background-color: #6D364C;
        color: white;
    }

    .view-btn {
        background-color: #6c757d;
        color: white;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>
