<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Generate fake reviews using the factory
        Review::factory(10)->create();  // Adjust the number to whatever you need
    }
}
