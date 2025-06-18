<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    // @desc get all users bookmarks
    // @route GET /bookmarks
    public function index() : View {
        $user = Auth::user();
        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
        $job = $user->jobListing();
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);

    }

    // @desc create new bookmark
    // @route POST /bookmarks
    public function store(Job $job) : RedirectResponse {
        $user = Auth::user();
        // check if already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'You have already bookmarked this job');
        }
        $user->bookmarkedJobs()->attach($job->id);
        return back()->with('success', 'Bookmarked job successfully');
    }

    public function destroy(Job $job) : RedirectResponse {
        $user = Auth::user();
        if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {

            return back()->with('error', 'job is not bookmarked');
        }

        $user->bookmarkedJobs()->detach($job->id);
        return back()->with('success', 'Bookmark deleted successfully');
    }
}
