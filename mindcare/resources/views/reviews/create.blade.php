@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Submit a Review for Appointment #{{ $appointment->id }}</h2>

        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf

            <!-- Hidden field to store appointment ID -->
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <!-- Rating -->
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
            </div>

            <!-- Comments -->
            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea name="comments" id="comments" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
@endsection
