@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inbox.css')}}">
<section class="content inbox">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Inbox
                <small>Welcome to {{\App\Setting::setting()->app_name}}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">Inbox</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-6">
                                <form action="">
                                    <div class="input-group search">
                                        <input type="text" class="form-control" placeholder="Search..." name="search">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-search"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6 col-3 text-right">
                                <div class="btn-group hidden-sm-down">
                                    <button type="button" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More<span class="caret"></span> </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">All</a></li>
                                        <li><a href="javascript:void(0);">Unread</a></li>
                                        <li><a href="javascript:void(0);">Read</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <ul class="mail_list list-group list-unstyled">
                    @foreach($inqueries as $item)
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pull-left">
                                    <div class="thumb hidden-sm-down m-r-20"> <img src="{{url($item->user->photo ?? '')}}"  onerror="this.onerror=null;this.src='{{asset('assets/images/xs/avatar1.jpg')}}';" class="rounded-circle" alt=""> </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="{{url('/inbox/'.$item->id)}}" class="m-r-10">{{$item->user->name}}</a>
                                        <span class="badge bg-blue">{{$item->user->roles()->first()->name ?? ''}}</span>
                                        <small class="float-right text-muted"><time class="hidden-sm-down" datetime="2017">{{$item->created_at}}</time><i class="zmdi zmdi-attachment-alt"></i> </small>
                                    </div>
                                    <p class="msg">{{$item->message}} </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="card m-t-5">
                    <div class="body">
                        {!! $inqueries->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('script')

@endsection


