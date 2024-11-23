<?php
namespace Database\Factories;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  // Creates a fake user
            'doctor_id' => Doctor::factory(),  // Creates a fake doctor
            'appointment_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'status' => $this->faker->randomElement(['booked', 'completed', 'canceled']),
            'notes' => $this->faker->sentence,
         'price' => $this->faker->randomFloat(2, 10, 1000),

        ];
    }
}
