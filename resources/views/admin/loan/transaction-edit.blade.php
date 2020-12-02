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
                    <h2>
                        <small>লেনদেন এডিট করুন</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item active">লেনদেন এডিট করুন</li>
                    </ul>
                </div>
            </div>
        </div>

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
            <div class="card shadow">

                <div class="header">

                    <h2><strong> লেনদেন এডিট করুন</strong> </h2>

                </div>

                <div class="body">

                    <form action="{{url('admin/loan-transaction/'.$loan_transaction->id)}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row clearfix">

                            <div class="col-lg-6 col-md-6 c0l-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  সদস্য বাছাই করুন</small></label>

                                    <select class="form-control ms z-index show-tick selectpicker" name="user_id" id="user_id" data-live-search="true" onchange="getLoans(this.value)">

                                        <option value="">-- বাছাই করুন --</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}" {{$member->id==$loan->user_id?'selected':''}} >{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-6 c0l-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  লোণ  বাছাই করুন</small></label>

                                    <select class="form-control ms " name="loan_id" id="loan_id" onchange="getFdrDetails(this.value)">
                                        <option value="">-- বাছাই করুন --</option>

                                        @foreach($users_loans??array() as $users_loan)

                                                <option value="{{$users_loan->id}}" {{$loan_transaction->loan_id==$users_loan->id?'selected':''}} >লোণ নং
                                                ঃ {{$users_loan->unique_id}} | মোট লোণ {{$users_loan->approved_amount}} | লাভের হার ঃ {{$users_loan->interest_rate}}% | সময়কাল ঃ {{$users_loan->duration}} মাস | তারিখ  ঃ {{$users_loan->started_at}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> জমার পরিমান</small></label>

                                    <input type="number" step="any" class="form-control" name="amount" placeholder="জমার পরিমান" id="amount" value="{{$loan_transaction->type=='collect'?$loan_transaction->incoming:$loan_transaction->outgoing}}">

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> জমার তারিখ </small></label>

                                    <input type="date" class="form-control" name="date" placeholder="জমার তারিখ" value="{{date('Y-m-d',strtotime($loan_transaction->date))}}">

                                </div>

                            </div>

                            <div class="col-md-12 text-center">

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
    function getLoans(user_id)
    {
        var list = $("#loan_id");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getLoansByUser') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": user_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {

                    list.append(new Option('ঋণ  নংঃ '+item.unique_id+' | লাভের হার : '+item.interest_rate+' | সময়কাল: '+item.interest_rate+' | তারিখ :'+item.started_at, item.id));

                });
            },

            error: function (error) {
                console.log(error);
            },

        });

    }
</script>
<script>
    function getLoanDetails(loan_id)
    {
        $.ajax({
            type: "POST",
            url: "{{ route('getLoanDetails') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "loan_id": loan_id,
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
