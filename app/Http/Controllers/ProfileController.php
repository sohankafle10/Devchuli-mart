<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Fill validated data into the user
        $user->fill($request->validated());

        // Check if email is updated and set the email_verified_at field to null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Update profile picture if a new file is uploaded
        if ($request->hasFile('profilepicture')) {
            // Delete old profile picture if it exists
            $oldprofilepicture = $user->profilepicture;

            if ($oldprofilepicture && file_exists(public_path('images/profilepictures/' . $oldprofilepicture))) {
                unlink(public_path('images/profilepictures/' . $oldprofilepicture));  // Delete the old profile picture
            }

            // Store new profile picture and update the database
            $profilepicture = $request->file('profilepicture');
            $profilepictureName = time() . '.' . $profilepicture->getClientOriginalExtension();  // Create a unique name
            $profilepicture->move(public_path('images/profilepictures'), $profilepictureName);  // Store the picture

            // Update the user's profile picture in the database
            $user->profilepicture = $profilepictureName;
        }


        // Save the updated user data
        $user->save();

        // Redirect with success message
        return Redirect::route('profile.edit')->with('success', 'Profile Updated Successfully');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
