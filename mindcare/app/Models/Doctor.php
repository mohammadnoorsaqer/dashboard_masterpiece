<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'specialization',
        'bio',
        'user_id',
        'email',
        'password',
        'image', 
    ];

    public function run()
{

    Doctor::factory(10)->create();  
}
public function appointments()
{
    return $this->hasMany(Appointment::class);
}
public function reviews()
{
    return $this->hasMany(Review::class, 'doctor_id', 'id'); // Assuming doctor_id exists in reviews table
}

}
