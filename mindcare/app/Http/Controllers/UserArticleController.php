<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
    // Display all articles for the users
    public function index()
    {
        // Fetch all articles ordered by the latest
        $articles = Article::latest()->get();  // You can add pagination if needed
        return view('user.articles', compact('articles'));
    }

    // Show the details of a single article
    public function show($id)
    {
        $article = Article::findOrFail($id); // Find article by ID
        return view('user.article', compact('article'));
    }
}
