<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         $user = Auth::user();

//         if ($user->role == 'admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($user->role == 'employer') {
//             return redirect()->route('employer.dashboard');
//         } elseif ($user->role == 'candidate') {
//             return redirect()->route('candidate.dashboard');
//         }


//         return redirect()->route('dashboard');
//     })->name('dashboard');



// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
