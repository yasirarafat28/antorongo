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
                    <h1 class="h3 mb-0 text-gray-800">পরিচালক আমানত  ফর্ম </h1>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item active">পরিচালক আমানত  ফর্ম </li>
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

                    <h2><strong> পরিচালক আমানত  ফর্ম </strong></h2>

                </div>

                <div class="body">
                    <form method="POST" action="{{url('admin/founder-deposit/'.$row->id)}}">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row clearfix">

                            <div class="col-lg-8 col-md-8 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সদস্য বাছাই করুন</small></label>

                                    <select name="user_id" id="user_id" onchange="getUser(this.value)" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                        <option value="no">সদস্য বাছাই করুন</option>
                                        @foreach($members??array() as $member)
                                            <option {{$row->user_id==$member->id?'selected':''}} value="{{$member->id}}">{{$member->name_bn}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>তারিখ </small></label>

                                    <input type="text" class="form-control datepicker" placeholder="তারিখ " name="date" value="{{old('date')}}" id="date">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>পরিমান </small></label>

                                    <input type="number" step="any" class="form-control" placeholder="পরিমান " name="amount" value="{{old('amount')}}" id="amount">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  বিশেষ নির্দেশনা যদি থাকে </small></label>

                                    <input type="text" class="form-control" placeholder="বিশেষ নির্দেশনা যদি থাকে" name="note" value="{{old('note')}}" id="comment">

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

@endsection


@section('script')

@endsection
