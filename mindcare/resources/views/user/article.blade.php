@extends('layouts.usermain')

@section('content')
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 position-relative" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay position-absolute w-100 h-100"></div>         
        <div class="container">             
            <div class="row min-vh-40 align-items-center justify-content-center">                 
                <div class="col-lg-8 text-center py-5">                     
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-3">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="text-white text-decoration-none">Home</a>
                            </li>
                            <li class="breadcrumb-item text-white">Article</li>
                        </ol>
                    </nav>                    
                    <h1 class="display-4 text-white mb-0">{{ $article->title }}</h1>                 
                </div>             
            </div>         
        </div>     
    </section>      

    <!-- Article Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article class="bg-white shadow-lg rounded-4 overflow-hidden">
                        <!-- Article Header -->
                        <div class="p-4 p-md-5">
                            <!-- Featured Image -->
                            <div class="text-center mb-4 position-relative">
                                <img src="{{ $article->image_url ?? 'images/default.jpg' }}" 
                                     alt="{{ $article->title }}" 
                                     class="img-fluid rounded-4 w-100 object-fit-cover"
                                     style="max-height: 500px;">
                                
                                <!-- Date Badge -->
                                <div class="position-absolute top-0 start-0 m-3">
                                    <div class="badge bg-primary px-3 py-2 rounded-pill">
                                        {{ $article->created_at->format('d F Y') }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Article Title -->
                            <h1 class="h2 text-center mb-4 fw-bold">{{ $article->title }}</h1>

                            <!-- Article Content -->
                            <div class="article-content">
                                <p class="lead text-muted">{!! nl2br(e($article->content)) !!}</p>
                            </div>
                        </div>
                    </article>

                    <!-- Success Message -->
                    @if(session('message'))
                        <div id="flashMessage" class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Comments Section -->
                    <div class="mt-5">
                        <h3 class="h4 mb-4">Comments ({{ $article->comments->where('status', 'approved')->count() }})</h3>

                        <!-- Comments List -->
                        <div class="comments-list">
                            @foreach ($article->comments as $comment)
                                @if ($comment->status == 'approved')
                                    <div class="comment-card bg-white p-4 rounded-3 shadow-sm mb-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="comment-avatar me-3">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                                <small class="text-muted">{{ $comment->created_at->format('F d, Y') }}</small>
                                            </div>
                                        </div>
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Comment Form -->
                        @auth
                            <div class="comment-form bg-white p-4 rounded-3 shadow-sm mt-4">
                                <h4 class="h5 mb-4">Leave a Comment</h4>
                                <form id="commentForm" action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->article_id }}">
                                    <div class="form-group">
                                        <textarea name="content" 
                                                  class="form-control form-control-lg" 
                                                  placeholder="Write your thoughts..." 
                                                  rows="4" 
                                                  required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4 py-2 mt-3">
                                        Submit Comment
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-light p-4 rounded-3 text-center mt-4">
                                <p class="mb-0">
                                    Please <a href="{{ route('login') }}" class="text-primary">login</a> to leave a comment.
                                </p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

<style>
.min-vh-40 {
    min-height: 40vh;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "\f054";
    font-family: "FontAwesome";
    color: white;
    font-size: 0.75rem;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.comment-card {
    transition: transform 0.3s ease;
}

.comment-card:hover {
    transform: translateY(-2px);
}

.form-control:focus {
    box-shadow: none;
    border-color: #007bff;
}

#flashMessage {
    animation: fadeOut 0.5s ease 2.5s forwards;
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; visibility: hidden; }
}
</style>

<script>
    // Existing flash message timeout
    setTimeout(function() {
        const flashMessage = document.getElementById('flashMessage');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 3000);
</script>
@endsection