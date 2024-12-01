<?php
// UserAppointmentController.php

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
        // Validate the incoming request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensure the user exists
            'doctor_id' => 'required|exists:doctors,id',  // Ensure doctor exists
            'appointment_date' => 'required|date|after:today',  // Ensure valid future appointment date
            'price' => 'required|numeric',
            'notes' => 'nullable|string',
            'coupon_code' => 'nullable|string'  // Coupon code is optional
        ]);
        
        // Initialize coupon-related variables
        $coupon = null;
        $discountAmount = 0;
    
        // Check if a coupon code was applied
        if ($request->has('coupon_code') && !empty($request->coupon_code)) {
            // Get the coupon by code
            $coupon = Coupon::where('code', $request->coupon_code)->first();
    
            // If coupon exists and is active, and within the valid date range
            if ($coupon && $coupon->status == 'active' && Carbon::now()->between($coupon->valid_from, $coupon->valid_until)) {
                // Calculate discount based on coupon percentage
                $discountAmount = ($coupon->discount_percentage / 100) * $request->price;
            } else {
                // Invalid coupon, return an error
                return redirect()->route('user.pricing')->with('error', 'Invalid or expired coupon code');
            }
        }
    
        // Calculate final price after applying discount
        $finalPrice = $request->price - $discountAmount;
    
        // Create a new appointment record
        $appointment = new Appointment();
        $appointment->user_id = $request->user_id;
        $appointment->doctor_id = $request->doctor_id;  // Store the selected doctor ID
        $appointment->appointment_date = $request->appointment_date;
        $appointment->original_price = $request->price;  // Store the original price
        $appointment->price = $finalPrice;  // Store the final price after discount
        $appointment->notes = $request->notes;
        $appointment->status = 'booked';  // Set the status as 'booked'
    
        // If a coupon was applied, store coupon-related information
        if ($coupon) {
            $appointment->coupon_id = $coupon->id;  // Store the applied coupon's ID
            $appointment->discount_amount = $discountAmount;  // Store the discount amount
        }
    
        // Save the appointment record to the database
        $appointment->save();
    
        // Redirect or return response with success message
        return redirect()->route('user.pricing')->with('success', 'Appointment booked successfully');
    }
    
        
}
