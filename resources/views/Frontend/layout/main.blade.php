<!DOCTYPE html>
<html lang="en">
@include('Frontend.layout.head')

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>
    <div class="page-wrapper">
        @include('Frontend.layout.header')
        @yield('content')
        @include('Frontend.layout.footer')
    </div>
    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/images/resources/logo-2.png" width="150"
                        alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:dr.rohit261286@gmail.com">dr.rohit261286@gmail.com</a>
                </li>
                <li>
                    <i class="fas fa-phone"></i>
                    <a href="tel:8879552477">+91 8879552477</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-facebook-square"></a>
                    <a href="#" class="fab fa-pinterest-p"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->



    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        <span class="scroll-to-top__text"> Go Back Top</span>
    </a>

    {{-- Floating WhatsApp & Call Buttons --}}
    <div class="floating-buttons">
        <a href="https://wa.me/918879552477" class="floating-btn floating-whatsapp" target="_blank"
            rel="noopener noreferrer" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="floating-btn__label">WhatsApp</span>
        </a>
        <a href="tel:+918879552477" class="floating-btn floating-call" aria-label="Call Us">
            <i class="fas fa-phone"></i>
            <span class="floating-btn__label">Call Us</span>
        </a>
    </div>

    <style>
        .floating-buttons {
            position: fixed;
            bottom: 100px;
            right: 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 9999;
        }

        .floating-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            color: #fff;
            font-size: 22px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: visible;
        }

        .floating-btn:hover {
            transform: scale(1.12);
            color: #fff;
        }

        .floating-whatsapp {
            background-color: #25D366;
        }

        .floating-whatsapp:hover {
            background-color: #1ebe5a;
        }

        .floating-call {
            background-color: #007bff;
        }

        .floating-call:hover {
            background-color: #0062cc;
        }

        .floating-btn__label {
            position: absolute;
            right: 62px;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .floating-btn:hover .floating-btn__label {
            opacity: 1;
        }

        @media (max-width: 576px) {
            .floating-buttons {
                bottom: 80px;
                right: 16px;
            }

            .floating-btn {
                width: 46px;
                height: 46px;
                font-size: 18px;
            }
        }
    </style>

    @include('Frontend.layout.script')
</body>

</html>