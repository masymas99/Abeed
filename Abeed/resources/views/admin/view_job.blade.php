@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Job Details</h2>
    <div class="card shadow" style="border-radius: 25px; background-color: white; padding: 20px; 
                border: 8px solid #FFB6C1; width: 500px; height: auto;">
        <h5 class="fw-bold" style="color: #805664;">{{ $job->title }}</h5>
        <p><strong style="color: #5d3b45;">Company Name:</strong> {{ $job->user->company_name ?? 'N/A' }}</p>
        <p><strong style="color: #5d3b45;">Salary Min:</strong> {{ $job->salary_min }}</p>
        <p><strong style="color: #5d3b45;">Salary Max:</strong> {{ $job->salary_max }}</p>
        <p><strong style="color: #5d3b45;">Location:</strong> {{ $job->location }}</p>
        <p><strong style="color: #5d3b45;">Application Deadline:</strong> {{ $job->application_deadline }}</p> <!-- ✅ تم إضافته -->
        <p><strong style="color: #5d3b45;">Status:</strong> {{ $job->status }}</p>
    </div>
</div>
@endsection
