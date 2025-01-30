<?php

use App\Http\Controllers\Admin\ExampleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
//  route for admin WITH resource

Route::get('admin', [AuthenticatedSessionController::class, 'index'])->name('admin.index');
Route::get('employer', [AuthenticatedSessionController::class, 'index'])->name('employer.index');
Route::get('candidate', [AuthenticatedSessionController::class, 'index'])->name('candidate.index');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {



        $user = Auth::user();
        if ($user->role == 'Admin') {
            return view('admin.index');
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

