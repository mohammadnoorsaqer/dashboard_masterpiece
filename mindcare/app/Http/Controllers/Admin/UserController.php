<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 0)->paginate(10);  // Fetch only users with role 0 (normal users)
        return view('admin.users.index', compact('users'));
    }
    

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive',
        ]);
    
        // Check if the email exists in inactive users
        $existingUser = User::where('email', $validated['email'])->where('status', 'inactive')->first();
    
        if ($existingUser) {
            // If the user is found as inactive, return an error message
            return redirect()->route('admin.users.create')
                             ->with('error', 'This email is associated with a deactivated account. Please contact support or use a different email.');
        }
    
        // Create the new user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'status' => $validated['status'],
        ]);
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:active,inactive',
        ]);

        // Find and update the user
        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }

        $user->status = $validated['status'];
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';  // Or whatever activation logic you need
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'inactive';  // Deactivate the user
        $user->save();

        return redirect()->route('admin.users.index');
    }
}
