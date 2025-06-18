<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //@desc update profile info
    //@route PUT /profile

    public function update(Request $request) : RedirectResponse {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'avatar' => 'nullable|file|max:2048|mimes:jpeg,jpg,png,gif',
        ]);

        // get users email and name
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // if there is file delete it
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            // store avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }
}
