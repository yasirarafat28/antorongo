<!DOCTYPE html>
<html lang="en">
<head>
<title>{{\App\Setting::setting()->app_name}}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/front/styles/bootstrap4/bootstrap.min.css">
<link href="/front/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/front/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/front/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/front/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="/front/styles/responsive.css">

@yield('style')
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->
        @php
            $contact = App\Contact::where('status','active')->orderBy('created_at','DESC')->first();
        @endphp

		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<ul class="top_bar_contact_list">
									<li><div class="question">কোনো প্রশ্ন আছে কি?</div></li>
									<li>
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div>{{$contact->phone_no??'N/A'}}</div>
									</li>
									<li>
										<i class="fa fa-envelope-o" aria-hidden="true"></i>
										<div>{{$contact->gmail??'@gmail.com'}}</div>
									</li>
								</ul>
								<div class="top_bar_login ml-auto">
									<div class="login_button"><a href="/login">Login</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
                            @php
                                $logo = App\Gallery::where('status','active')->orderBy('created_at','DESC')->first();
                            @endphp
							<div class="logo_container">

									<div class="logo">
                                        <img src="{{$logo->logo??''}}" alt="logo" onerror="this.src='/front/images/no_img_avaliable.jpg';">
                                    </div>

							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li class="active"><a href="\">Home</a></li>
									<li><a href="/about">About</a></li>
									{{-- <li><a href="">Courses</a></li> --}}
									<li><a href="/blogs">Blog</a></li>
									{{-- <li><a href="/page">Page</a></li> --}}
									<li><a href="/contact">Contact</a></li>
								</ul>
								<div class="search_button"><i class="fa fa-search" aria-hidden="true"></i></div>

								<!-- Hamburger -->

								{{-- <div class="shopping_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div> --}}
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Search Panel -->
		<div class="header_search_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_search_content d-flex flex-row align-items-center justify-content-end">
							<form action="/member-search" class="header_search_form">
								<input type="search" name="q" value="{{$_GET['q']??''}}" class="search_input" placeholder="Search" required="required">
								<button class="header_search_button d-flex flex-column align-items-center justify-content-center">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="/member-search" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" value="{{$_GET['q']??''}}" placeholder="Search" name="q" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="/">Home</a></li>
				<li class="menu_mm"><a href="/about">About</a></li>
				<li class="menu_mm"><a href="/blogs">Blog</a></li>
				{{-- <li class="menu_mm"><a href="/front/#">Page</a></li> --}}
				<li class="menu_mm"><a href="/contact">Contact</a></li>
				<li class="menu_mm"><a href="/login">Loogin</a></li>
			</ul>
		</nav>
	</div>

	<!-- Home -->


	<!-- Footer -->

    @yield('content')

	<footer class="footer">
		<div class="footer_background" style="background-image:url(images/footer_background.png)"></div>
		<div class="container">
			<div class="row footer_row">
				<div class="col">
					<div class="footer_content">
						<div class="row">

							<div class="col-lg-3 footer_col">

								<!-- Footer About -->
								<div class="footer_section footer_about">
									<div class="footer_logo_container">
										<a href="#">
											<div class="logo">
                                                <img src="{{$logo->logo??'/'}}" alt="logo" onerror="this.src='/front/images/no_img_avaliable.jpg';">
                                            </div>
										</a>
									</div>
									<div class="footer_about_text">
										{{-- <p>Lorem ipsum dolor sit ametium, consectetur adipiscing elit.</p> --}}
									</div>
									<div class="footer_social">
										<ul>
											<li><a href="/front/#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="/front/#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											<li><a href="/front/#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
											<li><a href="/front/#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>

							</div>

							<div class="col-lg-3 footer_col">

								<!-- Footer Contact -->
								<div class="footer_section footer_contact">
									<div class="footer_title">Contact Us</div>
									<div class="footer_contact_info">
										<ul>
											<li>{{$contact->gmail??'N/A'}}</li>
											<li>Phone:  {{$contact->phone_no??'N/A'}}</li>
											<li>{!! $contact->address??'N/A' !!}</li>
										</ul>
									</div>
								</div>

							</div>

							<div class="col-lg-3 footer_col">

								<!-- Footer links -->
								<div class="footer_section footer_links">
									{{-- <div class="footer_title">Contact Us</div> --}}
									<div class="footer_links_container">
										<ul>
											<li><a href="/">Home</a></li>
											<li><a href="/about">About</a></li>
											<li><a href="/contact">Contact</a></li>
											<li><a href="/blogs">Blog</a></li>

									</div>
								</div>

							</div>

							{{-- <div class="col-lg-3 footer_col clearfix">

								<!-- Footer links -->
								<div class="footer_section footer_mobile">
									<div class="footer_title">Mobile</div>
									<div class="footer_mobile_content">
										<div class="footer_image"><a href="/front/#"><img src="/front/images/mobile_1.png" alt=""></a></div>
										<div class="footer_image"><a href="/front/#"><img src="/front/images/mobile_2.png" alt=""></a></div>
									</div>
								</div>

							</div> --}}

						</div>
					</div>
				</div>
			</div>

			{{-- <div class="row copyright_row">
				<div class="col">
					<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
						<div class="cr_text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="/front/https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
						<div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a href="/front/#">Copyright notification</a></li>
								<li><a href="/front/#">Terms of Use</a></li>
								<li><a href="/front/#">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</footer>
</div>

<script src="/front/js/jquery-3.2.1.min.js"></script>
<script src="/front/styles/bootstrap4/popper.js"></script>
<script src="/front/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/front/plugins/greensock/TweenMax.min.js"></script>
<script src="/front/plugins/greensock/TimelineMax.min.js"></script>
<script src="/front/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/front/plugins/greensock/animation.gsap.min.js"></script>
<script src="/front/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/front/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/front/plugins/easing/easing.js"></script>
<script src="/front/plugins/parallax-js-master/parallax.min.js"></script>
<script src="/front/js/custom.js"></script>

@yield('script')
</body>
</html>
