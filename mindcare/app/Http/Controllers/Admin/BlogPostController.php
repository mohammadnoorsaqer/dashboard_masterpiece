<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::all();
        return view('admin.blog-posts.index', compact('blogPosts'));
    }

    public function create()
    {
        $users = User::all(); 
        return view('admin.blog-posts.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        BlogPost::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog Post Created Successfully!');
    }

    public function edit($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $users = User::all();
        return view('admin.blog-posts.edit', compact('blogPost', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blogPost = BlogPost::findOrFail($id);
        $blogPost->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog Post Updated Successfully!');
    }

    public function destroy($id)
    {
        BlogPost::destroy($id);
        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog Post Deleted Successfully!');
    }
}
