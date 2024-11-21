<?php
// app/Http/Controllers/Admin/CommentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Show comments for an article
    public function show($articleId)
    {
        // Fetch the article and related comments
        $article = Article::findOrFail($articleId);
        $comments = $article->comments;  // Assuming there's a relationship set in the Article model

        return view('admin.articles.comment', compact('article', 'comments'));
    }

    // Store a new comment
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string|max:1000',
        ]);

        // Create a new comment
        Comment::create([
            'article_id' => $request->article_id,
            'user_id' => auth()->id(),  // Assuming the user is logged in
            'content' => $request->content,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Comment added successfully!');
    }
}
