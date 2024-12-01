@extends('layouts.usermain')

@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>         
        <div class="container">             
            <div class="row no-gutters slider-text align-items-end justify-content-center">                 
                <div class="col-md-9 ftco-animate mb-5 text-center">                     
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Blog <i class="fa fa-chevron-right"></i></span></p>                     
                    <h1 class="mb-0 bread">{{ $article->title }}</h1>                 
                </div>             
            </div>         
        </div>     
    </section>      

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-entry shadow-lg rounded-3 overflow-hidden position-relative">
                        <div class="text p-4 p-md-5 bg-white">
                            <!-- Display the article image -->
                            <div class="text-center mb-4">
                                <img src="{{ $article->image_url ?? 'images/default.jpg' }}" 
                                     alt="{{ $article->title }}" 
                                     class="img-fluid rounded-3 shadow-sm mx-auto" 
                                     style="max-width: 60%; max-height: 300px; object-fit: cover;">
                            </div>
                            
                            <div class="d-flex justify-content-center mb-3">
                                <div class="badge bg-primary text-white p-2 rounded-pill">
                                    <span class="d-block fs-6">
                                        {{ $article->created_at->format('d F Y') }}
                                    </span>
                                </div>
                            </div>

                            <h3 class="h2 text-center mb-4 text-dark fw-bold position-relative">
                                {{ $article->title }}
                            </h3>

                            <div class="article-content">
                                <p class="lead text-muted">{!! nl2br(e($article->content)) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message Display -->
            @if(session('message'))
                <div id="flashMessage" class="alert alert-success mt-4">
                    {{ session('message') }}
                </div>
                <script>
                    // Hide the flash message after 3 seconds
                    setTimeout(function() {
                        document.getElementById('flashMessage').style.display = 'none';
                    }, 3000);
                </script>
            @endif

            <!-- Comments Section -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <h4 class="text-dark fw-bold">Comments</h4>

                    <!-- Display Comments (only approved comments) -->
                    @foreach ($article->comments as $comment)
                        @if ($comment->status == 'approved')  <!-- Only show approved comments -->
                            <div class="comment mb-3 p-3 border rounded shadow-sm">
                                <p><strong>{{ $comment->user->name }}</strong> <small>{{ $comment->created_at->format('F d, Y') }}</small></p>
                                <p>{{ $comment->content }}</p>
                            </div>
                        @endif
                    @endforeach

                    <!-- Comment Form (Only for authenticated users) -->
                    @auth
                    <div class="comment-form mt-5">
                        <form id="commentForm" action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->article_id }}">
                            <textarea name="content" class="form-control" placeholder="Write your comment..." rows="4" required></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Submit Comment</button>
                        </form>
                    </div>
                    @else
                        <p>Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
