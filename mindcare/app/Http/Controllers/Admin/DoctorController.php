<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3, // Role 3 = Doctor
        ]);
        Doctor::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),

            'specialization' => $request->specialization,
            'bio' => $request->bio,
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
        ]);

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $doctor->password, 
            'specialization' => $request->specialization,
            'bio' => $request->bio,
        ]);

        return redirect()->route('admin.doctors.index');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('admin.doctors.index');
    }
}
