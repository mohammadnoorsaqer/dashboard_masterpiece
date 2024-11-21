@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0">Edit Article</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}" class="text-decoration-none">Articles</a></li>
                    <li class="breadcrumb-item active">Edit Article</li>
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
            <h5 class="card-title mb-0">Edit Article</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.articles.update', $article->article_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $article->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="5" required>{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image URL -->
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL (Optional)</label>
                    <input type="url" class="form-control @error('image_url') is-invalid @enderror" 
                           id="image_url" name="image_url" value="{{ old('image_url', $article->image_url) }}">
                    @error('image_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Author -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">Author</label>
                    <select class="form-control @error('user_id') is-invalid @enderror" 
                            id="user_id" name="user_id" required>
                        <option value="">Select Author</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" 
                                    {{ old('user_id', $article->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Article</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
