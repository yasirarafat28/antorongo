@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/timeline.css')}}">
<!-- Main Content -->
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Dashboard
                    <small>Welcome to {{\App\Setting::setting()->app_name}}</small>
                </h2>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">

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
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>Find User</strong><small></small> </h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body members_profiles">

                        <form method="GET">
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="ID/Username/Email" name="q" value="{{$query}}">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <button class="btn btn-primary btn-round">Find</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    @if($user)
                    <hr>
                        <div class="col-md-8 offset-2 row mb-3">

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="profile-image float-md-right"> <img src="{{asset('assets/images/profile_av.jpg')}}" alt=""> </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-12">
                                <h4 class="m-t-0 m-b-0"><strong>{{$user->name}}</strong></h4>
                                <span class="job_post">ID : {{$user->unique_id}}</span>
                                <hr>
                                <span class="job_post">Email : {{$user->email}}</span>
                                <hr>
                                <span class="job_post">UserName : {{$user->username}}</span>
                                <br>
                                    <a onclick="return confirm('Are you Sure?')" href="{{url('access-generate/password/'.$user->id)}}" class="btn btn-success btn-round" >Generate Password</a>
                                    <a onclick="return confirm('Are you Sure?')" href="{{url('access-generate/username/'.$user->id)}}" class="btn btn-danger btn-round" >Generate Username</a>
                                    <a onclick="return confirm('Are you Sure?')" href="{{url('access-generate/id/'.$user->id)}}" class="btn btn-danger btn-round" >Generate ID</a>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>
</section>
@endsection


@section('script')

@endsection
