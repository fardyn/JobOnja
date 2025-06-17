<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbordController extends Controller
{
    // @desc show all the users job listing
    // @route GET /dashbord
    public function index() : View {
        $user = auth()->user();

        $jobs = Job::where('user_id', $user->id)->get();
        dd($jobs);

    }

}
