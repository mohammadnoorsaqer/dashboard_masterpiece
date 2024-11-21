<?php
// database/seeders/CommentSeeder.php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Check if any articles exist, if not create one
        $article = Article::first();

        if (!$article) {
            // Create a new article if none exist
            $article = Article::create([
                'title' => 'Sample Article',
                'content' => 'This is a sample article for seeding purposes.',
                // Add other necessary fields here if required
            ]);
        }

        // Assuming there's at least one user in the database
        $user = User::first(); // You can customize this to choose a specific user

        Comment::create([
            'article_id' => 1,
            'user_id' => $user->id,
            'content' => 'This is a great article! Thank you for sharing.',
        ]);
    }
}
