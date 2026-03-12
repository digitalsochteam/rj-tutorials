<!--Site Footer Start-->
<footer class="site-footer">
    <div class="site-footer__bg" style="background-image: url(assets/images/backgrounds/site-footer-bg.jpg);">
    </div>
    <div class="site-footer__shape-1 img-bounce-two"></div>
    <div class="site-footer__shape-2 float-bob-y"></div>
    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__about">
                            <div class="footer-widget__about-logo">
                                <a href="{{ url('/') }}"><img src="assets/images/resources/logo-2.png" alt=""></a>
                            </div>
                            <p class="footer-widget__about-text">At RJ Tutorials, Education is not just a journey to
                                academic excellence but a transformative experience that shapes both mind and character
                                of every student.</p>
                            <div class="footer-widget__social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">Our Courses</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                @forelse($navCourses as $course)
                                    <li><a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a></li>
                                @empty
                                    <li><a href="{{ route('courses') }}">View All Courses</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__contact">
                            <h3 class="footer-widget__title">Contact Us</h3>
                            <ul class="footer-widget__contact-list list-unstyled">
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <p>204, Basant Vihar Commercial <br> Complex, CG Rd, beside Cubic Mall, <br>Gulab
                                        Park Colony, Vasant Vihar <br>Complex, Chembur, Mumbai, Maharashtra 400074</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-call"></span>
                                    </div>
                                    <p><a href="tel:8929767497">(+91) 8929767497</a></p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <p><a href="mailto:dr.rohit261286@gmail.com">dr.rohit261286@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner">
                        <div class="site-footer__copyright">
                            <p class="site-footer__copyright-text">© 2026 By <a
                                    href="https://themeforest.net/user/dreamlayout">RJ TUTORIALS</a> All
                                Rights
                                Reserved.</p>
                        </div>
                        <div class="site-footer__bottom-menu-box">
                            <ul class="list-unstyled site-footer__bottom-menu">
                                <li><a href="about.html">Terms of Service</a></li>
                                <li><a href="about.html">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Site Footer End-->