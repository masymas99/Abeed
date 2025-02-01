<?php

use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobListingController::class, 'index'])->name('home');
Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{jobListing}', [JobListingController::class, 'show'])->name('jobs.show');


Route::get('/jobs/{jobListing}/apply', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('/jobs/{jobListing}/apply', [ApplicationController::class, 'store'])->name('applications.store');
Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.my');
Route::get('/accepted-jobs', [ApplicationController::class, 'acceptedJobs'])->name('applications.accepted');
Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
