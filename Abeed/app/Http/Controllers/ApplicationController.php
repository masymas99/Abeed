<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    
    public function create($jopid)
    {
        $job = JobListing::findOrFail($jopid);
        return view('application.create', compact('job'));

    }

    public function store(Request $request, $jopid){
        $request->validate([
            'cover_letter' => 'required',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
            'user_id' => 'required',


        ]);
    }
}
