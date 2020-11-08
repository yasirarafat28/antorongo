@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inbox.css')}}">
<section class="content inbox">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{url('member/dashboard')}}"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">বার্তা লিখুন</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">

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

                    <div class="header">
                        <h2><strong>বার্তা  </strong> লিখুন<small></small> </h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form action="{{url('compose-submit')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group form-float">
                                        <input type="email" class="form-control" placeholder="প্রাপক" name="to_user_id" value="{{$_GET['to'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group form-float">
                                        <input type="text" class="form-control" placeholder=" বিষয়" name="subject">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <strong>বার্তা:</strong>
                                    <textarea id="ckeditor" name="message"></textarea>
                                    <button type="submit" class="btn btn-primary btn-round waves-effect m-t-20">বার্তা লিখুন</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('script')

@endsection
