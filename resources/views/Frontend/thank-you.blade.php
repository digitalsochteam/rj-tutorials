@extends('Frontend.layout.main')
@section('content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Thank You</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Thank You</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Thank You Section Start-->
    <section style="padding: 100px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10 text-center">

                    {{-- Animated checkmark --}}
                    <div style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,#16a34a,#22c55e);
                                            display:flex;align-items:center;justify-content:center;margin:0 auto 1.75rem;
                                            box-shadow:0 8px 32px rgba(34,197,94,.3);">
                        <svg width="42" height="42" fill="none" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>

                    <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:.75rem;letter-spacing:-.025em;">
                        Message Sent Successfully!
                    </h2>
                    <p style="font-size:1.05rem;color:#64748b;line-height:1.75;margin-bottom:2.25rem;">
                        Thank you for reaching out to us.<br>
                        We have received your enquiry and will get back to you as soon as possible.
                    </p>

                    <a href="{{ url('/') }}" class="thm-btn"
                        style="display:inline-flex;align-items:center;gap:.5rem;text-decoration:none;">
                        Back to Home
                        <span class="fas fa-arrow-right"></span>
                    </a>

                </div>
            </div>
        </div>
    </section>
    <!--Thank You Section End-->

@endsection