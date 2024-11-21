@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <h2 class="h3 mb-4">Reviews Management</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Reviews List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th>User</th>
                            <th>Appointment</th>
                            <th>Status</th>
                            <th>Comments</th> <!-- Added a column for comments -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ $review->appointment->appointment_date }}</td>
                                <td>{{ ucfirst($review->status) }}</td>
                                <td>{{ $review->comments ?? 'No comments' }}</td> <!-- Display comments or 'No comments' if none exist -->
                                <td>
                                    <!-- Add actions for updating the status -->
                                    <form action="{{ route('admin.reviews.update', $review->review_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT') <!-- This is required for PUT requests -->
                                        <div class="form-group d-flex align-items-center">
                                            <label for="status" class="mr-2">Update Status:</label>
                                            <select name="status" id="status" class="form-select custom-select mr-3">
                                                <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="resolved" {{ $review->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="irresolved" {{ $review->status == 'irresolved' ? 'selected' : '' }}>Irresolved</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
