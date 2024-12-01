<?php
// app/Http/Controllers/Admin/CommentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
{
    // Fetch all comments with their status
    $comments = Comment::with('article', 'user')->get();
    return view('admin.articles.comment', compact('comments'));
 
}
public function show($articleId)
{
    // Fetch the article and related comments
    $article = Article::findOrFail($articleId);
    $comments = $article->comments;  // Assuming there's a relationship set in the Article model

    return view('admin.articles.comment', compact('article', 'comments'));
}
    // Store a new comment
// app/Http/Controllers/CommentController.php


public function store(Request $request)
{
    // Validate the comment data
    $request->validate([
        'content' => 'required|string|max:1000',
        'article_id' => 'required|exists:articles,article_id',
    ]);

    // Store the comment with 'pending' status
    $comment = new Comment();
    $comment->content = $request->content;
    $comment->article_id = $request->article_id;
    $comment->user_id = auth()->id(); // associate with logged-in user
    $comment->status = 'pending'; // comment is pending approval
    $comment->save();

    // Redirect back to the article page with a success message
    return redirect()->back()->with('message', 'Your comment has been submitted successfully and is under review.');

}




public function updateStatus(Request $request, Comment $comment)
{
    // Validate the status input
    $request->validate([
        'status' => 'required|in:pending,approved,rejected', // Valid status values
    ]);

    // Update the status of the comment
    $comment->status = $request->status;
    $comment->save(); // Save the updated status

    // Redirect back with a success message
    return redirect()->route('admin.comments.index');
}
    
    

}
