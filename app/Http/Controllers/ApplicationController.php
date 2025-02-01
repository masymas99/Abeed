<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;

class ApplicationController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create(JobListing $jobListing)
    {
        return view('applications.create', compact('jobListing'));
    }

    public function store(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'resume' => 'required|file|mimes:pdf,doc,docx,txt,rtf,odt',
            'cover_letter' => 'required'
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        Application::create([
            'job_id' => $jobListing->id,
            'user_id' => 1,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'resume_path' => $resumePath,
            'cover_letter' => $validated['cover_letter'],
            'status' => 'pending'
        ]);

        return redirect()->route('applications.my')
            ->with('success', 'Application submitted successfully!');
    }

    public function myApplications()
    {
        $applications = Application::with(['jobListing' => function ($query) {
            $query->select('id', 'job_title', 'location', 'salary_min');
        }])->latest()->get();

        // Debug output
        Log::info('Applications found: ' . $applications->count());

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

    public function edit(Application $application)
    {

        if (!$application->exists) {
            $application = Application::latest()->first();

            if (!$application) {
                return redirect()->route('jobs.index')
                    ->with('error', 'No applications found to edit.');
            }
        }

        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'cover_letter' => 'required',
            'resume' => 'nullable|file|mimes:pdf,doc,docx,txt,rtf,odt'
        ]);

        $data = $validated;
        if ($request->hasFile('resume')) {
            $data['resume_path'] = $request->file('resume')->store('resumes', 'public');
        }

        $application->update($data);
        return redirect()->route('applications.my')->with('success', 'Application updated successfully!');
    }
}
