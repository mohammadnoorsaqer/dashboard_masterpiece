<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Appointment;

class ProfileController extends Controller
{
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Fetch user's appointments
        $appointments = Appointment::where('user_id', $request->user()->id)->get();

        // Pass the user and appointments to the view
        return view('profile.edit', [
            'user' => $request->user(),
            'appointments' => $appointments,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    
     public function update(ProfileUpdateRequest $request): RedirectResponse
     {
         $user = $request->user();
     
         // Validate and handle the image upload if it exists
         if ($request->hasFile('profile_image')) {
             $request->validate([
                 'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             ]);
     
             // Handle image upload
             $imageName = time() . '.' . $request->profile_image->extension();
             $request->profile_image->move(public_path('images'), $imageName);
     
             // Update the user's image path in the database
             $user->image = $imageName;
         }
     
         // Update the user's name and email
         $user->fill($request->validated());
     
         // If the email is changed, set the email_verified_at field to null
         if ($user->isDirty('email')) {
             $user->email_verified_at = null;
         }
     
         // Save the changes to the user
         $user->save();
     
         return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
