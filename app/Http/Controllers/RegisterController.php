<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // @desc Show register form
    // @route GET /register
    public function register() : View {
        return view('auth.register');
    }

    // @desc store user into database
    // @route POST /register
    public function store(Request $request) : RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        //hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        //Create user
        $user = User::create($validatedData);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
