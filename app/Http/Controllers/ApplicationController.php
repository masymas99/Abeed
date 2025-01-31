<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create(JobListing $jobListing)
    {
        return view('applications.create', compact('jobListing'));
    }

    public function store(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'resume' => 'required|file|mimes:pdf,doc,docx',
            'cover_letter' => 'required'
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        Application::create([
            'job_listing_id' => $jobListing->id,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'resume_path' => $resumePath,
            'cover_letter' => $validated['cover_letter'],
            'status' => 'pending'
        ]);

        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully!');
    }

    public function myApplications()
    {
        $applications = Application::with('jobListing')->latest()->get();
        return view('applications.my-applications', compact('applications'));
    }

    public function acceptedJobs()
    {
        $applications = Application::with('jobListing')
            ->where('status', 'accepted')
            ->latest()
            ->get();
        return view('applications.accepted', compact('applications'));
    }
}
