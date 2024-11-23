<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageAdminsController extends Controller
{
    // Show all admins (role == 1)
    public function index()
    {
        // Get all users with role 1 (admin)
        $admins = User::where('role', 1)->get();

        // Return the view with the admins data
        return view('admin.manageadmins.index', compact('admins'));
    }

    // Show the form to create a new admin
    public function create()
    {
        return view('admin.manageadmins.create');
    }

    // Store a new admin
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new admin user
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->role = 1;  // Admin role
        $admin->save();

        // Redirect to admin management with success message
        return redirect()->route('admin.manageadmins.index')->with('success', 'Admin created successfully!');
    }

    // Show the form to edit an existing admin
    public function edit($id)
    {
        // Find the admin by id
        $admin = User::findOrFail($id);

        // Return the view to edit the admin
        return view('admin.manageadmins.edit', compact('admin'));
    }

    // Update an admin
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the admin by id
        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        // Redirect to the admin management page with success message
        return redirect()->route('admin.manageadmins.index')->with('success', 'Admin updated successfully!');
    }
    public function destroy($id)
{
    // Find the admin by id
    $admin = User::findOrFail($id);

    // Ensure the admin being deleted is not the currently authenticated user
    if ($admin->id == auth()->id()) {
        return redirect()->route('admin.manageadmins.index')->with('error', 'You cannot delete your own account.');
    }

    // Delete the admin
    $admin->delete();

    // Redirect back with success message
    return redirect()->route('admin.manageadmins.index')->with('success', 'Admin deleted successfully!');
}

}
