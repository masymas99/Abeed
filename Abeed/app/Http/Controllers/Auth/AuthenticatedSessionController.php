<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

     public function create()
     {
         return view('auth.login');
     }
    public function index(): View
    {
        $useruser = Auth::user();
        if ($useruser->role == 'Admin') {
            return view('admin.index');
        } elseif ($useruser->role == 'Employer') {
            return view('employer.index');
        } elseif ($useruser->role == 'Candidate') {
            return view('candidate.index');
        }

        return view('profile.edit');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role == 'Admin') {
            return redirect()->route('admin.home');
        } elseif ($user->role == 'Employer') {
            return redirect()->route('company.home');
        } elseif ($user->role == 'Candidate') {
            return redirect()->route('jobs.index');
        }

        return redirect()->route('dashboard');
        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
