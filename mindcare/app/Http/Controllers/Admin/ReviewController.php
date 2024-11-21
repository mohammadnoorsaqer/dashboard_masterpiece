<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{// Controller: ReviewController

public function index()
{
    $reviews = Review::with('appointment', 'user')->get(); // Fetch reviews with appointment and user data
    return view('admin.reviews.index', compact('reviews'));
}


    // Resolve or mark the review as unresolved
    public function updateStatus(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:pending,resolved,irresolved',
        ]);
    
        // Update the review's status
        $review->update(['status' => $request->status]);
    
        // Redirect back to the reviews index page with a success message
        return redirect()->route('admin.reviews.index')->with('success', 'Review status updated successfully!');
    }
    
    
    
}
