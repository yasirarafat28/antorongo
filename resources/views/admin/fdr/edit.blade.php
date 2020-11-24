@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Main Content -->

<!-- Dropzone Css -->
<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/timeline.css')}}">

<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12"></div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">সঞ্চয় অধিভুক্তির ফর্ম </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
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

                    <h2><strong> বাক্তিগত</strong>  তথ্য</h2>

                </div>

                <div class="body">
                    <form method="POST" action="{{route('FdrUpdate',$fdr->id)}}">
                        {{csrf_field()}}
                        <div class="row clearfix">

                            <div class="col-lg-5 col-md-5 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সদস্য বাছাই করুন</small></label>

                                    <select name="user_id" id="user_id" onchange="getUser(this.value)" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                        <option value="no">সদস্য বাছাই করুন</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}" {{$member->id==$fdr->user_id?'selected':''}} >{{$member->name_bn}} - {{$member->unique_id}} </option>
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
                                            <option value="{{$member->id}}"  {{$member->id==$fdr->identifier_id?'selected':''}} >{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>তারিখ </small></label>

                                    <input type="date" class="form-control" placeholder="তারিখ " name="date" value="{{date('Y-m-d',strtotime($fdr->started_at))}}" id="date">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>পরিমান </small></label>

                                    <input type="number" step="any" class="form-control" placeholder="পরিমান " name="amount" value="{{App\FdrTransaction::where('fdr_id',$fdr->id)->where('type','deposit')->first()->amount??0}}" id="amount">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> লাভের ধরন </small></label>

                                    <select name="profit_type" id="profit_type" class="form-control ms">
                                        <option value="">বাছাই করুন</option>
                                        <option value="daily" {{$fdr->profit_type=='daily'?'selected':''}} >দৈনিক</option>
                                        <option value="monthly" {{$fdr->profit_type=='monthly'?'selected':''}} > মাসিক</option>
                                        <option value="yearly" {{$fdr->profit_type=='yearly'?'selected':''}} > বাৎসরিক </option>

                                    </select>

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সময়কাল (মাস)</small></label>

                                    <input type="text" class="form-control" placeholder="সময়কাল " name="duration" value="{{$fdr->duration}}" id="amount">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>লাভের হার (%) </small></label>

                                    <input type="text" class="form-control" placeholder="লাভের হার " name="interest_rate" value="{{$fdr->interest_rate}}" id="amount">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> এফ ডি আর আইডি</small></label>

                                    <input type="text" class="form-control" placeholder="এফ ডি আর আইডি " name="fdr_unique_id" value="{{$fdr->txn_id}}" id="fdr_unique_id">

                                </div>

                            </div>






                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> অবস্থা  </small></label>

                                    <select name="stat" id="stat" class="form-control ms">
                                        <option value="">বাছাই করুন</option>
                                        <option value="approved" {{$fdr->status=='approved'?'selected':''}} >Active</option>
                                        <option value="pending" {{$fdr->status=='pending'?'selected':''}} > Pending</option>
                                        <option value="declined" {{$fdr->status=='declined'?'selected':''}} > Declined </option>
                                        <option value="closed" {{$fdr->status=='closed'?'selected':''}} > Closed </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> বিস্তারিত </small></label>

                                    <textarea class="form-control" placeholder="বিস্তারিত " name="note"  id="note">{{$fdr->note}}</textarea>

                                </div>

                            </div>







                                <div class="col-lg-12 col-md-6 col-sm-12 text-center">

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
