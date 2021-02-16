@extends('layouts.front')

@section('content')

    {{-- @php
        $cover_photos = App\Gallery::where('status','active')->orderBy('created_at','DESC')->skip(0)->take(1)->get();
    @endphp --}}

<div class="site-blocks-cover overlay" style="background-image: url(/front/images/bg.jpg);" data-aos="fade"
            id="home-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-10 mt-lg-5 text-center">
                        <div class="single-text owl-carousel">
                            <div class="slide">

                                <h1 class="text-uppercase" data-aos="fade-up">Banking Solutions</h1>
                                <p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit. Provident cupiditate suscipit, magnam libero velit
                                    esse sapiente officia inventore!</p>
                                <div data-aos="fade-up" data-aos-delay="100">
                                </div>
                            </div>
                            <div class="slide">
                                <h1 class="text-uppercase" data-aos="fade-up">Financing Solutions</h1>
                                <p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit. Provident cupiditate suscipit, magnam libero velit
                                    esse sapiente officia inventore!</p>
                            </div>
                            <div class="slide">
                                <h1 class="text-uppercase" data-aos="fade-up">Savings Accounts</h1>
                                <p class="mb-5 desc" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit. Provident cupiditate suscipit, magnam libero velit
                                    esse sapiente officia inventore!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#next" class="mouse smoothscroll">
                <span class="mouse-icon">
                    <span class="mouse-wheel"></span>
                </span>
            </a>
        </div>
        {{-- <div class="site-section" id="next">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="">
                        <img src="/front/images/flaticon-svg/svg/001-wallet.svg"
                            alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                        <h3 class="card-title">Money Savings</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                    <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                        <img src="/front/images/flaticon-svg/svg/004-cart.svg" alt="Free Website Template by Free-Template.co"
                            class="img-fluid w-25 mb-4">
                        <h3 class="card-title">Online Shoppings</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                    <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="/front/images/flaticon-svg/svg/006-credit-card.svg"
                            alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                        <h3 class="card-title">Credit / Debit Cards</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <figure class="circle-bg">
                            <img src="/front/images/xabout_2.jpg.pagespeed.ic.Zl67ccZIcY.jpg"
                                alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="mb-4">
                            <h3 class="h3 mb-4 text-black">Amortization Computation</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                        <div class="mb-4">
                            <ul class="list-unstyled ul-check success">
                                <li>Officia quaerat eaque neque</li>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Consectetur adipisicing elit</li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <form action="#">
                                <div class="form-group d-flex align-items-center">
                                    <input type="text" class="form-control mr-2" placeholder="Enter your email">
                                    <input type="submit" class="btn btn-primary" value="Submit Email">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="site-section cta-big-image" id="about-section">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">About Us</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Minus minima neque tempora reiciendis.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <figure class="circle-bg">
                            <img src="/front/images/xhero_1.jpg.pagespeed.ic.ZeXIvT04Y8.jpg"
                                alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-black mb-4">We Solve Your Financial Problem</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the
                            Semantics, a large language ocean.</p>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                            It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <section class="site-section">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">How It Works</h2>
                        <p class="lead" data-aos="fade-up" data-aos-delay="100">A small river named Duden flows by their
                            place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
                <div class="row align-items-lg-center">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <div class="owl-carousel slide-one-item-alt">
                            <img src="/front/images/xslide_1.jpg.pagespeed.ic.fA5zBG0R3e.jpg" alt="Image" class="img-fluid">
                            <img src="/front/images/xslide_2.jpg.pagespeed.ic.GtvDQr4YIq.jpg" alt="Image" class="img-fluid">
                            <img src="/front/images/xslide_3.jpg.pagespeed.ic.gYpyGBp8kN.jpg" alt="Image" class="img-fluid">
                        </div>
                        <div class="custom-direction">
                            <a href="#" class="custom-prev"><span><span
                                        class="icon-keyboard_backspace"></span></span></a><a href="#"
                                class="custom-next"><span><span class="icon-keyboard_backspace"></span></span></a>
                        </div>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="owl-carousel slide-one-item-alt-text">
                            <div>
                                <h2 class="section-title mb-3">01. Online Applications</h2>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                                    into your mouth.</p>
                                <p><a href="#" class="btn btn-primary mr-2 mb-2">Learn More</a></p>
                            </div>
                            <div>
                                <h2 class="section-title mb-3">02. Get an approval</h2>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                                    into your mouth.</p>
                                <p><a href="#" class="btn btn-primary mr-2 mb-2">Learn More</a></p>
                            </div>
                            <div>
                                <h2 class="section-title mb-3">03. Card delivery</h2>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                                    into your mouth.</p>
                                <p><a href="#" class="btn btn-primary mr-2 mb-2">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section class="site-section border-bottom bg-light" id="services-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">Our Services</h2>
                    </div>
                </div>
                <div class="row align-items-stretch">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="/front/images/flaticon-svg/svg/001-wallet.svg"
                                    alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Business Consulting</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia.</p>
                                <p><a href="#">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="/front/images/flaticon-svg/svg/006-credit-card.svg"
                                    alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Credit Card</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia.</p>
                                <p><a href="#">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="/front/images/flaticon-svg/svg/002-rich.svg"
                                    alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Income Monitoring</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia.</p>
                                <p><a href="#">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="/front/images/flaticon-svg/svg/003-notes.svg"
                                    alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Insurance Consulting</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia.</p>
                                <p><a href="#">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="/front/images/flaticon-svg/svg/004-cart.svg"
                                    alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Financial Investment</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia.</p>
                                <p><a href="#">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="unit-4">
                            <div class="unit-4-icon">
                                <img src="/front/images/flaticon-svg/svg/005-megaphone.svg"
                                    alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            </div>
                            <div>
                                <h3>Financial Management</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia.</p>
                                <p><a href="#">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="site-section" id="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <figure class="circle-bg">
                            <img src="/front/images/xhero_1.jpg.pagespeed.ic.ZeXIvT04Y8.jpg"
                                alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="row">
                            <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="">
                                <div class="unit-4 d-flex">
                                    <div class="unit-4-icon mr-4 mb-3"><span class="text-primary flaticon-head"></span>
                                    </div>
                                    <div>
                                        <h3>Bank Loan</h3>
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                            Consonantia, there live the blind texts.</p>
                                        <p class="mb-0"><a href="#">Learn More</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                                <div class="unit-4 d-flex">
                                    <div class="unit-4-icon mr-4 mb-3"><span
                                            class="text-primary flaticon-smartphone"></span></div>
                                    <div>
                                        <h3>Banking Consulation </h3>
                                        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a
                                            large language ocean.</p>
                                        <p class="mb-0"><a href="#">Learn More</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Blog Section Start -->

        <section class="site-section" id="blog-section">


            @php
                $blogs = App\Blog::where('status','active')->orderBy('created_at','DESC')->skip(0)->take(3)->get();
            @endphp


            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">আমাদের ব্লগ</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
                        <div class="h-entry">
                            <a href="#">
                                <img src={{asset($blog->feature_image??'')}} alt="Image" class="img-fluid" onerror="this.src='/front/images/no_img_avaliable.jpg';">
                            </a>
                            <h2 class="font-size-regular"><a href="#">{{$blog->title??''}}</a></h2>
                            <div class="meta mb-4">{{\App\NumberConverter::en2bn($blog->created_at)}}</div>
                            <p>{!! $blog->description??'' !!}</p>
                            <p><a href="#">Continue Reading...</a></p>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="h-entry">
                            <a href="single.html">
                                <img src="/front/images/img_4.jpg.pagespeed.ce.fdIf3piKv8.jpg" alt="Image" class="img-fluid">
                            </a>
                            <h2 class="font-size-regular"><a href="#">A Basic Guide to Starting a Franchise in the
                                    Philippines</a></h2>
                            <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span
                                    class="mx-2">&bullet;</span> <a href="#">News</a></div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores
                                sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                            <p><a href="#">Continue Reading...</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="h-entry">
                            <a href="single.html">
                                <img src="/front/images/ximg_3.jpg.pagespeed.ic.EW44kTwGRi.jpg" alt="Image" class="img-fluid">
                            </a>
                            <h2 class="font-size-regular"><a href="#">A Basic Guide to Starting a Franchise in the
                                    Philippines</a></h2>
                            <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span
                                    class="mx-2">&bullet;</span> <a href="#">News</a></div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores
                                sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                            <p><a href="#">Continue Reading...</a></p>
                        </div>
                    </div> --}}
                @endforeach
                </div>
            </div>
        </section>

        <!--Blog Section End -->

        <!-- Contact Section start -->

        @php
            $contacts = App\Contact::where('status','active')->orderBy('created_at','DESC')->skip(0)->take(1)->get();
        @endphp

        <section class="site-section bg-light" id="contact-section" data-aos="fade">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">যোগাযোগ করুন</h2>
                    </div>
                </div>
                <div class="row mb-5">
                @foreach ($contacts as $contact)

                    <div class="col-md-4 text-center">
                        <p class="mb-4">
                            <span class="icon-room d-block h2 text-primary"></span>
                            <span>{!! $contact->address??"N/A" !!}</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-4">
                            <span class="icon-phone d-block h2 text-primary"></span>
                            <a href="#">{{$contact->phone_no??'N/A'}}</a> <br>
                            <a href="#">{{$contact->mobile_no??''}}</a>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-0">
                            <span class="icon-mail_outline d-block h2 text-primary"></span>
                            <a href="#">{{$contact->gmail??'N/A'}}</a>
                        </p>
                    </div>
                @endforeach
                </div>
                <div class="row">
                    {{-- <div class="col-md-12 mb-5">
                        <form action="#" class="p-5 bg-white">
                            <h2 class="h4 text-black mb-5">Contact Form</h2>
                            <div class="row form-group">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="text-black" for="fname">First Name</label>
                                    <input type="text" id="fname" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black" for="lname">Last Name</label>
                                    <input type="text" id="lname" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="email">Email</label>
                                    <input type="email" id="email" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="subject">Subject</label>
                                    <input type="subject" id="subject" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="message">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="7" class="form-control"
                                        placeholder="Write your notes or questions here..."></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                                </div>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </section>

@endsection
