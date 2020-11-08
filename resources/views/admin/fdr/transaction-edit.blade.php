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
                    <li class="breadcrumb-item active">জমা করুন</li>
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
            <div class="card">

                <div class="header">

                    <h2><strong> লেনদেন এডিট করুন</strong> </h2>

                </div>

                <div class="body">

                    <form action="{{url('admin/fdr-transaction/'.$fdr_transaction->id)}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row clearfix">

                            <div class="col-lg-6 col-md-6 c0l-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  সদস্য বাছাই করুন</small></label>

                                    <select class="form-control ms z-index show-tick selectpicker" name="user_id" id="user_id" data-live-search="true" onchange="getFdrs(this.value)">

                                        <option value="">-- বাছাই করুন --</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}" {{$member->id==$fdr->user_id?'selected':''}} >{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-6 c0l-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  এফ ডি আর বাছাই করুন</small></label>

                                    <select class="form-control ms " name="fdr_id" id="fdr_id" onchange="getFdrDetails(this.value)">
                                        <option value="">-- বাছাই করুন --</option>

                                        @foreach($users_fdrs??array() as $users_fdr)

                                                <option value="{{$users_fdr->id}}" {{$fdr_transaction->fdr_id==$users_fdr->id?'selected':''}} >এফ ডি আর নং
                                                ঃ {{$users_fdr->txn_id}} | লাভের হার ঃ {{$users_fdr->interest_rate}}% | সময়কাল ঃ {{$users_fdr->duration}} মাস | তারিখ  ঃ {{$users_fdr->started_at}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> জমার পরিমান</small></label>

                                    <input type="number" step="any" class="form-control" name="amount" placeholder="জমার পরিমান" id="amount" value="{{$fdr_transaction->amount}}">

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> জমার তারিখ </small></label>

                                    <input type="date" class="form-control" name="date" placeholder="জমার তারিখ" value="{{date('Y-m-d',strtotime($fdr_transaction->started_at))}}">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <button class="btn btn-primary btn-round"> সেভ করুন</button>

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
    function getFdrs(user_id)
    {
        var list = $("#fdr_id");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getFdrsByUser') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": user_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {

                    list.append(new Option('এফ ডি আর নংঃ '+item.txn_id+' | লাভের হার : '+item.interest_rate+' | সময়কাল: '+item.interest_rate+' | তারিখ :'+item.started_at, item.id));

                });
            },

            error: function (error) {
                console.log(error);
            },

        });

    }
</script>
<script>
    function getFdrDetails(fdr_id)
    {
        $.ajax({
            type: "POST",
            url: "{{ route('getFdrDetails') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "fdr_id": fdr_id,
            },
            success:function(data) {
                console.log(data);
            },

            error: function (error) {
                console.log(error);
            },

        });

    }
</script>

@endsection


@section('script')

@endsection
