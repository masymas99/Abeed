<?php

use App\Http\Controllers\Admin\ExampleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('employer', [AuthenticatedSessionController::class, 'index'])->name('employer.index');
Route::get('candidate', [AuthenticatedSessionController::class, 'index'])->name('candidate.index');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {



        $user = Auth::user();
        if ($user->role == 'Admin') {
            return view('admin.home');
        } elseif ($user->role == 'Employer') {
            return view('employer.index');
        } elseif ($user->role == 'Candidate') {
            return view('candidate.index');
        }

        return view('profile.edit');





    })
    ->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

