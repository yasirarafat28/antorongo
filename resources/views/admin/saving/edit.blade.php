@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Main Content -->

<!-- Dropzone Css -->
<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/timeline.css')}}">

<section class="content profile-page">

    <div class="container-fluid">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h3><small>তথ্য এডিট করুন</small></h3>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item active">তথ্য এডিট করুন</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12">

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="card shadow">

                <div class="header">

                    <h2><strong>তথ্য</strong> এডিট করুন</h2>

                </div>

                <div class="body">
                    <form method="POST" action="{{route('SavingUpdate',$saving->id)}}">
                        {{csrf_field()}}
                        <div class="row clearfix">



                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সঞ্চয়ের ধরন </small></label>

                                    <select name="type" id="type" class="form-control ms" onchange="getPackages(this.value)">
                                        <option value="">বাছাই করুন</option>
                                        <option value="daily" {{'daily'==$saving->type?'selected':''}} >দৈনিক</option>
                                        <option value="short" {{'short'==$saving->type?'selected':''}} > স্বল্প মেয়াদী </option>
                                        <option value="long" {{'long'==$saving->type?'selected':''}} >দীর্ঘ মেয়াদী </option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সদস্য বাছাই করুন</small></label>

                                    <select name="user_id" id="user_id" onchange="getUser(this.value)" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                        <option value="no">সদস্য বাছাই করুন</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}" {{$member->id==$saving->user_id?'selected':''}} >{{$member->name_bn}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> পরিচয় প্রদান কারী(পরিচালক সভ্য)</small></label>

                                    <select name="identifier_id" id="identifier_id" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                        <option value="">বাছাই করুন</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}"  {{$member->id==$saving->identifier_id?'selected':''}} >{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 daily-field"  style="display:  {{$saving->type=='short' || $saving->type=='long'?'none':'block'}}" >

                                <div class="form-group">

                                    <label for=""><small> দৈনিক সঞ্চয়ের পরিমান </small></label>

                                    <input type="number" step="any" class="form-control" placeholder="দৈনিক সঞ্চয়ের পরিমান " name="installment_amount" value="{{$saving->installment_amount}}" id="date">
                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 daily-field"  style="display:  {{$saving->type=='short' || $saving->type=='long'?'none':'block'}}">

                                <div class="form-group">

                                    <label for=""><small> সময়কাল (মাস) </small></label>

                                    <input type="number" step="any" class="form-control" placeholder="সময়কাল (মাস) " name="duration" value="{{$saving->duration}}" id="date">
                                </div>

                            </div>


                            <div class="col-lg-8 col-md-8 col-sm-12  term-field" style="display:  {{ $saving->type=='daily'?'none':'block'}}">

                                <div class="form-group">

                                    <label for=""><small> পাকেজ বাছাই করুন</small></label>

                                    <select name="package_id" id="package_id" class="form-control ms"  data-live-search="true">
                                        <option value="">বাছাই করুন</option>
                                        @foreach($packages??array() as $item)
                                            <option value="{{$item->id}}"   {{$item->id==$saving->package_id?'selected':''}}  >{{$item->name}} | জমার পরিমান : {{\App\NumberConverter::en2bn($item->installment_amount)}}| মোট জমা : {{\App\NumberConverter::en2bn($item->target_amount)}} | মোট ফেরত : {{\App\NumberConverter::en2bn($item->return_amount)}}  - {{$item->type=='long'?'দীর্ঘ মেয়াদী':'সল্প মেয়াদী'}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>তারিখ </small></label>

                                    <input type="date" class="form-control" placeholder="তারিখ " name="date" value="{{date('Y-m-d',strtotime($saving->started_at))}}" id="date">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> বিস্তারিত </small></label>

                                    <textarea class="form-control" placeholder="বিস্তারিত " name="note"  id="note">{{$saving->note}}</textarea>

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> অবস্থা  </small></label>

                                    <select name="stat" id="stat" class="form-control ms">
                                        <option value="">বাছাই করুন</option>
                                        <option value="approved" {{$saving->status=='approved'?'selected':''}} >Active</option>
                                        <option value="pending" {{$saving->status=='pending'?'selected':''}} > Pending</option>
                                        <option value="declined" {{$saving->status=='declined'?'selected':''}} > Declined </option>
                                        <option value="closed" {{$saving->status=='closed'?'selected':''}} > Closed </option>

                                    </select>

                                </div>

                            </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                                    <button type="submit" class="btn btn-info btn-round"> সেভ করুন</button>
                                </div>

                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</section>

<script src="{{asset('assets/plugins/dropzone/dropzone.js')}}"></script> <!-- Dropzone Plugin Js -->
<script>

	function getPackages(type)
	{
		if (type==='daily')
		{
			$('.daily-field').show();
			$('.term-field').hide();
		}else{

        	$('.daily-field').hide();
        	$('.term-field').show();

	        var list = $("#package_id");
	        list.children('option:not(:first)').remove();
	        $.ajax({
	            type: "POST",
	            url: "{{ route('getPackaesByType') }}",
	            data: {
	                "_token": "{{ csrf_token() }}",
	                "type": type,
	            },
	            success:function(data) {
	                console.log(data);
	                jQuery.each(data, function(index, item) {

                        list.append(new Option(item.name+' | জমার পরিমান: '+item.installment_amount+' | মোট জমা:  '+item.target_amount+' | মোট ফেরত:'+item.return_amount, item.id));
	                });
	            },

	            error: function (error) {
	                console.log(error);
	            },

	        });
	    }

	}


    //Image Preview
    function photoURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#photo-img').attr('src', e.target.result);
                $('#photo-img').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    function signatureURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#signature-img').attr('src', e.target.result);
                $('#signature-img').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@endsection


@section('script')

@endsection
