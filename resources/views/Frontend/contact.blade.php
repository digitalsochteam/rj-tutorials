@extends('Frontend.layout.main')

@section('title', ($seo->meta_title ?: 'Contact Us') . ' | RJ TUTORIALS')

@push('meta')
    <meta name="description" content="{{ $seo->meta_description ?: 'Get in touch with RJ Tutorials. Located in Chembur, Mumbai. Enquire about coaching for JEE, NEET, MHCET & board exams.' }}">
    @if($seo->meta_keywords)
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo->meta_title ?: 'Contact Us | RJ TUTORIALS' }}">
    <meta property="og:description" content="{{ $seo->meta_description ?: 'Get in touch with RJ Tutorials. Located in Chembur, Mumbai. Enquire about coaching for JEE, NEET, MHCET & board exams.' }}">
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
                <h3>Contact Us</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Contact Info Start-->
    <section class="contact-info">
        <div class="container">
            <div class="row">
                <!--Contact Two Single Start-->
                <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="contact-info__single">
                        <div class="contact-info__icon">
                            <span class="icon-call"></span>
                        </div>
                        <p>Contact Us</p>
                        <h3><a href="tel:8929767497">+91 8929767497</a></h3>
                    </div>
                </div>
                <!--Contact Two Single End-->
                <!--Contact Two Single Start-->
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                    <div class="contact-info__single">
                        <div class="contact-info__icon">
                            <span class="icon-email"></span>
                        </div>
                        <p>Email Us</p>
                        <h3><a href="mailto:dr.rohit261286@gmail.com">dr.rohit261286@gmail.com</a></h3>
                    </div>
                </div>
                <!--Contact Two Single End-->
                <!--Contact Two Single Start-->
                <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <div class="contact-info__single">
                        <div class="contact-info__icon">
                            <span class="icon-pin"></span>
                        </div>
                        <p>Our Office Location</p>
                        <h3>204, Basant Vihar Commercial
                            Complex, CG Rd, beside Cubic Mall,
                            Gulab Park Colony, Vasant Vihar
                            Complex, Chembur, Mumbai, Maharashtra 400074</h3>
                    </div>
                </div>
                <!--Contact Two Single End-->
            </div>
        </div>
    </section>
    <!--Contact Info End-->

    <!--Contact Page Start-->
    <section class="contact-page">
        <div class="container">
            <div class="contact-page__inner">
                <div class="contact-page__bg-shape"
                    style="background-image: url(assets/images/shapes/contact-page-bg-shape.png);"></div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="contact-page__left">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7542.624485495796!2d72.89658819465532!3d19.05000446988572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c7001a55721f%3A0x42983cb78eed739!2sRJ%20TUTORIALS!5e0!3m2!1sen!2sin!4v1771932032681!5m2!1sen!2sin"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="contact-page__right">
                            <h3 class="contact-page__form-title">Get A Free Quote</h3>

                            @if($errors->any())
                                <div
                                    style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;border-radius:8px;padding:.85rem 1.1rem;margin-bottom:1.25rem;font-size:.9rem;">
                                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                                </div>
                            @endif

                            <form id="contact-form" class="contact-form-validated contact-page__form"
                                action="{{ route('enquiry.store') }}" method="POST">
                                <div class="row">
                                    @csrf
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="text" name="name" placeholder="Your name" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="email" name="email" placeholder="Your Email" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="text" placeholder="Mobile" name="phone" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="text" placeholder="Subject" name="subject" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="contact-page__input-box text-message-box">
                                            <textarea name="message" placeholder="Messege" required=""></textarea>
                                        </div>
                                        <div class="contact-page__btn-box">
                                            <button type="submit" class="thm-btn contact-page__btn"
                                                data-loading-text="Please wait...">Send A Message
                                                <span class="fas fa-arrow-right"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="result"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Page End-->
@endsection