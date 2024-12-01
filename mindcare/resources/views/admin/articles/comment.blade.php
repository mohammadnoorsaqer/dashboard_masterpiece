@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0">Comments</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}" class="text-decoration-none">Articles</a></li>
                    <li class="breadcrumb-item active">Comments</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Manage Comments</h5>
        </div>
        <div class="card-body">
            @foreach ($comments as $comment)
                <div class="comment-item">
                    <p><strong>Comment:</strong> {{ $comment->content }}</p>
                    <p><strong>Status:</strong> 
                        @if($comment->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($comment->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </p>

                    <!-- Update Status Form -->
                    <form action="{{ route('admin.comments.updateStatus', $comment->comment_id) }}" method="POST" class="update-status-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $comment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $comment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // SweetAlert2 for success message after form submission
    @if (session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    // SweetAlert2 for confirmation before submitting the form
    document.querySelectorAll('.update-status-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the status of this comment.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Proceed with form submission if confirmed
                }
            });
        });
    });
</script>
@endsection
