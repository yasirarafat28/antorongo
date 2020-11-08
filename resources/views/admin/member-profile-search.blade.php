@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Main Content -->

<!-- Dropzone Css -->
<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.css')}}">

<style>

    @media print {
        .example-screen {
            display: none;
        }
        .printable {
            display: block;
        }
    }
</style>

<link rel="stylesheet" href="{{asset('assets/css/timeline.css')}}">
<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Profile
                    <small>Welcome to {{\App\Setting::setting()->app_name}}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
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
                <div class="card">
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
                </div>
            </div>
        </div>

        @if($user)
            <div id="printable">
                <div class="row clearfix">
                    <div class="col-xl-6 col-lg-7 col-md-12">
                        <div class="card profile-header">
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="profile-image float-md-right"> <img src="{{asset('assets/images/profile_av.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-12">
                                        <h4 class="m-t-0 m-b-0"><strong>{{$user->name}}</strong></h4>
                                        <span class="job_post">{{$user->roles()->first()->name?? ''}}({{ucfirst($user->designation)}})</span>
                                        <p>{{$user->address}}</p>
                                        <p class="social-icon m-t-5 m-b-0">
                                            <a title="Twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                                            <a title="Facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a>
                                            <a title="Google-plus" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                                            <a title="Behance" href="javascript:void(0);"><i class="zmdi zmdi-behance"></i></a>
                                            <a title="Instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram "></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 col-md-12">
                        <div class="card">
                            <ul class="row profile_state list-unstyled">
                                <li class="col-lg-4 col-md-4 col-6">
                                    <div class="body">
                                        <i class="zmdi zmdi-nature-people col-amber"></i>
                                        <h5 class="m-b-0 number count-to" data-from="0" data-to="{{$added_member ?? 0}}" data-speed="1000" data-fresh-interval="700">{{$added_member ?? 0}}</h5>
                                        <small>Added Member</small>
                                    </div>
                                </li>
                                <li class="col-lg-4 col-md-4 col-6">
                                    <div class="body">
                                        <i class="zmdi zmdi-thumb-up col-blue"></i>
                                        <h5 class="m-b-0 number">{{Auth::user()->rank??0}}</h5>
                                        <small>Present Rank</small>
                                    </div>
                                </li>
                                <li class="col-lg-4 col-md-4 col-6">
                                    <div class="body">
                                        <i class="zmdi zmdi-comment-text col-red"></i>
                                        <h5 class="m-b-0 number">{{Auth::user()->designation}}</h5>
                                        <small>Present Designation</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">


                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Account</strong> Information</h2>
                            </div>
                            <div class="body">
                                <small class="text-muted">Name: </small>
                                <p>{{$user->name}}</p>
                                <hr>
                                <small class="text-muted">Father Name: </small>
                                <p>{{$user->father_name}}</p>
                                <hr>
                                <small class="text-muted">Educational Qualification: </small>
                                <p>{{$user->education_qualification}}</p>
                                <hr>
                                <small class="text-muted">Email address: </small>
                                <p>{{$user->email}}</p>
                                <hr>
                                <small class="text-muted">Phone: </small>
                                <p>{{$user->phone}}</p>
                                <hr>
                                <small class="text-muted">Mobile: </small>
                                <p>{{$user->phone_2}}</p>
                                <hr>
                                <small class="text-muted">Birth Date: </small>
                                <p class="m-b-0">{{date('F d, Y',strtotime($user->dob))}}</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="header">
                                <h2><strong>Other </strong> Information</h2>
                            </div>
                            <div class="body">
                                <small class="text-muted">User ID: </small>
                                <p>{{$user->unique_id}}</p>
                                <hr>
                                <small class="text-muted">Address: </small>
                                <p>{{$user->address}}</p>
                                <hr>
                                <small class="text-muted">Joined by: </small>
                                <p>{{\App\User::find($user->upline_1)->email ?? ''}}</p>
                                <hr>
                                <small class="text-muted">Status: </small>
                                <p>{{ucfirst($user->status)}}</p>
                                <hr>
                                <small class="text-muted">Rank: </small>
                                <p>{{$user->rank}}</p>
                                <hr>
                                <small class="text-muted">Designation: </small>
                                <p>{{$user->designation}}</p>
                                <hr>
                                <small class="text-muted">Account Created: </small>
                                <p class="m-b-0">{{date('F d, Y',strtotime($user->created_at))}}</p>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="header">
                                <h2><strong>Nominee</strong> Information</h2>
                            </div>
                            <div class="body">

                                <small class="text-muted">Name: </small>
                                <p>{{$user->nominee_name}}</p>
                                <hr>
                                <small class="text-muted">Phone: </small>
                                <p>{{$user->nominee_phone}}</p>
                                <hr>
                                <small class="text-muted">Relation: </small>
                                <p>{{$user->nominee_relation}}</p>
                                <hr>
                                <small class="text-muted">Birth Date: </small>
                                <p class="m-b-0">{{date('F d, Y',strtotime($user->nominee_dob))}}</p>
                            </div>
                        </div>

                    </div>
                </div><div class="row clearfix">


                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Recent</strong> Activity</h2>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body user_activity">
                                <div class="streamline b-accent">
                                    @foreach($activities as $item)
                                        <div class="sl-item">
                                            <img class="user rounded-circle" src="assets/images/xs/avatar4.jpg" alt="">
                                            <div class="sl-content">
                                                <h5 class="m-b-0">{{$item->topic}}</h5>
                                                <small>{{$item->activity}}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="card">
                            <div class="header">
                                <h2><strong>Members</strong></h2>
                            </div>
                            <div class="body">
                                <ul class="new_friend_list list-unstyled row">
                                    @foreach($members as $item)
                                        <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                                            <a href="{{url('chairman/member-profile/'.$item->id)}}">
                                                <img src="{{url($item->photo ?? '')}}" onerror="this.onerror=null; this.src='{{asset('assets/images/xs/avatar1.jpg')}}';" class="img-thumbnail" alt="User Image">
                                                <h6 class="users_name">{{$item->name}}</h6>
                                                <small class="join_date">{{$item->created_at}}</small>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <br>
                <div class="col-md-2 offset-5">
                    <button class="btn btn-primary" onclick="printDiv()"><i class="zmdi zmdi-print"></i> Print</button>
                </div>
            </div>
        @endif
    </div>
</section>

<script src="{{asset('assets/plugins/dropzone/dropzone.js')}}"></script> <!-- Dropzone Plugin Js -->

<script>
    function printDiv() {
        var printContents = document.getElementById('printable').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

@endsection


@section('script')

@endsection
