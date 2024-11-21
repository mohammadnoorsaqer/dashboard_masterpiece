<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_url',
        'user_id',
    ];
    protected $primaryKey = 'article_id';

    // Relationship with User (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
