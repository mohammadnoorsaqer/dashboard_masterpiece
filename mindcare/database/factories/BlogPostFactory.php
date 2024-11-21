<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Generates a random user (assuming the User model has a factory)
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }
}
