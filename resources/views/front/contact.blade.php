@extends('layouts.app')
@section('style')

<link rel="stylesheet" type="text/css" href="front/styles/contact.css">

@endsection

@section('content')
	<!-- Home -->

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="{{url('/')}}">Home</a></li>
								<li>Contact</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->

	<div class="contact">

		<!-- Contact Map -->
{{--
		<div class="contact_map"> --}}

			<!-- Google Map -->

			{{-- <div class="map">
				<div id="google_map" class="google_map">
					<div class="map_container">
						<div id="map"></div>
					</div>
				</div>
			</div>

		</div> --}}

		<!-- Contact Info -->

		<div class="contact_info_container">
			<div class="container">
                @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
				<div class="row">

					<!-- Contact Form -->
					<div class="col-lg-6">
						<div class="contact_form">
							<div class="contact_info_title">যোগাযোগের ফর্ম</div>
							<form action="{{url('admin/enquiries')}}" class="comment_form"accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}
								<div>
									<div class="form_title">প্রথম নাম</div>
									<input type="text" class="comment_input" name="first_name" required="required" placeholder="প্রথম নাম">
								</div>
								<div>
									<div class="form_title">শেষ নাম</div>
									<input type="text" class="comment_input" name="last_name" placeholder="শেষ নাম">
								</div>
								<div>
									<div class="form_title">ইমেল</div>
									<input type="email" class="comment_input" required="required" name="email" placeholder="ইমেল">
								</div>
								<div>
									<div class="form_title">ফোন</div>
									<input type="text" class="comment_input" name="phone" placeholder="ফোন">
								</div>
								<div>
									<div class="form_title">বিষয় </div>
									<input type="text" class="comment_input" name="subject" placeholder="বিষয়">
								</div>
								<div>
									<div class="form_title">মেসেজ</div>
									<textarea class="comment_input comment_textarea" required="required" placeholder="মেসেজ" name="description"></textarea>
								</div>
								<div>
									<button type="submit" class="comment_button trans_200">বার্তা পাঠান</button>
								</div>
							</form>
						</div>
					</div>

					<!-- Contact Info -->
                    @php
                        $contacts = App\Contact::where('status','active')->orderBy('created_at','DESC')->take(3)->get();
                    @endphp
					<div class="col-lg-6">
						<div class="contact_info">
							<div class="contact_info_title">যোগাযোগের তথ্য</div>
							{{-- <div class="contact_info_text">
								<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a distribution of letters.</p>
							</div> --}}
                            @foreach ($contacts as $contact)

							<div class="contact_info_location">
								<div class="contact_info_location_title">অফিস</div>
								<ul class="location_list">
									<li>{!!$contact->address??'N/A'!!}</li>
									<li>{{$contact->phone_no??'N/A'}}</li>
									<li>{{$contact->moblie_no??'N/A'}}</li>
									<li>{{$contact->gmail??'N/A'}}</li>
								</ul>
							</div>
                            @endforeach
							{{-- <div class="contact_info_location">
								<div class="contact_info_location_title">Australia Office</div>
								<ul class="location_list">
									<li>Forrest Ray, 191-103 Integer Rd, Corona Australia</li>
									<li>1-234-567-89011</li>
									<li>info.deercreative@gmail.com</li>
								</ul>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	{{-- <div class="newsletter">
		<div class="newsletter_background" style="background-image:url(images/newsletter_background.jpg)"></div>
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




@section('script')
    {{-- <script src="front/js/contact.js"></script> --}}
@endsection
