@extends('Frontend.layout.main')
@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Founder / Director</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Founder / Director</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->


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
            <div class="row justify-content-center">
                @forelse($team as $member)
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="{{ $loop->index * 100 }}ms">
                        <div class="team-one__single">
                            <div class="team-one__img-box">
                                <div class="team-one__img">
                                    <img src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('assets/images/team/team-1-' . ($loop->iteration) . '.jpg') }}"
                                        alt="{{ $member->name }}" style="width: 100%; height: 300px; object-fit: cover;">
                                </div>
                                {{-- <div class="team-one__arrow-and-social">
                                    <div class="team-one__arrow">
                                        <span class="icon-share"></span>
                                    </div>
                                    <ul class="team-one__social list-unstyled">
                                        <li><a href="#"><span class="icon-facebook-app-symbol"></span></a></li>
                                        <li><a href="#"><span class="icon-twitter"></span></a></li>
                                        <li><a href="#"><span class="icon-pinterest"></span></a></li>
                                        <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                    </ul>
                                </div> --}}
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

    <section class="owner-message-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="director-card p-5">

                        <h3 class="mb-4 fw-bold">Owner's Message – RJ Tutorials</h3>

                        <p>
                            At RJ Tutorials, we believe that every student deserves quality education, guidance, and
                            encouragement to achieve their dreams. Our institute is built on the values of inclusiveness,
                            equality, and respect, where every student is welcomed and supported irrespective of their
                            background.
                        </p>

                        <p>
                            We guide students from Class 8 to 12 and prepare them for competitive examinations such as JEE,
                            NEET, and MHCET through strong conceptual teaching, disciplined learning, and personal
                            attention.
                        </p>

                        <p>
                            Our goal is not only academic success but also to build confidence, determination, and a love
                            for learning in every student.
                        </p>

                        <div class="text-end mt-4">
                            <strong>Neelima Jain</strong><br>
                            <span>M.Com, PGDBA, Associateship</span><br>
                            <span>Owner, RJ Tutorials</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="rj-about-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="director-card p-5">

                        <h3 class="mb-4 fw-bold">R J Tutorials: Empowering Education for All</h3>
                        <h4 style="font-weight: bold;margin-bottom:20px;">No. Of years experience 10</h4>
                        <p>
                            Dr. Rohit Jain, a dedicated emergency physician and educator, has taken a remarkable initiative
                            to bridge the gap in quality education. R J Tutorials, founded by Dr. Jain, aims to provide
                            high-quality education to students from all economic backgrounds at an affordable price.
                        </p>

                        <h5 class="fw-bold mt-4 mb-2">Mission:</h5>
                        <p>
                            To empower students from economically weaker sections of society by providing them with quality
                            education, enabling them to pursue their desired careers.
                        </p>

                        <h5 class="fw-bold mt-4 mb-2">Goal:</h5>
                        <p>
                            To make quality education accessible to all, regardless of financial constraints, and help
                            students achieve their academic and professional goals.
                        </p>

                        <h5 class="fw-bold mt-4 mb-2">Key Features:</h5>
                        <ul>
                            <li>Expert faculty, including Dr. Rohit Jain, with extensive experience in education and
                                medicine</li>
                            <li>Comprehensive study materials and resources</li>
                            <li>Small batch sizes for personalized attention</li>
                            <li>Affordable fees structure, making quality education accessible to all</li>
                        </ul>

                        <h5 class="fw-bold mt-4 mb-2">Why R J Tutorials?</h5>
                        <p>
                            At R J Tutorials, we believe that quality education should be a right, not a privilege. Our aim
                            is to support students in achieving their dreams, regardless of their financial background.
                        </p>

                        <p>Join us in our mission to empower education for all.</p>

                        <p>Contact R J Tutorials today to learn more about our courses and batches.</p>

                        {{-- <ul class="list-unstyled mt-3">
                            <li><strong>Phone:</strong> insert phone number</li>
                            <li><strong>Email:</strong> insert email</li>
                            <li><strong>Address:</strong> insert address</li>
                        </ul> --}}

                        <p class="mt-3"><strong>Let's work together to create a brighter future for all!</strong></p>

                        <div class="text-end mt-4">
                            <strong>Dr. Rohit Jain</strong><br>
                            {{-- <span>MBBS, MD (Emergency Medicine), DNB (Emergency Medicine)</span><br> --}}
                            <span>Owner, RJ Tutorials</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="director-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="director-card p-5">

                        <h3 class="mb-4 fw-bold">From the Directors Desk</h3>

                        <p>
                            Welcome to RJ Tutorials, where we empower students to achieve academic excellence and realize
                            their dreams.
                            As a Leading coaching institute, we are committed to providing high quality education, guidance
                            and support
                            to help our students succeed.
                        </p>

                        <p>
                            We are driven by a set of core values that guide everything we do. We believe in the importance
                            of hard work,
                            dedication and perseverance. We believe in the Value of education as a transformative force in
                            society.
                            And we believe in the potential of every student to achieve greatness.
                        </p>

                        <div class="text-end mt-4">
                            <h6 class="mb-1">Warm Regards,</h6>
                            <strong>R J Tutorials, Director & Professor</strong>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection