@extends('Frontend.layout.main')

@section('title', ($seo->meta_title ?: 'Our Courses') . ' | RJ TUTORIALS')

@push('meta')
    <meta name="description" content="{{ $seo->meta_description ?: 'Explore all courses offered by RJ Tutorials — expert coaching for grades VIII–XII, JEE, NEET & MHCET preparation.' }}">
    @if($seo->meta_keywords)
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo->meta_title ?: 'Our Courses | RJ TUTORIALS' }}">
    <meta property="og:description" content="{{ $seo->meta_description ?: 'Explore all courses offered by RJ Tutorials — expert coaching for grades VIII–XII, JEE, NEET & MHCET preparation.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Our Courses</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Courses</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Courses Listing Start -->
    <section class="services-page" style="background:#f8f9fb;padding:80px 0;">
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Courses</span>
                </div>
                <h2 class="section-title__title title-animation">Different Courses <span>We Offer</span></h2>
            </div>
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="{{ ($loop->index % 3) * 100 }}ms">
                        <div class="services-two__single">
                            <div class="services-two__img-box">
                                <div class="services-two__img">
                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('assets/images/services/services-2-' . ($loop->iteration) . '.jpg') }}"
                                        alt="{{ $course->title }}">
                                </div>
                            </div>
                            <div class="services-two__content">
                                <h3 class="services-two__title">
                                    <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                </h3>
                                <p class="services-two__text">
                                    {{ $course->short_description ?: $course->tagline }}
                                </p>
                                <div class="services-two__plus">
                                    <a href="{{ route('courses.show', $course->slug) }}">
                                        <span class="fas fa-plus"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p style="color:#64748b;">No courses available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!--Courses Listing End -->

@endsection