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
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'price' => 'required|numeric',
            'coupon_code' => 'nullable|string|exists:coupons,code',
            'status' => 'required|in:booked,completed,canceled',
            'notes' => 'nullable|string',
        ]);
    
        // Check for coupon
        $coupon = null;
        $discountAmount = 0;
    
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)
                ->where('status', 'active')
                ->where('valid_from', '<=', now())
                ->where('valid_until', '>=', now())
                ->first();
    
            if ($coupon) {
                $discountAmount = ($request->price * $coupon->discount_percentage) / 100;
            }
        }
    
        // Calculate the final price
        $finalPrice = $request->price - $discountAmount;
    
        // Create the appointment
        Appointment::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'price' => $finalPrice,
            'coupon_id' => $coupon?->id,
            'discount_amount' => $discountAmount,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
    
        // Flash success message and redirect back to the pricing page
        session()->flash('message', 'Appointment booked successfully!');
    
        return redirect()->route('user.pricing'); // Ensure this points to the correct route for pricing
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
