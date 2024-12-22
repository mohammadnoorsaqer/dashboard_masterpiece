<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Package;
use App\Models\Doctor;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserAppointmentController extends Controller
{
    public function index()
    {
        // Fetch packages for pricing (assuming a Package model exists)
        $packages = Package::all();

        // Fetch doctors (if you want to display available doctors for the user to choose from)
        $doctors = Doctor::all();

        // Pass the data to the view
        return view('user.pricing', compact('packages', 'doctors'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'package_id' => 'required|exists:packages,id',
            'appointment_date' => 'required|date|after:today',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
            'coupon_id' => 'nullable|exists:coupons,id',
            'notes' => 'nullable|string',
        ]);
    
        // Check if the user already has a booked appointment for the same doctor and package
        $existingAppointment = Appointment::where('user_id', $validated['user_id'])
            ->where('doctor_id', $validated['doctor_id'])
            ->where('package_id', $validated['package_id'])
            ->where('status', '!=', 'completed') // Ensure it's not completed
            ->first();
    
            if ($existingAppointment) {
                // Return a JSON response indicating the booking already exists
                return response()->json(['error' => 'You already have an active appointment for this doctor and package. Please complete or cancel it before booking again.'], 400);
            }
    
        // Create new appointment
        $appointment = new Appointment();
        $appointment->user_id = $validated['user_id'];
        $appointment->doctor_id = $validated['doctor_id'];
        $appointment->package_id = $validated['package_id'];
        $appointment->appointment_date = $validated['appointment_date'];
        $appointment->price = $validated['price'];
        $appointment->original_price = $validated['original_price'];
        $appointment->discount_amount = $validated['discount_amount'] ?? 0;
        $appointment->coupon_id = $validated['coupon_id'] ?? null;
        $appointment->notes = $validated['notes'] ?? null;
        $appointment->status = 'booked'; // Default to "booked" status
    
        // Save the appointment to the database
        $appointment->save();
    
        return redirect()->route('user.pricing')->with('success', 'Appointment booked successfully');
    }
    
    
}
