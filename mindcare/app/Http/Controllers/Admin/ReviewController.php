<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Appointment; // Make sure to import the Appointment model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('reviews.create', compact('appointment'));
    }

    // Store the submitted review
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'comments' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5', // Ensures rating is between 1 and 5
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        // Ensure the user is the one who booked the appointment
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'You cannot review this appointment.');
        }

        // Create the review
        $review = new Review();
        $review->appointment_id = $request->appointment_id;
        $review->user_id = auth()->id();
        $review->comments = $request->comments;
        $review->rating = $request->rating;
        $review->status = 'pending'; // Initially set to 'pending'
        $review->save();

        return redirect()->route('home')->with('success', 'Your review has been submitted.');
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
