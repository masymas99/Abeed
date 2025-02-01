<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobListingController extends Controller
{
    public function search(Request $request)
    {
        $searchjobs = JobListing::query()
            ->select('id', 'job_title', 'description', 'location', 'work_type', 'salary_min', 'salary_max')
            ->when($request->search, function ($query, $search) {
                $query->where('job_title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        // Debug output
        Log::info('Found jobs: ' . $searchjobs ->count());

        return view('jobs.index', compact('jobs'));
    }

    public function show(JobListing $jobListing)
    {
        if (!$jobListing->exists) {
            Log::error('Job not found');
            return redirect()->route('jobs.index')
                ->with('error', 'Job not found');
        }

        // Add debugging
        Log::info('JobListing ID: ' . $jobListing->id);
        Log::info('JobListing data:', $jobListing->toArray());

        return view('jobs.show', compact('jobListing'));
    }
    public function index(){
        $jobs = JobListing::with('user')->where('status', 'approved')->get();
        return view('jobs.index', compact('jobs'));
    }
}


