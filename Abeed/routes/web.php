<?php
 use App\Http\Controllers\ProfileController;
 use Illuminate\Support\Facades\Route;
 //use Illuminate\Support\Facades\Auth;
 

 
 use App\Http\Controllers\AdminController;
 
 
 
 

 Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
 
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
 


 

 
 




  Route::get('/', function () { 
    return view('welcome'); 
  });

//Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', function () {
    //     $user = Auth::user();

    //     if ($user->role == 'admin') {
    //         return redirect()->route('admin.dashboard');
    //     } elseif ($user->role == 'employer') {
    //         return redirect()->route('employer.dashboard');
    //     } elseif ($user->role == 'candidate') {
    //         return redirect()->route('candidate.dashboard');
    //     }


    //     return redirect()->route('dashboard');
    // })->name('dashboard'); 



//}); 

//Route::middleware('auth')->group(function () {  
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

// require __DIR__.'/auth.php';
