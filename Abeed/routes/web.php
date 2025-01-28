<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// الصفحة الرئيسية للمستخدمين المسجلين (توجههم إلى لوحة القيادة بناءً على الدور)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // توجيه المستخدم بناءً على الدور
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'employer') {
            return redirect()->route('employer.dashboard');
        } elseif ($user->role == 'candidate') {
            return redirect()->route('candidate.dashboard');
        }

        // في حال عدم وجود دور مناسب
        return redirect()->route('dashboard');
    })->name('dashboard');
});

// مسارات الملف الشخصي للمستخدمين
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// المسارات الخاصة بتسجيل الدخول، التسجيل، وغيرها
require __DIR__.'/auth.php';
