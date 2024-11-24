<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UserCouponController extends Controller
{
    public function checkCoupon(Request $request)
    {
        // Validate the coupon code input
        $couponCode = $request->query('coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();

        if ($coupon) {
            // Check if the coupon is active and within the valid date range
            $currentDate = Carbon::now();
            if ($coupon->status == 'active' && $currentDate->between($coupon->valid_from, $coupon->valid_until)) {
                return response()->json([
                    'success' => true,
                    'discount_percentage' => $coupon->discount_percentage
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon has expired or is not active.'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Coupon code not found.'
            ]);
        }
    }
}
