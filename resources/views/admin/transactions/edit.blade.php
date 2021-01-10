@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

</style>

<!-- Main Content -->
<section class="content">

    <div class="container-fluid">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h3><small><strong>লেনদেন পরিবর্তন</strong> করুন</small></h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">লেনদেন পরিবর্তন করুন</a></li>
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
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">


                    <hr>
                    <div class="col-md-12 row mb-3">


                        <div class="col-lg-10 col-md-10 col-sm-12 offset-1">

                            <div class="header">

                                <h2><strong>লেনদেন পরিবর্তন</strong>  করুন</h2>

                            </div>
                            <form action="{{url('admin/transactions/'.$transaction->id)}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}

                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> টাকার পরিমান </small></label>

                                        <input type="number" step="any" value="{{$transaction->amount}}" class="form-control" name="amount" placeholder="টাকার পরিমান">

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> তারিখ </small></label>

                                        <input type="date" value="{{date('Y-m-d',strtotime($transaction->date))}}" class="form-control" name="date" placeholder="উত্তলনের তারিখ">

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> নোট/বিস্তারিত </small></label>

                                        <textarea name="note" class="form-control" placeholder="নোট/বিস্তারিত">{{$transaction->note}}</textarea>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <input id="remember_me_2" name="invoice" type="checkbox">
                                            <label for="remember_me_2">
                                                টাকা জমার রশিদ
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">

                                    <button class="btn btn-primary btn-round"> সেভ করুন</button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection


@section('script')

@endsection

