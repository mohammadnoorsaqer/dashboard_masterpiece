<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Fetch all articles
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        // Fetch all users (authors)
        $users = User::all();
        return view('admin.articles.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id', 
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $request->image_url,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully!');
    }

    public function edit(Article $article)
    {
        $users = User::all();
        return view('admin.articles.edit', compact('article', 'users'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id', 
        ]);

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $request->image_url,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }
}
