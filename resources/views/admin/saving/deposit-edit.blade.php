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
            <div class="card shadow">

                <div class="header">

                    <h2><strong> জমা এডিট করুন</strong> </h2>

                </div>

                <div class="body">

                    <form action="{{url('admin/saving-transaction/'.$saving_transaction->id)}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="row clearfix">

                            <div class="col-lg-6 col-md-6 c0l-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  সদস্য বাছাই করুন</small></label>

                                    <select class="form-control ms z-index show-tick selectpicker" name="user_id" id="user_id" data-live-search="true" onchange="getSavings(this.value)">

                                        <option value="">-- বাছাই করুন --</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}" {{$member->id==$saving->user_id?'selected':''}} >{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-6 c0l-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  সঞ্চয় বাছাই করুন</small></label>

                                    <select class="form-control ms " name="saving_id" id="saving_id" onchange="getSavingDetails(this.value)">
                                        <option value="">-- বাছাই করুন --</option>

                                        @foreach($users_savings??array() as $users_saving)
                                            @if($users_saving->type=='daily')
                                                <option value="{{$users_saving->id}}" {{$saving_transaction->saving_id==$users_saving->id?'selected':''}} >সঞ্চয় নংঃ {{$users_saving->txn_id}} | কিস্তির পরিমান: {{$users_saving->installment_amount}} | তারিখ :{{$users_saving->started_at}}</option>
                                            @else
                                                <option value="{{$users_saving->id}}" {{$saving_transaction->saving_id==$users_saving->id?'selected':''}} >সঞ্চয় নংঃ {{$users_saving->txn_id}} | কিস্তির পরিমান: {{$users_saving->installment_amount}} | মোট জমা:  {{$users_saving->target_amount}} | মোট ফেরত:{{$users_saving->return_amount}} | তারিখ :{{$users_saving->started_at}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> জমার পরিমান</small></label>

                                    <input type="number" step="any" class="form-control" name="amount" placeholder="জমার পরিমান" id="amount" value="{{$saving_transaction->type=='deposit'||$saving_transaction->type=='profit'?$saving_transaction->amount:$saving_transaction->outgoing}}">

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> জমার তারিখ </small></label>

                                    <input type="date" class="form-control" name="date" placeholder="জমার তারিখ" value="{{date('Y-m-d',strtotime($saving_transaction->date))}}">

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
    function getSavings(user_id)
    {
        var list = $("#saving_id");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getSavingsByUser') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": user_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {
                    if (item.type==='daily')

                        list.append(new Option('সঞ্চয় নংঃ '+item.txn_id+' | কিস্তির পরিমান: '+item.installment_amount+' | তারিখ :'+item.started_at, item.id));
                    else
                        list.append(new Option('সঞ্চয় নংঃ '+item.txn_id+' | কিস্তির পরিমান: '+item.installment_amount+' | মোট জমা:  '+item.target_amount+' | মোট ফেরত:'+item.return_amount+' | তারিখ :'+item.started_at, item.id));
                });
            },

            error: function (error) {
                console.log(error);
            },

        });

    }
</script>
<script>
    function getSavingDetails(saving_id)
    {
        $.ajax({
            type: "POST",
            url: "{{ route('getSavingDetails') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "saving_id": saving_id,
            },
            success:function(data) {
                console.log(data);
                $('#amount').attr('placeholder',' আপনার কিস্তির পরিমান '+data.installment_amount+ ' টাকা');
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
