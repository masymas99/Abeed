<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();


        $validated = $request->validate([
            'email' => 'required|email',
            'resume' => 'required|string',
            'contact_phone' => 'required|string',


        ]);


        Application::create([
            'job_listing_id'  => $jobListing->id,
            'user_id'         => $user->id,
             'contact_email'   => $validated['email'],
            'resume'          => $validated['resume'],
            'status'          => 'Pending',
            'contact_phone'   => $validated['contact_phone'],
        ]);


        return redirect()->route('applications.my')
                         ->with('success', 'Application submitted successfully!');
    }
    public function myApplications()
{
    $user = Auth::user();

    $applications = Application::with('jobListing')->where('user_id', $user->id)->where('status', 'Pending')->get();

    // إخراج عدد الطلبات في سجل الـ log للتأكد
    Log::info('Accepted Applications found: ' . $applications->count());

    return view('applications.my-applications', compact('applications'));
}


    public function acceptedJobs()
    {
        $user = Auth::user();

        $applications = Application::with('jobListing') // تبسيط جلب البيانات
        ->where('status', 'Accepted')
        ->where('user_id', $user->id)
       ->latest()
        ->get();

    return view('applications.accepted', compact('applications'));
    }






    public function edit(Application $application)
{

    return view('applications.edit', compact('application'));
}

    public function update(Request $request, Application $application)
    {


        // السماح بالتعديل فقط إذا كانت الحالة "Pending"
        if ($application->status !== 'Pending') {
            return redirect()->route('applications.my')
                ->with('error', 'لا يمكنك تعديل الطلب بعد أن يتم قبوله أو رفضه.');
        }

        // التحقق من صحة البيانات المُدخلة
        // نستخدم هنا أن حقل "resume" نص عادي
        $validated = $request->validate([
            'email'         => 'required|email',
            'resume'        => 'required|string',
            'contact_phone'  => 'required|string',
        ]);

        // تحديث بيانات الطلب
        $application->update([
            'contact_email' => $validated['email'],
            'resume'        => $validated['resume'],
            'cover_letter'  => $validated['cover_letter'],
        ]);

        return redirect()->route('applications.my')
                         ->with('success', 'تم تعديل الطلب بنجاح!');
    }



}
