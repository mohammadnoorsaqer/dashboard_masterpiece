<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    // Show dashboard
    public function dashboard()
    {
        $appointments = Appointment::where('doctor_id', auth()->id())
            ->where('status', 'booked') // Show only booked appointments
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.dashboard', compact('appointments'));
    }

    // Update appointment status
    public function updateAppointment(Request $request, $appointmentId)
    {
        $appointment = Appointment::where('doctor_id', auth()->id())
            ->findOrFail($appointmentId);

        $request->validate([
            'status' => 'required|in:accepted,canceled',
        ]);

        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('doctor.dashboard')->with('success', 'Appointment status updated successfully!');
    }
}
