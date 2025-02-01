<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobCategoryController extends Controller
{
    function index()
    {

        $user = Auth::user();

    if ($user->role === 'Admin') {
        return view('admin.index');
    } elseif ($user->role === 'employer') {
        return view('employer.index');
    } elseif ($user->role === 'candidate') {
        return view('candidate.index');
    }

    return view('profile.edit');
    }
}
