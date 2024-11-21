<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // Insert data into the reviews table
        DB::table('reviews')->insert([
            [
                'appointment_id' => 1, // Replace with an existing appointment ID
                'user_id' => 1,        // Replace with an existing user ID
                'status' => 'approved', // 'approved' or 'pending' (adjust as needed)
                'comments' => 'Great service, very professional!', // Example comment
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'appointment_id' => 2,
                'user_id' => 2,
                'status' => 'pending',
                'comments' => 'It was okay, but there were delays.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            // Add more records as needed
        ]);
    }
}
