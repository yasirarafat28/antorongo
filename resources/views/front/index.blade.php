@extends('layouts.app')

@section('content')


<div class="home">
    <div class="home_slider_container">

        <!-- Home Slider -->
        <div class="owl-carousel owl-theme home_slider">

            <!-- Home Slider Item -->

            @php
                $cover_photo = App\Gallery::where('status','active')->where('flag','web_cover_photo')->orderBy('created_at','DESC')->first();
            @endphp
            <div class="owl-item">
                <div class="home_slider_background" style="background-image:url({{($cover_photo->cover_photo)}});"></div>
                <div class="home_slider_content">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <div class="home_slider_title text-uppercase" style="color:#fff">{{\App\Setting::setting()->app_name}}</div>
                                <div class="home_slider_subtitle"></div>
                                {{-- <div class="home_slider_form_container">
                                    <form action="#" id="home_search_form_1" class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <input type="search" class="home_search_input" placeholder="Keyword Search" required="required">
                                            <select class="dropdown_item_select home_search_input">
                                                <option>Category Courses</option>
                                                <option>Category</option>
                                                <option>Category</option>
                                            </select>
                                            <select class="dropdown_item_select home_search_input">
                                                <option>Select Price Type</option>
                                                <option>Price Type</option>
                                                <option>Price Type</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="home_search_button">search</button>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Home Slider Item -->
            @php
                $cover_photo_tow = App\Gallery::where('status','active')->where('flag','web_cover_photo_two')->orderBy('created_at','DESC')->first();
            @endphp
            <div class="owl-item">
                <div class="home_slider_background" style="background-image:url({{($cover_photo_tow->photo??'')}});"></div>
                <div class="home_slider_content">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <div class="home_slider_title">{{\App\Setting::setting()->app_name}}</div>
                                {{-- <div class="home_slider_subtitle">Future Of Education Technology</div>
                                    <div class="home_slider_form_container">
                                    <form action="#" id="home_search_form_2" class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <input type="search" class="home_search_input" placeholder="Keyword Search" required="required">
                                            <select class="dropdown_item_select home_search_input">
                                                <option>Category Courses</option>
                                                <option>Category</option>
                                                <option>Category</option>
                                            </select>
                                            <select class="dropdown_item_select home_search_input">
                                                <option>Select Price Type</option>
                                                <option>Price Type</option>
                                                <option>Price Type</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="home_search_button">search</button>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Home Slider Item -->
            {{-- <div class="owl-item">
                <div class="home_slider_background" style="background-image:url(/front/images/home_slider_1.jpg)"></div>
                <div class="home_slider_content">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <div class="home_slider_title">The Premium System Education</div>
                                <div class="home_slider_subtitle">Future Of Education Technology</div>
                                <div class="home_slider_form_container">
                                    <form action="#" id="home_search_form_3" class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <input type="search" class="home_search_input" placeholder="Keyword Search" required="required">
                                            <select class="dropdown_item_select home_search_input">
                                                <option>Category Courses</option>
                                                <option>Category</option>
                                                <option>Category</option>
                                            </select>
                                            <select class="dropdown_item_select home_search_input">
                                                <option>Select Price Type</option>
                                                <option>Price Type</option>
                                                <option>Price Type</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="home_search_button">search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

    <!-- Home Slider Nav -->

    <div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
    <div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
</div>

<!-- Features -->

@php
$services = App\Service::where('status','active')->orderBy('created_at','DESC')->skip(0)->take(6)->get();
@endphp

<div class="features">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">আমাদের সেবাসমূহ</h2>
                    {{-- <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div> --}}
                </div>
            </div>
        </div>
        <div class="row features_row">

            <!-- Features Item -->
            @foreach ($services as $service)

            <div class="col-lg-4 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="/front/images/icon_2.png" alt="icon"></div>
                    <h3 class="feature_title"><a href="/about">{{$service->title??'N/A'}}</a></h3>
                    <div class="feature_text"><p>{!! substr($service->description??'N/A',0,30)!!}...</p></div>
                </div>
            </div>
            @endforeach
            <!-- Features Item -->
            {{-- <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="/front/images/icon_2.png" alt=""></div>
                    <h3 class="feature_title">Book & Library</h3>
                    <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
                </div>
            </div> --}}

            <!-- Features Item -->
            {{-- <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="/front/images/icon_3.png" alt=""></div>
                    <h3 class="feature_title">Best Courses</h3>
                    <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
                </div>
            </div> --}}

            <!-- Features Item -->
            {{-- <div class="col-lg-3 feature_col">
                <div class="feature text-center trans_400">
                    <div class="feature_icon"><img src="/front/images/icon_4.png" alt=""></div>
                    <h3 class="feature_title">Award & Reward</h3>
                    <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
                </div>
            </div> --}}

        </div>
    </div>
</div>

<!-- Counter -->

<div class="counter">
    <div class="counter_background" style="background-image:url(/front/images/counter_background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="counter_content text-center">
                    <h2 class="counter_title ">সেবা গ্রহনকারী সদস্য সংখ্যা</h2>
                    <div class="counter_text"><p></p></div>

                    <!-- Milestones -->

                    <div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">

                        <!-- Milestone -->
                        @php
                            $saving = App\Saving::where('status','approved')->count();
                        @endphp

                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="{{$saving}}">0</div>
                            <div class="milestone_text">চলতি সঞ্চয় একাউন্ট</div>
                        </div>

                        <!-- Milestone -->
                        @php
                            $fdr = App\Fdr::where('status','approved')->count();
                        @endphp

                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="{{$fdr}}">0</div>
                            <div class="milestone_text">চলতি এফডিআর একাউন্ট</div>
                        </div>

                        <!-- Milestone -->
                        @php
                            $loan = App\Loan::where('status','active')->count();
                        @endphp

                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="{{$loan}}">0</div>
                            <div class="milestone_text">চলতি ঋণ একাউন্ট</div>
                        </div>



                        {{-- <!-- Milestone -->
                        <div class="milestone">
                            <div class="milestone_counter" data-end-value="320">0</div>
                            <div class="milestone_text">years</div>
                        </div> --}}

                    </div>
                </div>

            </div>
        </div>

        {{-- <div class="counter_form">
            <div class="row fill_height">
                <div class="col fill_height">
                    <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" action="#">
                        <div class="counter_form_title">courses now</div>
                        <input type="text" class="counter_input" placeholder="Your Name:" required="required">
                        <input type="tel" class="counter_input" placeholder="Phone:" required="required">
                        <select name="counter_select" id="counter_select" class="counter_input counter_options">
                            <option>Choose Subject</option>
                            <option>Subject</option>
                            <option>Subject</option>
                            <option>Subject</option>
                        </select>
                        <textarea class="counter_input counter_text_input" placeholder="Message:" required="required"></textarea>
                        <button type="submit" class="counter_form_button">submit now</button>
                    </form>
                </div>
            </div>
        </div> --}}

    </div>
</div>

<!-- Events -->
        @php
        $blogs = App\Blog::where('status','active')->orderBy('created_at','DESC')->skip(0)->take(3)->get();
        @endphp

<div class="events">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">আমাদের ব্লগ</h2>
                    {{-- <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div> --}}
                </div>
            </div>
        </div>
        <div class="row events_row">

            <!-- Event -->
            @foreach ($blogs as $blog)

            <div class="col-lg-4 event_col">
                <div class="event event_left">
                    <div class="event_image">
                        <img src={{asset($blog->feature_image??'')}} alt="Image" onerror="this.src='/front/images/no_img_avaliable.jpg';">
                    </div>
                    <div class="event_body d-flex flex-row align-items-start justify-content-start">
                        {{-- <div class="event_date">
                            <div class="d-flex flex-column align-items-center justify-content-center trans_200">
                                <div class="event_day trans_200">21</div>
                                <div class="event_month trans_200">Aug</div>
                            </div>
                        </div> --}}
                        <div class="event_content">
                            <div class="event_title"><a href="/blogs">{{$blog->title??'N?A'}}</a></div>
                            <div class="event_info_container">
                                <div class="event_info"><i class="fa fa-clock-o" aria-hidden="true"></i><span>{{\App\NumberConverter::en2bn($blog->created_at)}}</span></div>
                                {{-- <div class="event_info"><i class="fa fa-map-marker" aria-hidden="true"></i><span>25 New York City</span></div> --}}
                                <div class="event_text">
                                    <p>{!! substr($blog->description??'N/A',0,100) !!}...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Event -->
            {{-- <div class="col-lg-4 event_col">
                <div class="event event_mid">
                    <div class="event_image"><img src="/front/images/event_2.jpg" alt=""></div>
                    <div class="event_body d-flex flex-row align-items-start justify-content-start">
                        <div class="event_date">
                            <div class="d-flex flex-column align-items-center justify-content-center trans_200">
                                <div class="event_day trans_200">27</div>
                                <div class="event_month trans_200">Aug</div>
                            </div>
                        </div>
                        <div class="event_content">
                            <div class="event_title"><a href="/front/#">Repaying your student loans (Winter 2017-2018)</a></div>
                            <div class="event_info_container">
                                <div class="event_info"><i class="fa fa-clock-o" aria-hidden="true"></i><span>09.00 - 17.30</span></div>
                                <div class="event_info"><i class="fa fa-map-marker" aria-hidden="true"></i><span>25 Brooklyn City</span></div>
                                <div class="event_text">
                                    <p>This Consumer Action News issue covers topics now being debated before...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Event -->
            {{-- <div class="col-lg-4 event_col">
                <div class="event event_right">
                    <div class="event_image"><img src="/front/images/event_3.jpg" alt=""></div>
                    <div class="event_body d-flex flex-row align-items-start justify-content-start">
                        <div class="event_date">
                            <div class="d-flex flex-column align-items-center justify-content-center trans_200">
                                <div class="event_day trans_200">01</div>
                                <div class="event_month trans_200">Sep</div>
                            </div>
                        </div>
                        <div class="event_content">
                            <div class="event_title"><a href="/front/#">Alternative data and financial inclusion</a></div>
                            <div class="event_info_container">
                                <div class="event_info"><i class="fa fa-clock-o" aria-hidden="true"></i><span>13.00 - 18.30</span></div>
                                <div class="event_info"><i class="fa fa-map-marker" aria-hidden="true"></i><span>25 New York City</span></div>
                                <div class="event_text">
                                    <p>Policy analysts generally agree on a need for reform, but not on which path...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>

<!-- Team -->
@php
    $teams = App\Team::where('status','active')->orderBy('created_at','DESC')->get();
@endphp
<div class="team">
    <div class="team_background parallax-window" data-parallax="scroll" data-image-src="/front/images/team_background.jpg" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">কার্যনির্বাহী সদস্যদের বক্তব্য</h2>
                    {{-- <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div> --}}
                </div>
            </div>
        </div>
        <div class="row team_row">

            <!-- Team Item -->
            @foreach ($teams as $team)

            <div class="col-lg-3 col-md-6 team_col">
                <div class="team_item">
                    <div class="team_image"><img src="{{url($team->photo??"")}}" alt="image"></div>
                    <div class="team_body">
                        <div class="team_title"><a href="{{url('/details/'.$team->id)}}">{{$team->name??'N/A'}}</a></div>
                        <div class="team_subtitle">{{$team->title}}</div>
                        <div class="social_list">
                            <ul>
                                <li><a href="/front/#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Team Item -->
            {{-- <div class="col-lg-3 col-md-6 team_col">
                <div class="team_item">
                    <div class="team_image"><img src="/front/images/team_2.jpg" alt=""></div>
                    <div class="team_body">
                        <div class="team_title"><a href="/front/#">William James</a></div>
                        <div class="team_subtitle">Designer & Website</div>
                        <div class="social_list">
                            <ul>
                                <li><a href="/front/#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Team Item -->
            {{-- <div class="col-lg-3 col-md-6 team_col">
                <div class="team_item">
                    <div class="team_image"><img src="/front/images/team_3.jpg" alt=""></div>
                    <div class="team_body">
                        <div class="team_title"><a href="/front/#">John Tyler</a></div>
                        <div class="team_subtitle">Quantum mechanics</div>
                        <div class="social_list">
                            <ul>
                                <li><a href="/front/#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Team Item -->
            {{-- <div class="col-lg-3 col-md-6 team_col">
                <div class="team_item">
                    <div class="team_image"><img src="/front/images/team_4.jpg" alt=""></div>
                    <div class="team_body">
                        <div class="team_title"><a href="/front/#">Veronica Vahn</a></div>
                        <div class="team_subtitle">Math & Physics</div>
                        <div class="social_list">
                            <ul>
                                <li><a href="/front/#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="/front/#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>

<!-- Latest News -->

{{-- <div class="news">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title_container text-center">
                    <h2 class="section_title">Latest News</h2>
                    <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div>
                </div>
            </div>
        </div>
        <div class="row news_row">
            <div class="col-lg-7 news_col">

                <!-- News Post Large -->
                <div class="news_post_large_container">
                    <div class="news_post_large">
                        <div class="news_post_image"><img src="/front/images/news_1.jpg" alt=""></div>
                        <div class="news_post_large_title"><a href="/front/blog_single.html">Here’s What You Need to Know About Online Testing for the ACT and SAT</a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="/front/#">admin</a></li>
                                <li><a href="/front/#">november 11, 2017</a></li>
                            </ul>
                        </div>
                        <div class="news_post_text">
                            <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take. Can America learn anything from other nations...</p>
                        </div>
                        <div class="news_post_link"><a href="/front/blog_single.html">read more</a></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 news_col">
                <div class="news_posts_small">

                    <!-- News Posts Small -->
                    <div class="news_post_small">
                        <div class="news_post_small_title"><a href="/front/blog_single.html">Home-based business insurance issue (Spring 2017 - 2018)</a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="/front/#">admin</a></li>
                                <li><a href="/front/#">november 11, 2017</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- News Posts Small -->
                    <div class="news_post_small">
                        <div class="news_post_small_title"><a href="/front/blog_single.html">2018 Fall Issue: Credit Card Comparison Site Survey (Summer 2018)</a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="/front/#">admin</a></li>
                                <li><a href="/front/#">november 11, 2017</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- News Posts Small -->
                    <div class="news_post_small">
                        <div class="news_post_small_title"><a href="/front/blog_single.html">Cuentas de cheques gratuitas una encuesta de Consumer Action</a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="/front/#">admin</a></li>
                                <li><a href="/front/#">november 11, 2017</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- News Posts Small -->
                    <div class="news_post_small">
                        <div class="news_post_small_title"><a href="/front/blog_single.html">Troubled borrowers have fewer repayment or forgiveness options</a></div>
                        <div class="news_post_meta">
                            <ul>
                                <li><a href="/front/#">admin</a></li>
                                <li><a href="/front/#">november 11, 2017</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Newsletter -->

{{-- <div class="newsletter">
    <div class="newsletter_background parallax-window" data-parallax="scroll" data-image-src="/front/images/newsletter.jpg" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Newsletter Content -->
                    <div class="newsletter_content text-lg-left text-center">
                        <div class="newsletter_title">sign up for news and offers</div>
                        <div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals we offer</div>
                    </div>

                    <!-- Newsletter Form -->
                    <div class="newsletter_form_container ml-lg-auto">
                        <form action="#" id="newsletter_form" class="newsletter_form d-flex flex-row align-items-center justify-content-center">
                            <input type="email" class="newsletter_input" placeholder="Your Email" required="required">
                            <button type="submit" class="newsletter_button">subscribe</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
