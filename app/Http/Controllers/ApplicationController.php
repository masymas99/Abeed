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
            'email' => 'required|email',
            'resume' => 'required|string',

        ]);


        Application::create([
            'job_listing_id'  => $jobListing->id,
/*             'user_id'         => auth()->id(),
 */            'contact_email'   => $validated['email'],
             'user_id'         => 1,
            'resume'          => $validated['resume'],
            'status'          => 'Pending'
        ]);


        return redirect()->route('applications.my')
                         ->with('success', 'Application submitted successfully!');
    }
    public function myApplications()
{
    $applications = Application::with(['jobListing' => function ($query) {
            // تحديد الأعمدة المطلوبة من جدول job_listings
            $query->select('id', 'title', 'location', 'salary_min');
        }])
        ->where('status', 'pending')
        ->where('user_id',1)   // إظهار الطلبات التي تم قبولها فقط
/*         ->where('user_id', auth()->id()) // إظهار الطلبات الخاصة بالمستخدم الحالي
 */        ->latest()
        ->get();

    // إخراج عدد الطلبات في سجل الـ log للتأكد
    Log::info('Accepted Applications found: ' . $applications->count());

    return view('applications.my-applications', compact('applications'));
}

/* public function myApplications()
    {
        $applications = Application::with(['jobListing' => function ($query) {
            $query->select('id', 'title', 'location', 'salary_min')->where();
        }])->latest()->get();

        // Debug output
        Log::info('Applications found: ' . $applications->count());

        return view('applications.my-applications', compact('applications'));
    } */

    public function acceptedJobs()
    {
        $applications = Application::with('jobListing') // تبسيط جلب البيانات
        ->where('status', 'Accepted')
        ->where('user_id', 1)
       ->latest()
        ->get();

    return view('applications.accepted', compact('applications'));
    }






    public function edit(Application $application)
{

    return view('applications.edit', compact('application'));
}
    /* public function edit(Application $application)
    {

        if (!$application->exists) {
            $application = Application::latest()->first();

            if (!$application) {
                return redirect()->route('jobs.index')
                    ->with('error', 'No applications found to edit.');
            }
        }

        return view('applications.edit', compact('application'));
    } */

   /*  public function update(Request $request, Application $application)
    {



        $validated = $request->validate([
            'email'         => 'required|email',
            'resume'        => 'required|string',      // نفترض أن السيرة الذاتية تُخزن كنص عادي
            'cover_letter'  => 'required|string',
        ]);

        $application->update([
            'contact_email'  => $validated['email'],
            'resume'         => $validated['resume'],
            'cover_letter'   => $validated['cover_letter'],
        ]);
   /*      $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cover_letter' => 'required',
            'resume' => 'nullable|string'
        ]);

        $data = $validated;
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $application->update($data);
        return redirect()->route('applications.my')->with('success', 'Application updated successfully!'); */
    /*     return redirect()->route('applications.my')
                     ->with('success', 'تم تعديل الطلب بنجاح!');
    }  */

    public function update(Request $request, Application $application)
    {
        // التحقق من أن الطلب يخص المستخدم الحالي
      /*   if ($application->user_id !== auth()->id())
         {
            abort(403, 'Unauthorized action.');
        } */

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
