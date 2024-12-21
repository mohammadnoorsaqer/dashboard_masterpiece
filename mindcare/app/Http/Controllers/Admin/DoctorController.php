<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all(); 
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'specialization' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the image directly in the public/images directory
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
    
        // Create the user (doctor's account)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3, // Role 3 = Doctor
        ]);
    
        // Create the doctor record
        Doctor::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'specialization' => $request->specialization,
            'bio' => $request->bio,
            'image' => $imageName, // Save the image name
        ]);
    
        return redirect()->route('admin.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'password' => 'nullable|string|min:6',
            'specialization' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($doctor->image && file_exists(public_path('images/' . $doctor->image))) {
                unlink(public_path('images/' . $doctor->image));
            }
    
            // Store new image directly in public/images/
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
    
            // Update the image path in the database
            $doctor->image = $imageName;
        }
    
        // Update other fields
        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $doctor->password,
            'specialization' => $request->specialization,
            'bio' => $request->bio,
        ]);
    
        return redirect()->route('admin.doctors.index');
    }
    public function destroy(Doctor $doctor)
    {
        // Delete the image file before deleting the doctor record
        if ($doctor->image) {
            Storage::delete('public/images/' . $doctor->image); // Delete the image from storage
        }

        $doctor->delete();

        return redirect()->route('admin.doctors.index');
    }
}
