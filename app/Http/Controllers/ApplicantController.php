<?php

namespace App\Http\Controllers;

use App\Models\applicants;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Models\Job;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Redirector;





class ApplicantController extends Controller
{


    public function store(Request $request, Job $job) : RedirectResponse {

        //check if user already applied
        $existingApplication = applicants::where('job_id', $job->id)
                                            ->where('user_id', auth()->user()->id)
                                            ->exists();

        if ($existingApplication) {
            return Redirect::back()->with(['error' => 'You have already applied for this job']);
        }
        // validation in request
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'message' => 'string|max:255',
            'contact_number' => 'string|max:255',
            'location' => 'string|max:255',
            'resume_path' => 'mimes:doc,docx,pdf|max:2048'
        ]);
        // handle resume upload
        if($request->hasFile('resume_path')) {
            $path = $request->file('resume_path')->store('resumes', 'public');
            $validatedData['resume_path'] = $path;
        }

        //store the application
        $applicant = new applicants($validatedData);
        $applicant->job_id = $job->id;
        $applicant->user_id = auth()->id();
        $applicant->save();

        return redirect('/jobs');
    }

    // @desc delete job applicant
    // @route DELETE /applicant/{applicant}

    public function destroy($id) : RedirectResponse
    {
        $applicant = applicants::findOrfail($id);
        $applicant->delete();
        return redirect('dashboard')->with('success', 'Applicant deleted successfully');
    }
}
