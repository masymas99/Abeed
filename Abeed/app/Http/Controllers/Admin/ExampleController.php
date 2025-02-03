<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Example;
use App\Models\JobListing;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admindata = JobListing::with('user')->where('status', 'pending')->get();
        return view('admin.index', compact('admindata'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $job = JobListing::with('user')->findOrFail($id);

    return view('admin.show', compact('job'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function accept($id)
    {
        $job = JobListing::findOrFail($id);
        $job->status = 'approved';
        $job->save();

        return redirect()->route('admin.index');
    }


     public function edit(Example $example)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Example $example)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Example $example)
    {
        //
    }
}

