@extends('Frontend.layout.main')
@section('title', ($post->meta_title ?: $post->title) . ' | RJ TUTORIALS')
@push('meta')
    {{-- Primary SEO --}}
    <meta name="description"
        content="{{ $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160) }}">
    @if($post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif
    <link rel="canonical" href="{{ route('blog.show', $post->slug) }}">
    {{-- Open Graph --}}
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta property="og:description"
        content="{{ $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160) }}">
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
    @if($post->image)
        <meta property="og:image" content="{{ asset('storage/' . $post->image) }}">
    @endif
    @if($post->published_at)
        <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    @endif
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta name="twitter:description"
        content="{{ $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160) }}">
    @if($post->image)
        <meta name="twitter:image" content="{{ asset('storage/' . $post->image) }}">
    @endif
@endpush
@section('content')

    <style>
        .course-description h1,
        .course-description h2,
        .course-description h3,
        .course-description h4,
        .course-description h5,
        .course-description h6 {
            font-weight: 700;
            color: #1a202c;
            margin: 1.4rem 0 .6rem;
        }

        .course-description h1 {
            font-size: 1.75rem;
        }

        .course-description h2 {
            font-size: 1.45rem;
        }

        .course-description h3 {
            font-size: 1.2rem;
        }

        .course-description p {
            margin: .6rem 0 1rem;
        }

        .course-description ul,
        .course-description ol {
            padding-left: 1.5rem;
            margin: .5rem 0 1rem;
        }

        .course-description li {
            margin-bottom: .35rem;
        }

        .course-description strong {
            font-weight: 700;
        }

        .course-description em {
            font-style: italic;
        }

        .course-description u {
            text-decoration: underline;
        }

        .course-description s {
            text-decoration: line-through;
        }

        .course-description blockquote {
            border-left: 4px solid #ff6700;
            margin: 1rem 0;
            padding: .6rem 1.2rem;
            background: #fff7f0;
            border-radius: 0 8px 8px 0;
            color: #7c3b06;
            font-style: italic;
        }

        .course-description table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            font-size: .95rem;
        }

        .course-description table th,
        .course-description table td {
            border: 1px solid #e2e8f0;
            padding: .55rem .85rem;
            text-align: left;
        }

        .course-description table th {
            background: #f8fafc;
            font-weight: 700;
        }

        .course-description table tr:nth-child(even) td {
            background: #fafafa;
        }

        .course-description img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: .75rem 0;
        }

        .course-description a {
            color: #ff6700;
            text-decoration: underline;
        }

        .course-description hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 1.25rem 0;
        }
    </style>
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $post->title }}</h2>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-angle-right"></span></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><span class="icon-angle-right"></span></li>
                        <li>{{ Str::limit($post->title, 40) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header End -->

    <!-- Blog Detail Start -->
    <section class="blog-detail-page py-5" style="background:#f8f9fb;">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">

                    <!-- Featured Image -->
                    @if($post->image)
                        <div class="blog-detail__img-wrap">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="blog-detail__img">
                        </div>
                    @endif

                    <!-- Meta Bar -->
                    <div class="blog-detail__meta">
                        <span class="blog-detail__category">{{ $post->category }}</span>
                        <span class="blog-detail__meta-item">
                            <i class="far fa-calendar-alt"></i>
                            {{ $post->published_at ? $post->published_at->format('F j, Y') : $post->created_at->format('F j, Y') }}
                        </span>
                        <span class="blog-detail__meta-item">
                            <i class="far fa-user"></i> {{ $post->author }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="blog-detail__title">{{ $post->title }}</h1>

                    <!-- Excerpt -->
                    @if($post->excerpt)
                        <p class="blog-detail__excerpt">{{ $post->excerpt }}</p>
                    @endif

                    <!-- Divider -->
                    <hr class="blog-detail__divider">

                    <!-- Content -->
                    <div class="blog-detail__content course-description">
                        {!! $post->content !!}
                    </div>

                    <!-- Back / Nav -->
                    <div class="blog-detail__footer">
                        <a href="{{ route('blog') }}" class="blog-detail__back">
                            <span class="fas fa-arrow-left"></span> Back to Blog
                        </a>
                        @if($prev)
                            <a href="{{ route('blog.show', $prev->slug) }}" class="blog-detail__nav">
                                <span class="fas fa-chevron-left"></span> Prev Post
                            </a>
                        @endif
                        @if($next)
                            <a href="{{ route('blog.show', $next->slug) }}" class="blog-detail__nav">
                                Next Post <span class="fas fa-chevron-right"></span>
                            </a>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Related Posts -->
            @if($related->count())
                <div class="row justify-content-center mt-5">
                    <div class="col-12">
                        <h3 class="blog-detail__related-title">More Articles</h3>
                    </div>
                    @foreach($related as $rel)
                        <div class="col-xl-4 col-lg-4 col-md-6 mt-4">
                            <div class="blog-card h-100">
                                <div class="blog-card__img-wrap">
                                    <img src="{{ $rel->image ? asset('storage/' . $rel->image) : asset('assets/images/blog/default.jpg') }}"
                                        alt="{{ $rel->title }}" class="blog-card__img">
                                    <span class="blog-card__category">{{ $rel->category }}</span>
                                </div>
                                <div class="blog-card__body">
                                    <div class="blog-card__meta">
                                        <span class="blog-card__meta-item">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ $rel->published_at ? $rel->published_at->format('M d, Y') : $rel->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <h3 class="blog-card__title">
                                        <a href="{{ route('blog.show', $rel->slug) }}">{{ $rel->title }}</a>
                                    </h3>
                                    <p class="blog-card__text">
                                        {{ $rel->excerpt ?: Str::limit(strip_tags($rel->content), 100) }}
                                    </p>
                                    <a href="{{ route('blog.show', $rel->slug) }}" class="blog-card__btn">
                                        Read More <span class="fas fa-arrow-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
    <!-- Blog Detail End -->

    <style>
        /* ── Blog Detail ───────────────────────────────────────── */
        .blog-detail__img-wrap {
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, .1);
        }

        .blog-detail__img {
            width: 100%;
            max-height: 460px;
            object-fit: cover;
            display: block;
        }

        .blog-detail__meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }

        .blog-detail__category {
            background: var(--thm-base, #66003b);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 4px 14px;
            border-radius: 20px;
        }

        .blog-detail__meta-item {
            font-size: 13px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .blog-detail__meta-item i {
            color: var(--thm-base, #66003b);
        }

        .blog-detail__title {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.3;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .blog-detail__excerpt {
            font-size: 1.05rem;
            color: #475569;
            border-left: 4px solid var(--thm-base, #66003b);
            padding-left: 1.25rem;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .blog-detail__divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 1.5rem 0;
        }

        .blog-detail__content {
            font-size: 1rem;
            color: #374151;
            line-height: 1.9;
            margin-bottom: 2.5rem;
        }

        .blog-detail__footer {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .blog-detail__back,
        .blog-detail__nav {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            color: var(--thm-base, #66003b);
            border: 2px solid var(--thm-base, #66003b);
            border-radius: 30px;
            padding: 7px 20px;
            transition: background .25s, color .25s;
        }

        .blog-detail__back:hover,
        .blog-detail__nav:hover {
            background: var(--thm-base, #66003b);
            color: #fff;
        }

        .blog-detail__related-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: .5rem;
        }

        /* Reuse blog-card styles from blog.blade.php */
        .blog-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .07);
            transition: transform .3s, box-shadow .3s;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .13);
        }

        .blog-card__img-wrap {
            position: relative;
            overflow: hidden;
        }

        .blog-card__img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform .4s;
            display: block;
        }

        .blog-card:hover .blog-card__img {
            transform: scale(1.06);
        }

        .blog-card__category {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--thm-base, #66003b);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 3px 11px;
            border-radius: 20px;
        }

        .blog-card__body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .blog-card__meta {
            display: flex;
            flex-wrap: wrap;
            gap: .6rem;
            margin-bottom: .75rem;
        }

        .blog-card__meta-item {
            font-size: 12px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .blog-card__meta-item i {
            color: var(--thm-base, #66003b);
        }

        .blog-card__title {
            font-size: .95rem;
            font-weight: 700;
            line-height: 1.45;
            margin-bottom: .6rem;
            color: #1e293b;
        }

        .blog-card__title a {
            color: inherit;
            text-decoration: none;
            transition: color .2s;
        }

        .blog-card__title a:hover {
            color: var(--thm-base, #e8232a);
        }

        .blog-card__text {
            font-size: .85rem;
            color: #64748b;
            line-height: 1.7;
            flex: 1;
            margin-bottom: 1rem;
        }

        .blog-card__btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--thm-base, #66003b);
            text-decoration: none;
            border: 2px solid var(--thm-base, #66003b);
            border-radius: 30px;
            padding: 6px 18px;
            align-self: flex-start;
            transition: background .25s, color .25s;
        }

        .blog-card__btn:hover {
            background: var(--thm-base, #66003b);
            color: #fff;
        }

        @media(max-width:768px) {
            .blog-detail__title {
                font-size: 1.5rem;
            }
        }
    </style>

@endsection