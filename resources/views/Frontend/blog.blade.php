@extends('Frontend.layout.main')

@section('title', ($seo->meta_title ?: 'Blog') . ' | RJ TUTORIALS')

@push('meta')
    <meta name="description" content="{{ $seo->meta_description ?: 'Read the latest articles, tips and updates from RJ Tutorials — education insights, exam preparation guides and more.' }}">
    @if($seo->meta_keywords)
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo->meta_title ?: 'Blog | RJ TUTORIALS' }}">
    <meta property="og:description" content="{{ $seo->meta_description ?: 'Read the latest articles, tips and updates from RJ Tutorials — education insights, exam preparation guides and more.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Blog & Updates</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!-- Blog Section Start -->
    <section class="blog-page py-5" style="background:#f8f9fb;">
        <div class="container py-4">

            <div class="section-title text-center sec-title-animation animation-style1 mb-5">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Blog</span>
                </div>
                <h2 class="section-title__title title-animation">Latest <span>Articles & Updates</span></h2>
            </div>

            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="{{ ($loop->index % 3) * 100 }}ms">
                        <div class="blog-card h-100">
                            <div class="blog-card__img-wrap">
                                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('assets/images/blog/default.jpg') }}"
                                    alt="{{ $post->title }}" class="blog-card__img">
                                <span class="blog-card__category">{{ $post->category }}</span>
                            </div>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <span class="blog-card__meta-item">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="blog-card__meta-item">
                                        <i class="far fa-user"></i> {{ $post->author }}
                                    </span>
                                </div>
                                <h3 class="blog-card__title">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="blog-card__text">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="blog-card__btn">
                                    Read More <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p style="color:#64748b;font-size:1rem;">No blog posts published yet. Check back soon!</p>
                    </div>
                @endforelse

                {{-- END DYNAMIC CARDS --}}
            </div><!-- /.row -->

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <nav aria-label="Blog pagination">
                        <ul class="pagination blog-pagination">
                            <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $posts->previousPageUrl() }}"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                <li class="page-item {{ $posts->currentPage() === $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $posts->currentPage() === $posts->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $posts->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif

        </div>
    </section>
    <!-- Blog Section End -->

    <style>
        /* ── Blog Card ─────────────────────────────────────────── */
        .blog-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.13);
        }

        /* Image */
        .blog-card__img-wrap {
            position: relative;
            overflow: hidden;
        }

        .blog-card__img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .blog-card:hover .blog-card__img {
            transform: scale(1.06);
        }

        /* Category badge */
        .blog-card__category {
            position: absolute;
            top: 16px;
            left: 16px;
            background: var(--thm-base, #66003b);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* Body */
        .blog-card__body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* Meta */
        .blog-card__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
        }

        .blog-card__meta-item {
            font-size: 12px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .blog-card__meta-item i {
            color: var(--thm-base, #e8232a);
        }

        /* Title */
        .blog-card__title {
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.45;
            margin-bottom: 0.75rem;
            color: #1e293b;
        }

        .blog-card__title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }

        .blog-card__title a:hover {
            color: var(--thm-base, #e8232a);
        }

        /* Excerpt */
        .blog-card__text {

            color: #64748b;
            line-height: 1.7;
            flex: 1;
            margin-bottom: 1.25rem;
        }

        /* Read more button */
        .blog-card__btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--thm-base, #66003b);
            text-decoration: none;
            border: 2px solid var(--thm-base, #66003b);
            border-radius: 30px;
            padding: 7px 20px;
            align-self: flex-start;
            transition: background 0.25s, color 0.25s;
        }

        .blog-card__btn:hover {
            background: var(--thm-base, #66003b);
            color: #fff;
        }

        /* Pagination */
        .blog-pagination .page-link {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            margin: 0 4px;
            border: 2px solid #e2e8f0;
            color: #475569;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .blog-pagination .page-link:hover,
        .blog-pagination .page-item.active .page-link {
            background: var(--thm-base, #e8232a);
            border-color: var(--thm-base, #e8232a);
            color: #fff;
        }
    </style>

@endsection