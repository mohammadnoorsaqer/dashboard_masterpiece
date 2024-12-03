<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    // Show dashboard
    public function dashboard()
    {
        // Fetch all appointments, including canceled and completed
        $appointments = Appointment::where('doctor_id', auth()->id())
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.dashboard', compact('appointments'));
    }

    // Update appointment status
    public function updateAppointment(Request $request, $appointmentId)
    {
        // Find the appointment by its ID
        $appointment = Appointment::where('doctor_id', auth()->id())
            ->findOrFail($appointmentId);

        // Validate the status input (it should be one of the three valid statuses)
        $request->validate([
            'status' => 'required|in:booked,completed,canceled',
        ]);

        // Update the appointment's status
        $appointment->status = $request->status;
        $appointment->save();

        // Fetch updated appointments for the doctor
        $appointments = Appointment::where('doctor_id', auth()->id())
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Redirect with success message and updated appointments
        return redirect()->route('doctor.dashboard')->with('appointments', $appointments)->with('success', 'Appointment status updated successfully!');
    }
}
