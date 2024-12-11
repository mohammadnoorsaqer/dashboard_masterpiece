<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appointment_date',
        'price',
        'coupon_id',
        'discount_amount',
        'package_id',
        'status',
        'notes',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Doctor (User with role 3)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id'); // Ensure you're using the correct column, which should be doctor_id
    }
    
    public function reviews()
{
    return $this->hasMany(Review::class);
}
public function coupon()
{
    return $this->belongsTo(Coupon::class);
}
public function package()
{
    return $this->belongsTo(Package::class);
}

}
