<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::latest();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('job_title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $jobs = $query->get();
        return view('jobs.index', compact('jobs'));
    }

    public function show(JobListing $jobListing)
    {
        return view('jobs.show', compact('jobListing'));
    }
}
