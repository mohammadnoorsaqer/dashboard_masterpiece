<?php
// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Define the relationship to the article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Define the relationship to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The fillable fields
    protected $fillable = ['article_id', 'user_id', 'content'];
}