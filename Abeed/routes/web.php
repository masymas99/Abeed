<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user(); 

        if ($user->role === 'Admin') {
            return redirect()->route('admin.show');
        } elseif ($user->role === 'employer') {
            return redirect()->route('employer.show');
        } elseif ($user->role === 'candidate') {
            return redirect()->route('candidate.show');
        }

        return redirect()->route('profile.edit');
    })->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/company/home', [CompanyController::class, 'index'])->name('company.home');
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






});
