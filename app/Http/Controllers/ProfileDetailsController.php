<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileDetailsController extends Controller
{
    // Show profile
    public function show()
    {
        $user = Auth::user();
        return view('profile.profiledetails', compact('user'));
    }

    // Show edit form
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birthdate' => 'nullable|date',
            'nid' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile_photos', 'public');
            $data['photo'] = $path;
        }

        $user->update($data);

        return redirect()->route('profiledetails.show')->with('success', 'Profile updated successfully!');
    }
}
