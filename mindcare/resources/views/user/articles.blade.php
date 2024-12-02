@extends('layouts.usermain')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Article <i class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Our Articles</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                @foreach ($articles as $article)  <!-- Loop through articles -->
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="blog-entry justify-content-end">
                            <div class="text text-center">
                                <!-- Check if the article has an image and display it -->
                                <a href="{{ route('article.show', $article->article_id) }}" class="block-20 img" style="background-image: url('{{ $article->image_url ?? 'images/default.jpg' }}');">
                                </a>
                                <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                                    <div>
                                        <span class="day">{{ $article->created_at->format('d') }}</span>
                                        <span class="mos">{{ $article->created_at->format('F') }}</span>
                                        <span class="yr">{{ $article->created_at->format('Y') }}</span>
                                    </div>
                                </div>
                                <h3 class="heading mb-3"><a href="{{ route('article.show', $article->article_id) }}">{{ $article->title }}</a></h3>
                                <p>{{ Str::limit($article->content, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (optional) -->
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <!-- Add pagination links if needed -->
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
