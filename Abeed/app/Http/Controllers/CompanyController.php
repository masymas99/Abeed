<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;



class CompanyController extends Controller
{


    public function index()
{
    $user = Auth::user();


    if ($user->role !== 'Employer') {
        return redirect()->route('dashboard');
    }

    $jobs = JobListing::where('status', trim('approved'))
                ->where('user_id', $user->id)
                ->get();

    return view('company.home', compact('jobs'));
}




    public function create()
    {
        return view('company.create-job');
    }

    public function destroy($id)
    {
        $job = JobListing::findOrFail($id);
        $job->delete();

        return redirect()->route('company.home')->with('success', 'Job deleted successfully!');
    }


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'salary_min' => 'required|numeric',
        'salary_max' => 'required|numeric',
        'location' => 'required|string|max:255',
        'application_deadline' => 'required|date',
        'skills_required' => 'required|string',
        'benefits' => 'required|string',
        'work_type' => 'required|in:remote,on-site',
    ]);


    JobListing::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'description' => $request->description,
        'status' => 'pending',
        'skills_required' => $request->skills_required,
        'benefits' => $request->benefits,
        'salary_min' => $request->salary_min,
        'salary_max' => $request->salary_max,
        'location' => $request->location,
        'work_type' => $request->work_type,
        'application_deadline' => $request->application_deadline,
    ]);

    return redirect()->route('company.home')->with('success', 'Job created successfully and is pending approval.');
}

public function edit($id)
{
    $job = JobListing::findOrFail($id);
    return view('company.edit-job', compact('job'));
}

public function update(Request $request, $id)
{
    $job = JobListing::findOrFail($id);
    $job->update($request->all());
    return redirect()->route('company.home')->with('success', 'Job updated successfully');
}

public function showApplications()
{
    $user = Auth::user();
    $applications = Application::with(['user', 'jobListing'])
                    ->where('status', 'pending')
                    ->whereHas('jobListing', function($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })
                    ->get();

    $acceptedApplications = Application::with(['user', 'jobListing'])
                    ->where('status', 'approved')
                    ->whereHas('jobListing', function($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })
                    ->get();

    return view('company.applications', compact('applications', 'acceptedApplications'));
}

public function approveApplication($id)
{
    $application = Application::find($id);
    if ($application) {
        $application->status = 'Accepted';
        $application->save();
    }
    return redirect()->route('company.applications');
}


public function showAcceptedApplications()
{
    $applications = Application::where('status', 'Accepted')->get();
    return view('company.accepted', compact('applications'));
}


public function rejectApplication($id)
{
    $application = Application::findOrFail($id);
    $application->status = 'Rejected';
    $application->save();

    return redirect()->route('company.applications')->with('success', 'Application rejected successfully.');
}
public function rejectApplication2($id)
{
    $application = Application::findOrFail($id);
    $application->status = 'Rejected';
    $application->save();

    return redirect()->route('company.accepted')->with('success', 'Application rejected successfully.');
}


}
