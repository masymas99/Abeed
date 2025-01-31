<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
    {
        $jopListings = JobListing::with('user')->latest()->paginate(10);
        return view('job-listing.index', data: compact('jobListings'));
    }

    public function show($id)  // ========> This method is used to display a single job listing.
    {
        $jobListing = JobListing::findOrFail($id);
        $jobListing->load('user', 'categories');
        return view('job-listing.show', data: compact('jobListing'));
    }


}

