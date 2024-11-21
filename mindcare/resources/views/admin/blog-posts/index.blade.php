@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0">Blog Posts Management</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Blog Posts</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Add New Blog Post
        </a>
    </div>

    <!-- Alert Section -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Blog Posts Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Blog Posts List</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchBlogPosts" placeholder="Search blog posts...">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Title</th>
                            <th class="py-3">Author</th>
                            <th class="py-3">Created At</th>
                            <th class="px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogPosts as $post)
                            <tr>
                                <td class="px-4">{{ $post->title }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->created_at->format('d M, Y') }}</td>
                                <td class="px-4 text-end">
    <div class="btn-group">
        <a href="{{ route('admin.blog-posts.edit', $blogPost->id) }}" 
           class="btn btn-sm btn-outline-secondary"
           data-bs-toggle="tooltip"
           title="Edit Blog Post">
            <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('admin.blog-posts.destroy', $blogPost->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete Blog Post">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No Blog Posts Found</h5>
                                        <p class="text-muted mb-0">Start by adding a new blog post.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.getElementById('searchBlogPosts');
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>

@endsection
