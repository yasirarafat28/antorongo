
@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inbox.css')}}">


<section class="content inbox">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>View Email
                <small>Welcome to {{\App\Setting::setting()->app_name}}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                    <li class="breadcrumb-item active">View Email</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-t-0 m-b-20">{{$item->subject}}</h4>
                                <hr>
                                <div class="media">
                                    <div class="float-left">
                                        <div class="m-r-20"> <img class="rounded" src="{{url($item->user->photo ??'')}}"  onerror="this.src='{{url('images/no_img_avaliable.jpg')}}';" width="60" alt=""> </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="m-b-0">
                                            <strong class="text-muted m-r-5">From:</strong>
                                            <a href="javascript:void(0);" class="text-default">{{$item->user->email ??''}}</a>
                                            <span class="text-muted text-sm float-right">{{$item->created_at}}</span>
                                        </p>
                                        <p class="m-b-0">
                                            <strong class="text-muted m-r-10">To:</strong>Me
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <p>{{$item->message}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="body">
                        <strong>Click here to</strong> <a href="{{url('compose?to='.$item->email)}}">Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('script')

@endsection
