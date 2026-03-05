@extends('Frontend.layout.main')

@section('title', ($homeSeo->seo_title ?: 'RJ TUTORIALS – Expert Coaching for JEE, NEET & MHCET'))

@push('meta')
    {{-- Primary Meta --}}
    <meta name="description"
        content="{{ $homeSeo->seo_description ?: 'RJ Tutorials provides expert coaching for JEE, NEET, MHCET and CBSE/ICSE students in Mumbai.' }}">
    @if($homeSeo->seo_keywords)
        <meta name="keywords" content="{{ $homeSeo->seo_keywords }}">
    @endif

    {{-- Open Graph / Social --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $homeSeo->seo_title ?: 'RJ TUTORIALS' }}">
    <meta property="og:description"
        content="{{ $homeSeo->seo_description ?: 'Expert Coaching for JEE, NEET & MHCET in Mumbai.' }}">
    @if($homeSeo->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $homeSeo->og_image) }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $homeSeo->seo_title ?: 'RJ TUTORIALS' }}">
    <meta name="twitter:description"
        content="{{ $homeSeo->seo_description ?: 'Expert Coaching for JEE, NEET & MHCET in Mumbai.' }}">
    @if($homeSeo->og_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $homeSeo->og_image) }}">
    @endif
@endpush

@section('content')
    <!-- Banner One Start -->
    <section class="banner-one" style="background-image :url('assets/images/resources/hero.jpg')">
        <div class="container">
            <div class="banner-one__inner">
                <div class="banner-one__img-box">
                    <div class="banner-one__img" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="1000">
                        <img src="assets/images/resources/banner-one-img-1.png" alt="">
                    </div>

                </div>
                <div class="banner-one__content">
                    <div class="banner-one__sub-title-box" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-delay="0">
                        <p class="banner-one__sub-title">
                            RJ TUTORIALS</p>
                    </div>
                    <h2 class="banner-one__title" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
                        Empowering Minds.<br> Shaping <span>Futures.</span>
                    </h2>
                    <p class="banner-one__text" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800"
                        style="color:white;">
                        Empowering students with knowledge, confidence, and success <br> through expert guidance,
                        personalized learning, and excellence-driven <br> academic coaching programs.
                    </p>
                    <div class="banner-one__btn-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1000">
                        <div class="banner-one__btn">
                            <a href="contact.html" class="thm-btn">Enquire Now
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                        <div class="banner-one__btn">
                            <a href="tel:8929765663" class="thm-btn">Call Now
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Banner One End -->

    <!--About One Start -->
    <section class="about-one">
        <div class="about-one__shape-2 float-bob">
            <img src="assets/images/shapes/about-one-shape-2.png" alt="">
        </div>
        <div class="about-one__shape-3 float-bob-y">
            <img src="assets/images/shapes/about-one-shape-3.png" alt="">
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

                        <div class="about-one__btn-and-client-info">
                            <div class="about-one__btn-box">
                                <a href="{{ route('about') }}" class="thm-btn">About More
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-one__right wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="about-one__img-box">
                            <div class="about-one__shape-1 float-bob-x">
                                <img src="assets/images/shapes/about-one-shape-1.png" alt="">
                            </div>
                            <div class="about-one__img">
                                <img src="{{ $about->main_image ? asset('storage/' . $about->main_image) : asset('assets/images/resources/about-one-img-1.jpg') }}"
                                    alt="About Us Main Image">
                            </div>
                            <div class="about-one__img-2">
                                <img src="{{ $about->secondary_image ? asset('storage/' . $about->secondary_image) : asset('assets/images/resources/about-one-img-2.jpg') }}"
                                    alt="About Us Secondary Image">
                            </div>

                            <div class="about-one__client-box">
                                <ul class="about-one__client-box-img-list list-unstyled">
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="assets/images/resources/about-one-client-img-1-1.jpg" alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="assets/images/resources/about-one-client-img-1-2.jpg" alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="assets/images/resources/about-one-client-img-1-3.jpg" alt="">
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

    <!--Services Page Start -->
    <section class="services-page">
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Courses</span>
                </div>
                <h2 class="section-title__title title-animation">Different Courses <span>We Offer</span>
                </h2>
            </div>
            <div class="row">
                @forelse($courses as $course)
                    <!--Services Two Single Start-->
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="{{ $loop->index * 100 }}ms">
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
                    <!--Services Two Single End-->
                @empty
                    <div class="col-12 text-center py-5">
                        <p style="color:#64748b;">No courses available yet.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
    <!--Services Page End -->

    <!-- Facilities Section -->
    <section class="py-5">
        <div class="container">

            <div class="section-title text-center sec-title-animation animation-style1">
                <h2 class="section-title__title title-animation"><span>Facilities</span>
                </h2>
            </div>

            <div class="row g-4">

                <!-- Item 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="facility-card">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <h6>Best Professional Teachers</h6>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="facility-card">
                        <i class="fas fa-book-open"></i>
                        <h6>Free Study Material Online & Offline</h6>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="facility-card">
                        <i class="fas fa-school"></i>
                        <h6>Best Infrastructure</h6>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="facility-card">
                        <i class="fas fa-file-alt"></i>
                        <h6>Weekly Test and Assessment</h6>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="facility-card">
                        <i class="fas fa-chart-line"></i>
                        <h6>Periodic Monitoring of Student Growth</h6>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="facility-card">
                        <i class="fas fa-user-graduate"></i>
                        <h6>Personalized Attention to Every Student</h6>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!--Why Choose One Start -->
    <section class="why-choose-one" style="margin-top:100px;">
        <div class="why-choose-one__bg-shape-1"
            style="background-image: url(assets/images/shapes/why-choose-one-bg-shape-1.png);"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="why-choose-one__left">
                        <div class="section-title text-left sec-title-animation animation-style2">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">WHY CHOOSE US</span>
                            </div>
                            <h2 class="section-title__title title-animation">Why Choose
                                <span>
                                    RJ Tutorials?</span>
                            </h2>
                        </div>
                        <p class="why-choose-one__text">At RJ Tutorials, we believe every student has unique potential
                            waiting to be unlocked. Our teaching approach focuses on clarity, consistency, and
                            confidence-building to ensure measurable academic success.</p>
                        <div class="why-choose-one__progress-box">
                            <ul class="why-choose-one__progress-list list-unstyled">
                                <li>
                                    <div class="why-choose-one__progress">
                                        <h4 class="why-choose-one__progress-title"><i class="fa-solid fa-circle-right"></i>
                                            Experienced & Dedicated Faculty</h4>
                                        <p>Learn from qualified educators committed to delivering strong conceptual clarity
                                            and academic excellence.</p>
                                    </div>
                                </li>

                                <li>
                                    <div class="why-choose-one__progress">
                                        <h4 class="why-choose-one__progress-title"><i class="fa-solid fa-circle-right"></i>
                                            Personalized Attention</h4>
                                        <p>Small batch sizes ensure individual focus, doubt-solving support, and continuous
                                            progress tracking.</p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="why-choose-one__btn-and-call-box">
                            <div class="why-choose-one__btn-box">
                                <a href="tel:8929765663" class="thm-btn">Call Now
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                            <div class="why-choose-one__call-box">
                                <div class="why-choose-one__call-icon">
                                    <span class="icon-call"></span>
                                </div>
                                <div class="why-choose-one__call-content">
                                    <p>Call Us Any Time</p>
                                    <h5><a href="tel:8929765663">+91 8929765663</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="why-choose-one__right wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="why-choose-one__img-box">
                            <div class="why-choose-one__img">
                                <img src="assets/images/resources/why-choose-one-img-1.jpg" alt="">
                            </div>
                            <div class="why-choose-one__img-2">
                                <img src="assets/images/resources/why-choose-one-img-2.jpg" alt="">
                            </div>
                            <div class="why-choose-one__shape-1 rotate-me"></div>
                            <div class="why-choose-one__cstomer-services">
                                <div class="why-choose-one__cstomer-services-bg float-bob-x"
                                    style="background-image: url(assets/images/shapes/why-choose-one-cstomer-services-bg-shape.png);">
                                </div>
                                <h4>Learning Beyond Exellence</h4>
                            </div>
                            <div class="why-choose-one__client-active">
                                <div class="why-choose-one__client-count-box">
                                    <h3 class="odometer" data-count="13">00</h3>
                                    <span>K</span>
                                    <span>+</span>
                                </div>
                                <p class="why-choose-one__client-text">Active Students</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Why Choose One End -->

    <!--Process One Start -->
    <section class="process-one">
        <div class="process-one__shape-1"></div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Working Process</span>
                </div>
                <h2 class="section-title__title title-animation">How To Work <span>It</span>
                </h2>
            </div>
            <div class="row">
                <!--Process One Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="process-one__single-inner">
                        <div class="process-one__single">
                            <div class="process-one__icon">
                                <span class="icon-complete"></span>
                            </div>
                            <h3 class="process-one__title">Enroll & Choose Course</h3>
                            <p class="process-one__text">Select the right course based on your academic grade and career
                                goals. Our counselors guide you in making the best choice.</p>
                        </div>
                        <div class="process-one__count"></div>
                    </div>
                </div>
                <!--Process One Single End-->
                <!--Process One Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="200ms">
                    <div class="process-one__single-inner">
                        <div class="process-one__single">
                            <div class="process-one__icon">
                                <span class="icon-social-media-marketing"></span>
                            </div>
                            <h3 class="process-one__title">Concept Building & Learning</h3>
                            <p class="process-one__text">We focus on strong fundamentals with clear explanations,
                                interactive sessions, and regular doubt-solving support.</p>
                        </div>
                        <div class="process-one__count"></div>
                    </div>
                </div>
                <!--Process One Single End-->
                <!--Process One Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="300ms">
                    <div class="process-one__single-inner">
                        <div class="process-one__single">
                            <div class="process-one__icon">
                                <span class="icon-execution"></span>
                            </div>
                            <h3 class="process-one__title">Practice & Performance Tracking</h3>
                            <p class="process-one__text">Students undergo regular tests, assignments, and mock exams to
                                monitor progress and improve weak areas.</p>
                        </div>
                        <div class="process-one__count"></div>
                    </div>
                </div>
                <!--Process One Single End-->
                <!--Process One Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="400ms">
                    <div class="process-one__single-inner">
                        <div class="process-one__single">
                            <div class="process-one__icon">
                                <span class="icon-results"></span>
                            </div>
                            <h3 class="process-one__title">Achieve & Excel</h3>
                            <p class="process-one__text">With structured preparation and expert mentorship, students
                                confidently excel in board exams and competitive exams like JEE, NEET & MHCET.</p>
                        </div>
                        <div class="process-one__count"></div>
                    </div>
                </div>
                <!--Process One Single End-->
            </div>
        </div>
    </section>
    <!--Process One End -->

    <!-- Sliding Text One Start -->
    <section class="sliding-text-one">
        <div class="sliding-text-one__wrap">
            <ul class="sliding-text-one__list list-unstyled marquee_mode-1">
                <li>
                    <h2 data-hover="VIII IX X" class="sliding-text-one__title">VIII IX X</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="SSC/CBSE/ICSE" class="sliding-text-one__title">SSC/CBSE/ICSE</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="MH-CET, NEET, JEЕ" class="sliding-text-one__title">MH-CET, NEET, JEЕ</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="11th & 12th" class="sliding-text-one__title">11th & 12th</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="SCIENCE & COMMERCE" class="sliding-text-one__title">SCIENCE & COMMERCE</h2>
                    <span class="icon-star"></span>
                </li>
            </ul>
        </div>
    </section>
    <!-- Sliding Text One End -->





    <!--Team One Start -->
    <section class="team-one">
        <div class="team-one__shape-1 rotate-me">
            <img src="assets/images/shapes/team-one-shape-1.png" alt="">
        </div>
        <div class="team-one__shape-2 float-bob-x">
            <img src="assets/images/shapes/team-one-shape-2.png" alt="">
        </div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our expert team</span>
                </div>
                <h2 class="section-title__title title-animation">From the <span>Director's Desk</span>
                </h2>
            </div>
            <div class="row">
                @forelse($team as $member)
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="{{ $loop->index * 100 }}ms">
                        <div class="team-one__single">
                            <div class="team-one__img-box">
                                <div class="team-one__img">
                                    <img src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('assets/images/team/team-1-' . ($loop->iteration) . '.jpg') }}"
                                        alt="{{ $member->name }}">
                                </div>
                                <div class="team-one__arrow-and-social">
                                    <div class="team-one__arrow">
                                        <span class="icon-share"></span>
                                    </div>
                                    <ul class="team-one__social list-unstyled">
                                        <li><a href="#"><span class="icon-facebook-app-symbol"></span></a></li>
                                        <li><a href="#"><span class="icon-twitter"></span></a></li>
                                        <li><a href="#"><span class="icon-pinterest"></span></a></li>
                                        <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-one__content">
                                <div class="team-one__content-bg-shape"
                                    style="background-image: url({{ asset('assets/images/shapes/team-one-content-bg-shape.png') }});">
                                </div>
                                <h3 class="team-one__name"><a href="#">{{ $member->name }}</a></h3>
                                <p class="team-one__sub-title">{{ $member->designation }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p style="color:#64748b;">No team members found.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
    <!--Team One End -->



    <!-- Testimonial One Start -->
    <section class="testimonial-one">
        <div class="testimonial-one__bg-color">
            <div class="testimonial-one__bg"
                style="background-image: url(assets/images/backgrounds/testimonial-one-bg.jpg);"></div>
        </div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Testimonials</span>
                </div>
                <h2 class="section-title__title title-animation">What Client Say <span>About </span>us</h2>
            </div>
            <div class="testimonial-one__carousel owl-theme owl-carousel">
                @forelse($testimonials as $t)
                    <div class="item">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__single-inner">
                                <div class="testimonial-one__single-shape-1"></div>
                                <div class="testimonial-one__star">
                                    @for($s = 1; $s <= 5; $s++)
                                        <span class="icon-star-1" style="{{ $s > $t->rating ? 'opacity:.3;' : '' }}"></span>
                                    @endfor
                                </div>
                                <p class="testimonial-one__text">"{{ $t->message }}"</p>
                            </div>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="{{ $t->photo ? asset('storage/' . $t->photo) : 'assets/images/testimonial/testimonial-1-1.jpg' }}"
                                        alt="{{ $t->name }}">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4 class="testimonial-one__client-name">{{ $t->name }}</h4>
                                    @if($t->designation)
                                        <p class="testimonial-one__sub-title">{{ $t->designation }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="fal fa-quote-right"></span>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback static testimonials if none in DB yet --}}
                    <div class="item">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__single-inner">
                                <div class="testimonial-one__single-shape-1"></div>
                                <div class="testimonial-one__star">
                                    <span class="icon-star-1"></span>
                                    <span class="icon-star-1"></span>
                                    <span class="icon-star-1"></span>
                                    <span class="icon-star-1"></span>
                                    <span class="icon-star-1"></span>
                                </div>
                                <p class="testimonial-one__text">"Excellent tutorial! Clear explanations, well-structured
                                    content, and easy-to-follow examples."</p>
                            </div>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="assets/images/testimonial/testimonial-1-1.jpg" alt="">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4 class="testimonial-one__client-name">Abhishek Atkari</h4>
                                    <p class="testimonial-one__sub-title">Our Students</p>
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="fal fa-quote-right"></span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Testimonial One End -->






    <!-- FAQ One Start -->
    <section class="faq-one" style="padding-bottom: 100px;">
        <div class="faq-one__shape-2 float-bob-y">
            <img src="assets/images/shapes/faq-one-shape-2.png" alt="">
        </div>
        <div class="faq-one__shape-3 float-bob">
            <img src="assets/images/shapes/faq-one-shape-3.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="faq-one__left">
                        <div class="section-title text-left sec-title-animation animation-style2">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">Frequently Ask Question</span>
                            </div>
                            <h2 class="section-title__title title-animation">Have Questions in <span>Your
                                    Mind?</span> Get the Answers Now
                            </h2>
                        </div>
                        <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                            <div class="accrodion">
                                <div class="accrodion-title">
                                    <h4>Which grades and boards do you cover?</h4>
                                </div>
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <p>We provide coaching for students from Grade VIII to XII covering CBSE, ICSE, and
                                            State Boards with a strong academic foundation.
                                        </p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                            <div class="accrodion active">
                                <div class="accrodion-title">
                                    <h4>Do you provide coaching for competitive exams?</h4>
                                </div>
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <p>Yes, we offer specialized preparation for JEE, NEET, and MHCET with structured
                                            study plans, mock tests, and performance analysis.
                                        </p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                            <div class="accrodion">
                                <div class="accrodion-title">
                                    <h4>How are batches and class sizes managed?</h4>
                                </div>
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <p>We maintain small batch sizes to ensure personalized attention, better
                                            interaction, and effective doubt-solving sessions.
                                        </p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                            <div class="accrodion">
                                <div class="accrodion-title">
                                    <h4>How do you track student progress?</h4>
                                </div>
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <p>Regular tests, assignments, and mock exams help monitor performance. Parents are
                                            also updated about academic progress consistently.
                                        </p>
                                    </div><!-- /.inner -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="faq-one__right wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="faq-one__img-box">
                            <div class="faq-one__shape-1 float-bob-y">
                                <img src="assets/images/shapes/faq-one-shape-1.png" alt="">
                            </div>
                            <div class="faq-one__experience-box">
                                <div class="faq-one__experience-year">
                                    <h2 class="odometer" data-count="25">00</h2>
                                </div>
                                <p class="faq-one__experience-text">Year of <br> experience</p>
                            </div>
                            <div class="faq-one__img">
                                <img src="assets/images/resources/faq-one-img-1.jpg" alt="">
                            </div>
                            <div class="faq-one__img-2">
                                <img src="assets/images/resources/faq-one-img-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ One End -->
@endsection