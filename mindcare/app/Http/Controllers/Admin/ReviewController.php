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
        // Validate the incoming request
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'comments' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Fetch the appointment based on the provided appointment ID
        $appointment = Appointment::findOrFail($request->appointment_id);
    
        // Ensure the user is the one who booked the appointment
        if ($appointment->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'You cannot review this appointment.');
        }
    
        // Check if the user has already submitted a review for this appointment
        $existingReview = Review::where('appointment_id', $request->appointment_id)
                                ->where('user_id', auth()->id())
                                ->first();
    
        if ($existingReview) {
            return redirect()->route('home')->with('error', 'You have already submitted a review for this appointment.');
        }
    
        // Get the doctor ID from the appointment (assuming the appointment has a doctor_id field)
        $doctor_id = $appointment->doctor_id;
    
        // Create the review
        try {
            $review = new Review();
            $review->appointment_id = $request->appointment_id;
            $review->user_id = auth()->id();
            $review->doctor_id = $doctor_id;  // Store the doctor ID in the review
            $review->comments = $request->comments;
            $review->rating = $request->rating;
            $review->status = 'pending';  // Default status
            $review->save();
    
            return redirect()->route('home')->with('success', 'Your review has been submitted.');
        } catch (\Exception $e) {
            \Log::error('Error saving review: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'There was an issue submitting your review. Please try again.');
        }
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
    public function checkReview(Request $request)
{
    $userId = auth()->id();
    $appointmentId = $request->appointment_id;

    $existingReview = Review::where('appointment_id', $appointmentId)
                            ->where('user_id', $userId)
                            ->exists();

    return response()->json(['alreadyReviewed' => $existingReview]);
}

}
