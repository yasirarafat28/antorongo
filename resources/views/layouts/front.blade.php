<!doctype html>
<html lang="en">

<!-- Mirrored from preview.colorlib.com/theme/banker/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Nov 2020 16:17:42 GMT -->

<head>
    <title>{{\App\Setting::setting()->app_name}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"  type="text/css">
    <link rel="stylesheet"
        href="/front/fonts%2c_icomoon%2c_style.css%2bcss%2c_bootstrap.min.css%2bcss%2c_jquery-ui.css%2bcss%2c_owl.carousel.min.css%2bcss%2c_owl.theme.default.min.css%2bcss%2c_owl.theme.default.min.css%2bcss%2c_jquery"  type="text/css" />

        <style>
            .site-blocks-cover.overlay::before {
                background: rgba(184, 178, 166, 0);
            }
        </style>

    </head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-xl-6">
                        <h1 class="mb-0 site-logo"><a href="index-2.html" class="h2 mb-0">{{\App\Setting::setting()->app_name}}<span
                                    class="text-primary">.</span> </a></h1>
                    </div>
                    <div class="col-12 col-md-6 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a href="#home-section" class="nav-link">Home</a></li>
                                <li class="has-children">
                                    <a href="#about-section" class="nav-link">About Us</a>
                                    <ul class="dropdown">
                                        <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                                        <li><a href="#services-section" class="nav-link">Services</a></li>

                                    </ul>
                                </li>
                                <li><a href="#blog-section" class="nav-link">Blog</a></li>
                                <li><a href="#contact-section" class="nav-link">Contact</a></li>
                                <li><a href="/login" class="nav-link btn-primary btn-sm pb-2 pt-2 pl-5 pr-5">Login</a></li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a
                            href="#" class="site-menu-toggle js-menu-toggle float-right"><span
                                class="icon-menu h3"></span></a></div>
                </div>
            </div>
        </header>

        @yield('content')

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="footer-heading mb-4">About Us</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium
                                    magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
                            </div>
                            <div class="col-md-3 ml-auto">
                                <h2 class="footer-heading mb-4">Quick Links</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#about-section" class="smoothscroll">Terms</a></li>
                                    <li><a href="#about-section" class="smoothscroll">Policy</a></li>
                                    <li><a href="#about-section" class="smoothscroll">About Us</a></li>
                                    <li><a href="#services-section" class="smoothscroll">Services</a></li>
                                    <li><a href="#contact-section" class="smoothscroll">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 footer-social">
                                <h2 class="footer-heading mb-4">Follow Us</h2>
                                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
                        <form action="#" method="post" class="footer-subscribe">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control border-secondary text-white bg-transparent"
                                    placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary text-black" type="button"
                                        id="button-addon2">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            <p class="copyright"><small>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());

                                    </script> All rights reserved | This template is made with <i
                                        class="icon-heart text-danger" aria-hidden="true"></i> by <a
                                        href="https://colorlib.com/" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </small></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div> <!-- .site-wrap -->
    <script src="/front/js/jquery-3.3.1.min.js.pagespeed.jm.r0B4QCxeCQ.js"></script>
    <script src="/front/js/jquery-ui.js%2bpopper.min.js.pagespeed.jc.rjnNY3C1N6.js"></script>
    <script>
        eval(mod_pagespeed_CXifWJ99V1);

    </script>
    <script>
        eval(mod_pagespeed_n1PcjVhRV3);

    </script>
    <script src="/front/js/bootstrap.min.js.pagespeed.jm.m29fZhtnNs.js"></script>
    <script
        src="/front/js/owl.carousel.min.js%2bjquery.countdown.min.js%2bjquery.easing.1.3.js%2baos.js.pagespeed.jc.g8dYkmV7wZ.js">
    </script>
    <script>
        eval(mod_pagespeed_3CP7DCa5eU);

    </script>
    <script>
        eval(mod_pagespeed_pPQye3OwK5);

    </script>
    <script>
        eval(mod_pagespeed_y5NrYtBNvx);

    </script>
    <script>
        eval(mod_pagespeed_r4p0HiIG0P);

    </script>
    <script src="/front/js/jquery.fancybox.min.js%2bjquery.sticky.js.pagespeed.jc.0Fh_pjXL8b.js"></script>
    <script>
        eval(mod_pagespeed_cjMkG5doX$);

    </script>
    <script>
        eval(mod_pagespeed_Nv_hh06p9Q);

    </script>
    <script src="/front/js/isotope.pkgd.min.js%2bmain.js.pagespeed.jc.P-URFxG5_p.js"></script>
    <script>
        eval(mod_pagespeed_yMq1SKFb5J);

    </script>
    <script>
        eval(mod_pagespeed_t_skve8vY$);

    </script>

</body>

<!-- Mirrored from preview.colorlib.com/theme/banker/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Nov 2020 16:17:57 GMT -->

</html>
