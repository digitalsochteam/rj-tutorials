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
                    <a href="tel:8929765663">+91 8929765663</a>
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

    {{-- Floating WhatsApp, Call & Enquire Buttons --}}
    <div class="floating-buttons">
        <button onclick="showEnquiryPopup()" class="floating-btn floating-enquire" aria-label="Enquire Now">
            <i class="fas fa-comment-dots"></i>
            <span class="floating-btn__label">Enquire Now</span>
        </button>
        <a href="https://wa.me/918879552477" class="floating-btn floating-whatsapp" target="_blank"
            rel="noopener noreferrer" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="floating-btn__label">WhatsApp</span>
        </a>
        <a href="tel:+918929765663" class="floating-btn floating-call" aria-label="Call Us">
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

        .floating-enquire {
            background-color: #e8232a;
            border: none;
            cursor: pointer;
        }

        .floating-enquire:hover {
            background-color: #c41e24;
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

    <!-- ══ ENQUIRY POPUP ══ -->
    <div id="enquiryPopup" style="
        display:none;position:fixed;inset:0;z-index:99999;
        background:rgba(5,5,15,.7);backdrop-filter:blur(4px);
        align-items:center;justify-content:center;">
        <div style="
            background:#fff;border-radius:16px;padding:2rem 2rem 1.6rem;
            width:100%;max-width:420px;margin:1rem;position:relative;
            box-shadow:0 24px 80px rgba(0,0,0,.35);">
            <!-- Close -->
            <button onclick="closeEnquiryPopup()" style="
                position:absolute;top:12px;right:14px;background:none;border:none;
                font-size:1.3rem;cursor:pointer;color:#94a3b8;line-height:1;" title="Close">
                &times;
            </button>
            <!-- Header -->
            <div style="text-align:center;margin-bottom:1.2rem;">
                <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;
                    letter-spacing:.08em;color:#e8232a;margin-bottom:.3rem;">Free Consultation</div>
                <h3 style="margin:0;font-size:1.35rem;font-weight:800;color:#0f172a;line-height:1.25;">
                    Get in Touch With Us
                </h3>
                <p style="margin:.4rem 0 0;font-size:.85rem;color:#64748b;">
                    Fill in your details and we'll call you back shortly.
                </p>
            </div>
            <!-- Form -->
            <form method="post" action="https://form.digitalsochmedia.com/thanku.php">
                <div class="form-group" style="margin-bottom: 0px;">
                    <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                        style="margin-bottom: 15px;" />
                    <input type="text" class="form-control" name="mobile" pattern="[0-9]{10,10}" autocomplete="off"
                        maxlength="10" id="extra7" onKeyPress="return isNumber(event)" placeholder="Enter Mobile Number"
                        aria-describedby="basic-addon1" style="border: 2px solid #8b3777; margin-bottom: 15px;">
                    <input type="text" class="form-control" name="msg" placeholder="Enter Your Message"
                        style="margin-bottom: 15px;">
                </div>
                <input type="hidden" name="clientMailID" value="dr.rohit261286@gmail.com">
                <input name="website" type="hidden" value="rjtutorialseducare.co.in/thank" />
                <input name="loginId" type="hidden" value="2158" />
                <input name="orderId" type="hidden" value="2762" />
                <button type="submit" class="btn btn-block" style="background: #8b3777; color:#fff; border: 0px;"><span
                        class="fa fa-paper-plane"></span> Submit</button>
            </form>
            <!-- Skip -->
            <p style="text-align:center;margin:.8rem 0 0;font-size:.78rem;color:#94a3b8;">
                <a href="#" onclick="closeEnquiryPopup();return false;"
                    style="color:#94a3b8;text-decoration:underline;">No thanks, maybe later</a>
            </p>
        </div>
    </div>

    <script>
        (function () {
            var DELAY_MS = 4000; // show after 4 seconds

            window.showEnquiryPopup = function () {
                var el = document.getElementById('enquiryPopup');
                el.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            };

            window.closeEnquiryPopup = function () {
                document.getElementById('enquiryPopup').style.display = 'none';
                document.body.style.overflow = '';
            };

            // Close on backdrop click
            document.getElementById('enquiryPopup').addEventListener('click', function (e) {
                if (e.target === this) closeEnquiryPopup();
            });

            // Close on Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeEnquiryPopup();
            });

            // Show on every page load
            setTimeout(window.showEnquiryPopup, DELAY_MS);
        })();
    </script>
</body>

</html>