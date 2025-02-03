<?php

use App\Http\Controllers\Admin\ExampleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


//  rawda routes

Route::get('admin', [AdminController::class, 'home'])->name('admin.home');


// قبول الوظيفة (POST)
Route::post('/admin/job/accept/{id}', [AdminController::class, 'acceptJob'])->name('admin.acceptJob');

// رفض الوظيفة (POST)
Route::post('/admin/job/reject/{id}', [AdminController::class, 'rejectJob'])->name('admin.rejectJob');

// عرض تفاصيل الوظيفة
Route::get('/admin/job/view/{id}', [AdminController::class, 'viewJob'])->name('admin.viewJob');

// عرض جميع الوظائف المقبولة
Route::get('/admin/all-jobs', [AdminController::class, 'allJobs'])->name('admin.allJobs');

// حذف الوظيفة
Route::delete('/admin/job/delete/{id}', [AdminController::class, 'deleteJob'])->name('admin.deleteJob');

// عرض قائمة المستخدمين
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');








// Route::get('admin', [ExampleController::class, 'index'])->name('admin.index');
// Route::get('admin/{id}', [ExampleController::class, 'show'])->name('admin.show');

// Route::patch('admin/{id}/accept', [ExampleController::class, 'accept'])->name('admin.accept');

// Route::get('employer', [AuthenticatedSessionController::class, 'index'])->name('employer.index');
Route::get('candidate', [AuthenticatedSessionController::class, 'index'])->name('candidate.index');

// Route::get('/company/home', [CompanyController::class, 'index'])->name('company.home');
Route::get('/jobs/search', [JobListingController::class, 'search'])->name('jobs.search');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role == 'Admin') {
            return view('admin.home');
        } elseif ($user->role == 'Employer') {
            return view('company.home');
        } elseif ($user->role == 'Candidate') {
            return view('jobs.index');
        }
        return view('/welcome');

    })
    ->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/company/', [CompanyController::class, 'index'])->name('company.home');
    Route::get('/company/create-job', [CompanyController::class, 'create'])->name('company.create-job');
    Route::post('/company/store-job', [CompanyController::class, 'store'])->name('company.store-job');
    Route::get('/company/job/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit-job');
    Route::put('/company/job/{id}', [CompanyController::class, 'update'])->name('company.update-job');
    Route::delete('/company/jobs/{id}', [CompanyController::class, 'destroy'])->name('company.delete-job');
    Route::get('/company/applications', [CompanyController::class, 'showApplications'])->name('company.applications');
    Route::get('/company/accepted', [CompanyController::class, 'showAcceptedApplications'])->name('company.accepted');
    Route::post('/company/approve-application/{id}', [CompanyController::class, 'approveApplication'])->name('company.approve-application');
    Route::post('company/reject-application/{application}', [CompanyController::class, 'rejectApplication'])->name('company.reject-application');
    Route::post('company/reject-application2/{application}', [CompanyController::class, 'rejectApplication2'])->name('company.reject-application2');

    //  mostafa routes

Route::get('/jobs/view', [JobListingController::class, 'index'])->name('Jhome.index');
Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{jobListing}', [JobListingController::class, 'show'])->name('jobs.show');


Route::get('/jobs/{jobListing}/apply', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('/jobs/{jobListing}/apply', [ApplicationController::class, 'store'])->name('applications.store');
Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.my');
Route::get('/accepted-jobs', [ApplicationController::class, 'acceptedJobs'])->name('applications.accepted');
Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
Route::get('/jobs/search', [JobListingController::class, 'search'])->name('jobs.search');



});

require __DIR__.'/auth.php';

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

