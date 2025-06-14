<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
       $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => "required|string|max:255",
            'description' => "required|string",
            'salary' => "required|integer",
            'tags' => "nullable|string",
            'job_type' => "required|string",
            'remote' => "required|in:True,False",
            'requirements' => "nullable|string",
            'benefits' => "nullable|string",
            'address' => "required|string",
            'city' => "required|string",
            'state' => "required|string",
            'zipcode' => "nullable|string",
            'contact_email' => "required|string",
            'contact_phone' => "nullable|string",
            'company_name' => "required|string",
            'company_description' => "required|string",
            'company_logo' => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            'company_website' => "nullable|url",
        ]);


        //hard coded user ID
        $validatedData['user_id'] = 1;


        //check for image
        if ($request->hasFile('company_logo')) {
                //store file and get path
            $path = $request->file('company_logo')->store('logos', 'public');
            $validatedData['company_logo'] = $path;
        }


        //submit into database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job) : View
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job) : RedirectResponse
    {
        if ($job->company_logo) {
            Storage::delete('public/logos' . $job->company_logo);
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
