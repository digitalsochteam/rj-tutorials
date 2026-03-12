<header class="main-header">
    <div class="main-menu__top">
        <div class="main-menu__top-inner">
            <ul class="list-unstyled main-menu__contact-list">
                <li>
                    <div class="icon">
                        <i class="icon-email"></i>
                    </div>
                    <div class="text">
                        <p><a href="mailto:dr.rohit261286@gmail.com">dr.rohit261286@gmail.com</a>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <i class="icon-pin"></i>
                    </div>
                    <div class="text">
                        <p>Chembur, Mumbai, Maharashtra 400074</p>
                    </div>
                </li>
            </ul>
            <p class="main-menu__top-welcome-text">Welcome to RJ TUTORIALS</p>
            <div class="main-menu__top-right">
                <p class="main-menu__social-title">Follow Us On:</p>
                <div class="main-menu__social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ url('/') }}"><img src="assets/images/resources/logo-1.png" alt=""></a>
                    </div>
                </div>
                <div class="main-menu__main-menu-box">
                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                    <ul class="main-menu__list">
                        <li>
                            <a href="{{ url('/') }}">Home </a>
                        </li>
                        <li>
                            <a href="{{ url('/about') }}">About</a>
                        </li>
                        <li>
                            <a href="{{ url('/team') }}">Directors</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('courses') }}">Courses</a>
                            <ul class="shadow-box">
                                @forelse($navCourses as $course)
                                    <li><a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a></li>
                                @empty
                                    <li><a href="{{ route('courses') }}">All Courses</a></li>
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/fees') }}">Fees Structure</a>
                        </li>
                        <li>
                            <a href="{{ url('/gallery') }}">Gallery</a>
                        </li>
                        <li>
                            <a href="{{ url('/blog') }}">Blog</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="main-menu__right">
                    <div class="main-menu__call">
                        <div class="main-menu__call-icon">
                            <i class="icon-call"></i>
                        </div>
                        <div class="main-menu__call-content">
                            <p class="main-menu__call-sub-title">Call Anytime</p>
                            <h5 class="main-menu__call-number"><a href="tel:8929767497">+91 8929767497</a></h5>
                        </div>
                    </div>
                    <div class="main-menu__btn-box">
                        <a href="tel:8929767497" class="thm-btn">Call Now
                            <span class="fas fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->