<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class JobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
       $jobs = Job::orderBy('created_at', 'desc')->paginate(9);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View | RedirectResponse
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


        $validatedData['user_id'] = auth()->user()->id;


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
    public function edit(Job $job) :View
    {
        $this->authorize('update', $job);
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job) : string
    {
        $this->authorize('update', $job);

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
            'company_description' => "nullable|string",
            'company_logo' => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            'company_website' => "nullable|url",
        ]);


        $validatedData['user_id'] = auth()->user()->id;


        //check for image
        if ($request->hasFile('company_logo')) {
            // Delete old logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            //store file and get path
            $path = $request->file('company_logo')->store('logos', 'public');
            $validatedData['company_logo'] = $path;
        }


        //update into database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Job $job) : RedirectResponse
    {
        $this->authorize('delete', $job);

        if ($job->company_logo) {
            Storage::delete('public/logos' . $job->company_logo);
        }

        $job->delete();

        if($request->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job Deleted successfully.');
        }

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    // @desc seach for jobs
    // @route GET /jobs/search

    public function search(Request $request) : View
    {
        $keyword = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();

        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keyword . '%'])
                ->orWhereRaw('LOWER(description) like ?', ['%' . $keyword . '%'])
                ->orWhereRaw('LOWER(tags) like ?', ['%' . $keyword . '%']);
            });
        }

        if ($location !== '') {
            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(address) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(city) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(state) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(zipcode) like ?', ['%' . $location . '%']);
            });
        }

        $jobs = $query->paginate(9);
        return view('jobs.index', compact('jobs'));

    }
}
