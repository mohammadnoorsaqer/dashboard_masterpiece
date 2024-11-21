<?php
namespace Database\Seeders;

use App\Models\Review;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // Get some random appointments and users
        $appointments = Appointment::all();
        $users = User::all();

        // Add some reviews for random appointments
        foreach ($appointments as $appointment) {
            // Pick a random user to leave a review
            $user = $users->random();

            // Create a review with 'pending' status
            Review::create([
                'appointment_id' => $appointment->appointment_id,
                'user_id' => $user->user_id,
                'status' => 'pending', // Start with a pending status
                'comments' => 'This review is pending.', // Optional comment
            ]);
        }
    }
}
