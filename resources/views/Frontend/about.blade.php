@extends('Frontend.layout.main')

@section('title', $about->meta_title ?: 'About Us')

@push('meta')
    <meta name="description"
        content="{{ $about->meta_description ?: 'Learn about RJ Tutorials — expert coaching institute for grades VIII–XII, JEE, NEET & MHCET preparation.' }}">
    @if($about->meta_keywords)
        <meta name="keywords" content="{{ $about->meta_keywords }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $about->meta_title ?: 'About Us | RJ TUTORIALS' }}">
    <meta property="og:description"
        content="{{ $about->meta_description ?: 'Learn about RJ Tutorials — expert coaching institute for grades VIII–XII, JEE, NEET & MHCET preparation.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>About Us</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--About One Start -->
    <section class="about-one" style="margin-bottom: 200px;">
        <div class="about-one__shape-2 float-bob">
            <img src="{{ asset('assets/images/shapes/about-one-shape-2.png') }}" alt="">
        </div>
        <div class="about-one__shape-3 float-bob-y">
            <img src="{{ asset('assets/images/shapes/about-one-shape-3.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-one__left">
                        <div class="section-title text-left sec-title-animation animation-style2">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">{{ $about->tagline }}</span>
                            </div>
                            <h2 class="section-title__title title-animation">{!! nl2br(e($about->title)) !!}</h2>
                        </div>
                        @if($about->paragraph_1)
                            <div class="about-one__text" style="text-align:justify;">{!! $about->paragraph_1 !!}</div><br>
                        @endif
                        @if($about->paragraph_2)
                            <div class="about-one__text" style="text-align:justify;">{!! $about->paragraph_2 !!}</div><br>
                        @endif
                        @if($about->paragraph_3)
                            <div class="about-one__text" style="text-align:justify;">{!! $about->paragraph_3 !!}</div><br>
                        @endif


                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-one__right wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="about-one__img-box">
                            <div class="about-one__shape-1 float-bob-x">
                                <img src="{{ asset('assets/images/shapes/about-one-shape-1.png') }}" alt="">
                            </div>
                            <div class="about-one__img">
                                <img src="{{ $about->main_image ? asset('storage/' . $about->main_image) : asset('assets/images/resources/about-one-img-1.jpg') }}"
                                    alt="">
                            </div>
                            <div class="about-one__img-2">
                                <img src="{{ $about->secondary_image ? asset('storage/' . $about->secondary_image) : asset('assets/images/resources/about-one-img-2.jpg') }}"
                                    alt="">
                            </div>

                            <div class="about-one__client-box">
                                <ul class="about-one__client-box-img-list list-unstyled">
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="{{ asset('assets/images/resources/about-one-client-img-1-1.jpg') }}"
                                                alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="{{ asset('assets/images/resources/about-one-client-img-1-2.jpg') }}"
                                                alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="{{ asset('assets/images/resources/about-one-client-img-1-3.jpg') }}"
                                                alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#"><span class="fas fa-plus"></span></a>
                                    </li>
                                </ul>
                                <p class="about-one__client-text"><span class="odometer"
                                        data-count="{{ $about->students_count }}">00</span> Satisfied Students</p>
                            </div>
                            <div class="about-one__experience-box">
                                <div class="about-one__experience-count-box">
                                    <h3 class="odometer" data-count="{{ $about->years_experience }}">00</h3>
                                    <span>+</span>
                                </div>
                                <p class="about-one__experience-text">Years of
                                    Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--About One End -->

    <!-- Mission & Vision Section -->
    <section style="background: #fff;margin-bottom: 100px;">
        <div class="container">

            <!-- Mission Row -->
            <div class="row align-items-center mb-4" style="background:#66003b;">

                <!-- Image -->
                <div class="col-md-5 p-0">
                    <img src="{{ asset('assets/images/resources/mission.jpg') }}" class="img-fluid w-100 h-100"
                        style="object-fit:cover;" alt="Mission Image">
                </div>

                <!-- Content -->
                <div class="col-md-7 p-5">
                    <h2 class="fw-bold mb-3" style="color: white;">MISSION</h2>
                    <p class="mb-0 fs-5" style="color: white;">
                        Empowering every student with accessible, affordable and exceptional education,
                        academic excellence & lifelong success.
                    </p>
                </div>
            </div>

            <!-- Vision Row -->
            <div class="row align-items-center" style="background:#66003b;">

                <!-- Content -->
                <div class="col-md-7 p-5 order-2 order-md-1">
                    <h2 class="fw-bold mb-3" style="color: white;">VISION</h2>
                    <p class="mb-0 fs-5" style="color: white;">
                        Envisioning a nation where every individual has access to quality education,
                        empowering them to reach their full potential & creating a brighter future for all.
                    </p>
                </div>

                <!-- Image -->
                <div class="col-md-5 p-0 order-1 order-md-2">
                    <img src="assets/images/resources/vission.jpg" class="img-fluid w-100 h-100" style="object-fit:cover;"
                        alt="Vision Image">
                </div>
            </div>

        </div>
    </section>


    <!-- Salient Features Section -->
    <section class="py-5">
        <div class="container">

            <div class="section-title text-center sec-title-animation animation-style1">
                <h2 class="section-title__title title-animation"><span>Salient Features</span>
                </h2>
            </div>

            <div class="col-lg-10 mx-auto">

                <!-- 1 -->
                <div class="feature-box">
                    <div class="feature-number bg-danger">1</div>
                    <div class="feature-content">
                        <h6>Personalized Learning Plans:</h6>
                        <p>Tailored study plans for each student based on their strengths, weaknesses, and learning style.
                        </p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="feature-box">
                    <div class="feature-number bg-primary">2</div>
                    <div class="feature-content">
                        <h6>AI-Powered Adaptive Assessments:</h6>
                        <p>Adaptive assessments that adjust their level of difficulty based on a student's performance,
                            providing real-time feedback.</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="feature-box">
                    <div class="feature-number bg-warning text-dark">3</div>
                    <div class="feature-content">
                        <h6>Mentorship Programs:</h6>
                        <p>One-on-one mentorship program that pair students with experienced educators or industry
                            professionals.</p>
                    </div>
                </div>

                <!-- 4 -->
                <div class="feature-box">
                    <div class="feature-number bg-success">4</div>
                    <div class="feature-content">
                        <h6>Real-World Application-Based Learning:</h6>
                        <p>Curriculum that incorporates real-world examples and case studies to help students apply
                            theoretical concepts to practical scenarios.</p>
                    </div>
                </div>

                <!-- 5 -->
                <div class="feature-box">
                    <div class="feature-number bg-info text-dark">5</div>
                    <div class="feature-content">
                        <h6>Gamification and Interactive Learning:</h6>
                        <p>Incorporating game design elements and interactive tools to make learning engaging and fun.</p>
                    </div>
                </div>

                <!-- 6 -->
                <div class="feature-box">
                    <div class="feature-number bg-secondary">6</div>
                    <div class="feature-content">
                        <h6>Parent-Teacher-Student Portal:</h6>
                        <p>A platform that enables parents, teachers, and students to communicate and track progress.</p>
                    </div>
                </div>

                <!-- 7 -->
                <div class="feature-box">
                    <div class="feature-number bg-dark">7</div>
                    <div class="feature-content">
                        <h6>Flexible Learning Paths:</h6>
                        <p>Offering flexible learning paths that cater to different learning styles, such as online,
                            offline/blended learning.</p>
                    </div>
                </div>

                <!-- 8 -->
                <div class="feature-box">
                    <div class="feature-number bg-success">8</div>
                    <div class="feature-content">
                        <h6>Career Counseling and Guidance:</h6>
                        <p>Providing career counseling and guidance to help students make informed decisions about their
                            future.</p>
                    </div>
                </div>

                <!-- 9 -->
                <div class="feature-box">
                    <div class="feature-number bg-warning text-dark">9</div>
                    <div class="feature-content">
                        <h6>Batches & Students :</h6>
                        <p>Limited no of Students in each batch</p>
                    </div>
                </div>

                <!-- 10 -->
                <div class="feature-box">
                    <div class="feature-number bg-danger">10</div>
                    <div class="feature-content">
                        <h6>Continuous Feedback and Improvement:</h6>
                        <p>Regularly collecting feedback from students, parents and teachers to continuously improve the
                            coaching institute's programs and services.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5" style="background: linear-gradient(to right, #f4e6d6, #e9c7a575);">
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <h2 class="section-title__title title-animation"><span>Special Facilities</span>
                </h2>
            </div>
            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <h2 class="free-text">FREE</h2>
                        <h5>Career Guidance</h5>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <h2 class="free-text">FREE</h2>
                        <h5>Moderator Sessions for X & XII Boards</h5>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <h5 class="mt-3">Daily availability of the Assistant teachers for daily orals and doubt solving and
                            to teach any missed portions.</h5>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6">
                    <div class="feature-card text-center">
                        <h2 class="free-text">FREE</h2>
                        <h5>Goal Oriented & Performance Resulted Consulting</h5>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-md-6">
                    <div class="feature-card text-center">
                        <h5 class="mt-3">Everyday Orals & Maths Solving Practise</h5>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection