<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Http\Request;// /
use Carbon\Carbon;//

class AdminController extends Controller 
{
    
    public function home()
    {
        $jobs = JobListing::where('status', 'pending')->with('user')->get();
        return view('admin.home', compact('jobs'));
    }

    // قبول الوظيفة
    public function acceptJob($id)//
    {
        $job = JobListing::find($id);

        if ($job) {
            $job->status = 'approved';
            $job->updated_at = Carbon::now();
            $job->save();
        }

        return redirect()->route('admin.home')->with('success', 'Job accepted successfully!');
    }

    // رفض الوظيفة
    public function rejectJob($id)
    {
        $job = JobListing::find($id);

        if ($job) {
            $job->status = 'rejected';
            $job->updated_at = Carbon::now();
            $job->save();
        }

        return redirect()->route('admin.home')->with('success', 'Job rejected successfully!');
    }

    // عرض تفاصيل الوظيفة
    public function viewJob($id)
    {
        $job = JobListing::with('user')->find($id);

        if ($job) {
            return view('admin.view_job', compact('job'));
        }

        return redirect()->route('admin.home')->with('error', 'Job not found');
    }

    // عرض الوظائف المقبولة
    public function allJobs()
    {
        $jobs = JobListing::where('status', 'approved')->with('user')->get();
        return view('admin.all_jobs', compact('jobs'));
    }

    // حذف الوظيفة
    public function deleteJob($id)
    {
        $job = JobListing::find($id);

        if ($job) {
            $job->delete();
        }

        return redirect()->route('admin.allJobs')->with('success', 'Job deleted successfully!');
    }

    // عرض قائمة المستخدمين
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
}
