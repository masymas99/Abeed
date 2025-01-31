<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    public function apply($id)
    {
        $job = Job::findOrFail($id);
        return view('applications.create', compact('job'));
    }

    public function submitApplication(Request $request)
    {
        // Handle form submission
        return redirect()->route('home')->with('success', 'Application submitted successfully!');
    }

    public function accepted($id)
    {
        $job = Job::findOrFail($id);
        return view('accepted', compact('job'));
    }
}
