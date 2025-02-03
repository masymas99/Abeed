<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class JobListingController extends Controller
{



    public function search(Request $request)
{

    $searchjobs = JobListing::query()
        ->select('id', 'title', 'description', 'location', 'work_type', 'salary_min', 'salary_max', 'user_id')
        ->where('status', 'approved')
        ->when($request->search, function ($query) use ($request) {

            $query->where('title', 'like', "%{$request->search}%")
                ->orWhere('work_type', 'like', "%{$request->search}%")

                ->orWhere('description', 'like', "%{$request->search}%")
                ->orWhere('location', 'like', "%{$request->search}%");
        })
        ->when($request->work_type, function ($query) use ($request) {
            $query->where('work_type', $request->work_type);
        })
        ->when($request->salary_min, function ($query) use ($request) {
            $query->where('salary_min', '>=', $request->salary_min);
        })
        ->when($request->salary_max, function ($query) use ($request) {
            $query->where('salary_max', '<=', $request->salary_max);
        })
        ->with('user')
        ->latest()
        ->get();

    Log::info('Found jobs: ' . $searchjobs->count());

    return view('jobs.index', ['jobs' => $searchjobs]);
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

