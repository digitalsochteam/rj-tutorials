@extends('Frontend.layout.main')
@section('title', ($course->meta_title ?: $course->title) . ' | RJ TUTORIALS')
@push('meta')
    {{-- Primary SEO --}}
    <meta name="description" content="{{ $course->meta_description ?: Str::limit(strip_tags($course->short_description ?: $course->description), 160) }}">
    @if($course->meta_keywords)
    <meta name="keywords" content="{{ $course->meta_keywords }}">
    @endif
    <link rel="canonical" href="{{ route('courses.show', $course->slug) }}">
    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $course->meta_title ?: $course->title }}">
    <meta property="og:description" content="{{ $course->meta_description ?: Str::limit(strip_tags($course->short_description ?: $course->description), 160) }}">
    <meta property="og:url" content="{{ route('courses.show', $course->slug) }}">
    @if($course->image)
    <meta property="og:image" content="{{ asset('storage/' . $course->image) }}">
    @endif
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $course->meta_title ?: $course->title }}">
    <meta name="twitter:description" content="{{ $course->meta_description ?: Str::limit(strip_tags($course->short_description ?: $course->description), 160) }}">
    @if($course->image)
    <meta name="twitter:image" content="{{ asset('storage/' . $course->image) }}">
    @endif
@endpush
@section('content')

    <style>
        .course-description h1,.course-description h2,.course-description h3,
        .course-description h4,.course-description h5,.course-description h6 {
            font-weight: 700; color: #1a202c; margin: 1.4rem 0 .6rem;
        }
        .course-description h1 { font-size: 1.75rem; }
        .course-description h2 { font-size: 1.45rem; }
        .course-description h3 { font-size: 1.2rem; }
        .course-description p  { margin: .6rem 0 1rem; }
        .course-description ul,.course-description ol { padding-left: 1.5rem; margin: .5rem 0 1rem; }
        .course-description li { margin-bottom: .35rem; }
        .course-description strong { font-weight: 700; }
        .course-description em    { font-style: italic; }
        .course-description u     { text-decoration: underline; }
        .course-description s     { text-decoration: line-through; }
        .course-description blockquote {
            border-left: 4px solid #ff6700; margin: 1rem 0;
            padding: .6rem 1.2rem; background: #fff7f0; border-radius: 0 8px 8px 0;
            color: #7c3b06; font-style: italic;
        }
        .course-description table {
            width: 100%; border-collapse: collapse; margin: 1rem 0; font-size: .95rem;
        }
        .course-description table th,
        .course-description table td {
            border: 1px solid #e2e8f0; padding: .55rem .85rem; text-align: left;
        }
        .course-description table th { background: #f8fafc; font-weight: 700; }
        .course-description table tr:nth-child(even) td { background: #fafafa; }
        .course-description img { max-width: 100%; height: auto; border-radius: 8px; margin: .75rem 0; }
        .course-description a { color: #ff6700; text-decoration: underline; }
        .course-description hr { border: none; border-top: 1px solid #e2e8f0; margin: 1.25rem 0; }
    </style>

    <!-- Page Header Start -->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $course->title }}</h2>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-angle-right"></span></li>
                        <li><a href="{{ route('courses') }}">Courses</a></li>
                        <li><span class="icon-angle-right"></span></li>
                        <li>{{ Str::limit($course->title, 40) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header End -->

    <!-- Course Detail Start -->
    <section class="py-5" style="background:#f8f9fb;">
        <div class="container py-4">
            <div class="row g-5">

                <!-- Main Content -->
                <div class="col-lg-8">

                    @if($course->image)
                        <div
                            style="border-radius:14px;overflow:hidden;margin-bottom:2rem;box-shadow:0 8px 32px rgba(0,0,0,.1);">
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}"
                                style="width:100%;max-height:420px;object-fit:cover;display:block;">
                        </div>
                    @else
                        <div
                            style="border-radius:14px;overflow:hidden;margin-bottom:2rem;box-shadow:0 8px 32px rgba(0,0,0,.1);">
                            <img src="{{ asset('assets/images/services/services-2-1.jpg') }}" alt="{{ $course->title }}"
                                style="width:100%;max-height:420px;object-fit:cover;display:block;">
                        </div>
                    @endif

                    <!-- Category badge + title -->
                    <span
                        style="background:var(--thm-base,#66003b);color:#fff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;padding:4px 14px;border-radius:20px;">
                        {{ $course->category }}
                    </span>

                    <h1 style="font-size:2rem;font-weight:800;color:#1e293b;margin:1rem 0 .5rem;">
                        {{ $course->title }}
                    </h1>

                    @if($course->tagline)
                        <p
                            style="font-size:1.05rem;color:#475569;border-left:4px solid var(--thm-base,#66003b);padding-left:1.25rem;font-style:italic;margin-bottom:1.5rem;">
                            {{ $course->tagline }}
                        </p>
                    @endif

                    <hr style="border:none;border-top:1px solid #e2e8f0;margin:1.5rem 0;">

                    @if($course->description)
                        <div class="course-description" style="font-size:1rem;color:#374151;line-height:1.9;">
                            {!! $course->description !!}
                        </div>
                    @else
                        <p style="color:#64748b;">No detailed description available yet.</p>
                    @endif

                    <!-- Back / Nav -->
                    <div
                        style="display:flex;flex-wrap:wrap;gap:.75rem;align-items:center;padding-top:2rem;border-top:1px solid #e2e8f0;margin-top:2rem;">
                        <a href="{{ route('courses') }}"
                            style="display:inline-flex;align-items:center;gap:7px;font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;color:var(--thm-base,#e8232a);border:2px solid var(--thm-base,#e8232a);border-radius:30px;padding:7px 20px;">
                            <span class="fas fa-arrow-left"></span> All Courses
                        </a>
                        @if($prev)
                            <a href="{{ route('courses.show', $prev->slug) }}"
                                style="display:inline-flex;align-items:center;gap:7px;font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;color:var(--thm-base,#e8232a);border:2px solid var(--thm-base,#e8232a);border-radius:30px;padding:7px 20px;">
                                <span class="fas fa-chevron-left"></span> Prev
                            </a>
                        @endif
                        @if($next)
                            <a href="{{ route('courses.show', $next->slug) }}"
                                style="display:inline-flex;align-items:center;gap:7px;font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;color:var(--thm-base,#e8232a);border:2px solid var(--thm-base,#e8232a);border-radius:30px;padding:7px 20px;">
                                Next <span class="fas fa-chevron-right"></span>
                            </a>
                        @endif
                    </div>

                </div>

                <!-- Sidebar: Other Courses -->
                <div class="col-lg-4">
                    <div
                        style="background:#fff;border-radius:14px;padding:1.5rem;box-shadow:0 4px 24px rgba(0,0,0,.07);margin-bottom:1.5rem;">
                        <h4
                            style="font-size:1rem;font-weight:800;color:#1e293b;margin-bottom:1.25rem;padding-bottom:.75rem;border-bottom:2px solid var(--thm-base,#e8232a);">
                            Other Courses
                        </h4>
                        @forelse($otherCourses as $other)
                            <a href="{{ route('courses.show', $other->slug) }}"
                                style="display:flex;gap:.75rem;align-items:flex-start;padding:.75rem 0;border-bottom:1px solid #f1f5f9;text-decoration:none;">
                                <img src="{{ $other->image ? asset('storage/' . $other->image) : asset('assets/images/services/services-2-1.jpg') }}"
                                    alt="{{ $other->title }}"
                                    style="width:60px;height:50px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                                <div>
                                    <div style="font-size:.875rem;font-weight:700;color:#1e293b;line-height:1.4;">
                                        {{ $other->title }}</div>
                                    <div style="font-size:.75rem;color:#94a3b8;margin-top:.2rem;">{{ $other->category }}</div>
                                </div>
                            </a>
                        @empty
                            <p style="font-size:.875rem;color:#94a3b8;">No other courses available.</p>
                        @endforelse
                    </div>

                    <!-- CTA -->
                    <div
                        style="background:var(--thm-base,#66003b);border-radius:14px;padding:1.75rem;text-align:center;color:#fff;">
                        <h4 style="font-size:1.1rem;font-weight:800;margin-bottom:.5rem;color:#fff;">Enroll Now</h4>
                        <p style="font-size:.875rem;opacity:.9;margin-bottom:1.25rem;">Get started with expert guidance from
                            our faculty.</p>
                        <a href="tel:8929767497"
                            style="display:inline-block;background:#fff;color:var(--thm-base,#66003b);font-size:.85rem;font-weight:800;padding:.6rem 1.4rem;border-radius:30px;text-decoration:none;">
                            <span class="fas fa-phone"></span> Call Now
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Course Detail End -->

@endsection