<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        $users = User::all();
        return view('admin.appointments.create', compact('doctors', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:booked,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        Appointment::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.appointments.index');
    }
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
    
        // Validate the status to ensure it is one of the allowed values
        $request->validate([
            'status' => 'required|in:booked,completed,canceled',
        ]);
    
        // Update the status
        $appointment->status = $request->status;
        $appointment->save();
    
        // Return a success message
        return redirect()->route('admin.appointments.index');
    }
    
}

