<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoginController extends Controller
{
    // @desc Show login form
    // @route GET /login
    public function login() : View {
        return view('auth.login');
    }


    // @desc auth user
    // @route POST /login
    public function authenticate(Request $request) : RedirectResponse {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);


        // attempt to auth user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Login successful!');
        }



        return back()->withErrors(["email" => "These credentials do not match our records."])->onlyInput("email");

    }

    // @desc Show logout user
    // @route GET /logout
    public function logout() : redirectResponse {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/")->with('success', 'You have been logged out!');
    }
}
