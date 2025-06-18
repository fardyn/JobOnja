<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class DashboardController extends Controller
{
    // @desc show all the users job listing
    // @route GET /dashboard
    public function index(Job $job) : View  {
        $user = Auth::user();
        $jobs = Job::where('user_id', $user->id)->get();
        return view('dashboard.index', compact('user','jobs'));
    }
}
