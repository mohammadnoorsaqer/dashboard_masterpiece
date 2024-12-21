<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Appointment; // Make sure to import the Appointment model
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Controller: ReviewController

    public function index()
    {
        $reviews = Review::with('appointment', 'user')->get(); // Fetch reviews with appointment and user data
        return view('admin.reviews.index', compact('reviews'));
    }

    // Show the form for creating a new review
    public function create(Appointment $appointment)
    {
        // Ensure that the appointment is marked as "completed" before reviewing
        if ($appointment->status !== 'completed') {
            return redirect()->route('appointments.index')->with('error', 'You can only review completed appointments.');
        }

        return view('reviews.create', compact('appointment'));
    }

    // Store the review submitted by the user
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'user_id' => 'required|exists:users,id',
            'comments' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',  // Assuming rating is between 1 and 5
        ]);
    
        // Create a new review
        $review = new Review();
        $review->appointment_id = $validated['appointment_id'];
        $review->user_id = $validated['user_id'];
        $review->comments = $validated['comments'];
        $review->rating = $validated['rating'];
        $review->status = 'pending';  // Default status
        $review->save();
    
        // Redirect to the user's profile with a success message
        return redirect()->route('profile.edit')->with('success', 'Review submitted successfully.');
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
