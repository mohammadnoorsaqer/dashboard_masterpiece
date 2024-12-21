<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index()
    {
        // Fetch all doctors from the database
        $doctors = Doctor::all(); 

        // Pass the doctors data to the view
        return view('user.doctors', compact('doctors'));
    }
    // Show dashboard
    public function dashboard()
    {
        // Get the logged-in user's ID
        $userId = auth()->id();

        // Find the doctor for the authenticated user (based on user_id in the Doctor table)
        $doctor = Doctor::where('user_id', $userId)->first();

        if (!$doctor) {
            // If the authenticated user is not a doctor, redirect them or show an error
            return redirect()->route('home')->with('error', 'You are not authorized to view this page');
        }

        // Fetch appointments for the doctor's ID (doctor_id from the appointments table)
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.dashboard', compact('appointments'));
    }

    // Update appointment status
    public function updateAppointment(Request $request, $appointmentId)
    {
        // Get the logged-in user's ID
        $userId = auth()->id();

        // Find the doctor for the authenticated user
        $doctor = Doctor::where('user_id', $userId)->first();

        if (!$doctor) {
            // If the user is not a doctor, redirect them or show an error
            return redirect()->route('home')->with('error', 'You are not authorized to update appointments');
        }

        // Find the appointment by its ID and ensure it's for the correct doctor
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($appointmentId);

        // Validate the status input (it should be one of the three valid statuses)
        $request->validate([
            'status' => 'required|in:booked,completed,canceled',
        ]);

        // Update the appointment's status
        $appointment->status = $request->status;
        $appointment->save();

        // Fetch updated appointments for the doctor
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Redirect with success message and updated appointments
        return redirect()->route('doctor.dashboard')->with('appointments', $appointments)->with('success', 'Appointment status updated successfully!');
    }
}
