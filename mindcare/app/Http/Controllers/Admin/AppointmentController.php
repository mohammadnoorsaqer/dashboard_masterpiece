<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Coupon; // Import Coupon model
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.appointments.index', compact('appointments',));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Validate the status
        $request->validate([
            'status' => 'required|in:booked,completed,canceled',
        ]);

        // Update the status
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('admin.appointments.index');
    }
}
