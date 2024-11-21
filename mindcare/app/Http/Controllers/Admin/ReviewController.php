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
    public function update(Request $request, $review_id)
{
    $review = Review::findOrFail($review_id);

    // Validate the incoming data
    $request->validate([
        'status' => 'required|in:pending,resolved,irresolved',
    ]);

    // Update the review's status
    $review->status = $request->status;
    $review->save();

    // Return with success message
    return back()->with('success', 'Review status updated successfully!');
}

    
    
    
    
}
