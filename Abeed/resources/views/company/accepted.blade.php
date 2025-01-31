<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @include('company.styles')
    <style>

        .reject-btn i {
            color:#900B09; 
        }

        .reject-btn:hover i {
            color: rgb(222, 87, 78); 
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <b>3BEED</b>
        <div>
            <a href="{{ route('company.home') }}">Home</a>
            <a href="{{ route('company.applications') }}">Applications</a>
            <a href="{{ route('company.accepted') }}" class="active">Accepted</a>
        </div>
        <a href="{{ route('profile.edit') }}" class="company-name">
    <i class="bi bi-building"></i> 
    {{ auth()->user()->company_name }}
</a>
    </div>

    <!-- Accepted Applications Section -->
    <div class="jobs-container">
        @foreach ($applications as $app)
            <div class="job-card">
                <h3>{{ optional($app->jobListing)->title ?? 'Not Available' }}</h3>
                <p><strong>Applicant:</strong> {{ $app->user->name }}</p>
                <p><strong>Email:</strong> {{ $app->contact_email }}</p>
                <p><strong>Phone:</strong> {{ $app->contact_phone }}</p>
                <p><strong>Resume:</strong> {{ $app->resume }}</p>
                <div class="job-actions">
                    <!-- Reject Button (X) -->
                    <form action="{{ route('company.reject-application2', $app->id) }}" method="POST">
                     @csrf
                    <button type="submit" class="reject-btn">
                    <i class="bi bi-x-circle"></i>
                      </button>
                     </form>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
