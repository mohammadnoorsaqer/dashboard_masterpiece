@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Article: {{ $article->title }}</h2>

    <!-- Display Article Image if exists -->
    @if ($article->image_url)
        <img src="{{ asset($article->image_url) }}" alt="{{ $article->title }}" class="img-fluid mb-4" style="max-width: 50%; height: auto;">
    @else
        <p>No image available for this article.</p>
    @endif

    <p>{{ $article->content }}</p>

    <h3>Comments:</h3>
    <div>
        @foreach ($comments as $comment)
            <div class="comment">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->content }}</p>
                <small>Posted on: {{ $comment->created_at->format('d M, Y') }}</small>
            </div>
            <hr>
        @endforeach
    </div>

    <h4>Add a Comment:</h4>
    <form action="{{ route('admin.comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">

        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" class="form-control" id="content" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>
@endsection
