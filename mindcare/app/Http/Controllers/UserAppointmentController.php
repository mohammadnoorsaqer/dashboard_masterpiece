<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserAppointmentController extends Controller
{
    public function bookAppointment(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'price' => 'required|numeric',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'coupon_code' => 'nullable|string|exists:coupons,code', // Coupon code must exist in the database
        ]);

        // Fetch coupon if exists and validate it
        $coupon = null;
        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)
                            ->where('status', 1) // Ensure coupon is active
                            ->where('valid_from', '<=', Carbon::now()) // Coupon valid from this date
                            ->where('valid_until', '>=', Carbon::now()) // Coupon valid until this date
                            ->first();

            if (!$coupon) {
                return back()->withErrors(['coupon_code' => 'Invalid or expired coupon code.']);
            }
        }

        // Calculate discount amount (if coupon exists)
        $discountAmount = 0;
        if ($coupon) {
            $discountAmount = ($validated['price'] * $coupon->discount_percentage) / 100;
        }

        // Ensure the discount doesn't exceed the original price
        $discountAmount = min($discountAmount, $validated['price']);

        // Calculate final price (price - discount)
        $finalPrice = $validated['price'] - $discountAmount;

        // Create the appointment record
        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id; // Assuming user is logged in
        $appointment->doctor_id = 1; // Example doctor ID, change as per your logic
        $appointment->appointment_date = $validated['appointment_date'];
        $appointment->notes = $validated['notes'];
        $appointment->price = $validated['price'];
        $appointment->discount_amount = $discountAmount;
        // No final_price column, so only save price and discount_amount
        $appointment->coupon_id = $coupon ? $coupon->id : null;

        $appointment->save();

        // Return success message
        // return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }
}
