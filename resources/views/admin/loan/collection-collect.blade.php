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
                <div class="col-lg-6 col-md-4 col-sm-12">
                    <h3><small>কালেকশন/আদায় করুন</small></h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">কালেকশন/আদায় করুন</a></li>
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

                    {{-- <div class="header">
                        <h2><strong>সঞ্চয় খুঁজুন</strong><small></small> </h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>কালেকশন/আদায় করুন</h2>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                    <div class="body members_profiles">
                        <form method="GET">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="ঋণ  নাম্বার" name="q" value="{{$query}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <hr>
                    @if($loan)

                        <div class="row mb-3">

                            <div class="col-md-12 text-center mb-3">
                                <h2><strong> ঋণ</strong> বিস্তারিত</h2>
                            </div>

                            <div class="col-md-4">
                                <div class="body">

                                    <table class="table table-stripped">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">নাম :</td>
                                                <td class="text-left">{{$loan->user->name}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">সভ্য আইডি : </td>
                                                <td class="text-left">{{$loan->user->unique_id}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">ঋণ আইডি : </td>
                                                <td class="text-left">{{$loan->unique_id}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">
                                                    ঋণের পরিমান  :
                                                </td>
                                                <td class="text-left">
                                                    @if($loan->status=='active')
                                                    {{\App\NumberConverter::en2bn($loan->approved_amount)}}
                                                    @else
                                                        {{\App\NumberConverter::en2bn($loan->request_amount)}}
                                                    @endif
                                                    টাকা
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">
                                                    মোট পরিশোধ যোগ্য  :
                                                </td>
                                                <td class="text-left">
                                                    <?php
                                                    if ($loan->status=='active')
                                                        $payable = $loan->approved_amount + ($loan->approved_amount* $loan->interest_rate/100);
                                                    else
                                                        $payable = $loan->request_amount + ($loan->request_amount* $loan->interest_rate/100);
                                                    ?>

                                                    {{\App\NumberConverter::en2bn($payable)}} টাকা
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">
                                                    মোট পরিশোধ :
                                                </td>
                                                <td class="text-left">
                                                    {{\App\NumberConverter::en2bn($transactions->sum('incoming'))}} টাকা
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    মোট বকেয়া :
                                                </td>
                                                <td class="text-left">
                                                    {{\App\NumberConverter::en2bn($payable-$transactions->sum('incoming'))}} টাকা
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    অবস্থা :
                                                </td>
                                                <td class="text-left">
                                                    {{$loan->status}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                                {{-- <span class="m-t-0 m-b-0"><strong>নামঃ  {{$loan->user->name}}</strong></span>
                                                <hr>

                                                <span class="job_post">সভ্য আইডি : {{$loan->user->unique_id}}</span>

                                                <hr>

                                                <span class="job_post">ঋণ আইডি : {{$loan->unique_id}}</span>
                                                <hr>


                                                <span class="job_post"> ঋণের পরিমান  :
                                                @if($loan->status=='active')
                                                        {{\App\NumberConverter::en2bn($loan->approved_amount)}}
                                                    @else
                                                        {{\App\NumberConverter::en2bn($loan->request_amount)}}
                                                    @endif

                                                টাকা </span>

                                                <hr>


                                                <span class="job_post"> মোট পরিশোধ যোগ্য  :
                                                <?php
                                                    if ($loan->status=='active')
                                                        $payable = $loan->approved_amount + ($loan->approved_amount* $loan->interest_rate/100);
                                                    else
                                                        $payable = $loan->request_amount + ($loan->request_amount* $loan->interest_rate/100);
                                                    ?>

                                                    {{\App\NumberConverter::en2bn($payable)}} টাকা </span>

                                                <hr>

                                                <span class="job_post"> মোট পরিশোধ : {{\App\NumberConverter::en2bn($transactions->sum('incoming'))}} টাকা </span>

                                                <hr>

                                                <span class="job_post"> মোট বকেয়া : {{\App\NumberConverter::en2bn($payable-$transactions->sum('incoming'))}} টাকা </span>

                                                <hr>

                                                <span class="job_post"> অবস্থা : {{$loan->status}} </span> --}}
                                </div>
                                    <hr>
                                 <br>
                            </div>
                            <div class="col-md-8">

                                <div class="row">

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        @php
                                         $total_balance =0;
                                        @endphp
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            মোট জমা
                                                        </div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">৪৫৩ টি</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Pending Requests Card Example -->
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            মোট লাভ
                                                        </div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">$ ৩৪৫৩৪</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            মোট উত্তোলন
                                                        </div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">$ ৩৪৫৩৪</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            বর্তমান ব্যালেন্স
                                                        </div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">$ ৩৪৫৩৪</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a data-toggle="modal" data-target="#collection_coll_Modal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> কিস্তি আদায় করুন </a>
                            </div>

                            {{-- <div class="col-lg-5 col-md-5 col-sm-12 offset-1">

                                <div class="header">

                                    <h2><strong> কিস্তি আদায় </strong>  করুন</h2>

                                </div>
                                <form action="{{route('LoanDepositSubmit')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="loan_id" value="{{$loan->id}}">
                                    <input type="hidden" name="user_id" value="{{$loan->user_id}}">


                                    <div class="col-lg-12 col-md-12">

                                        <div class="form-group">

                                            <label for=""><small> কিস্তির পরিমান</small></label>

                                            <input type="number" step="any" class="form-control" name="amount" placeholder="{{$loan->installment_amount}}" value="{{old('amount')}}">

                                        </div>

                                    </div>

                                    <div class="col-lg-12 col-md-12">

                                        <div class="form-group">

                                            <label for=""><small> তারিখ </small></label>

                                            <input type="text" class="form-control datepicker" name="date" placeholder=" তারিখ" value="{{old('date')}}">

                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">

                                        <div class="form-group">

                                            <label for=""><small> মতামত </small></label>

                                            <textarea name="note" class="form-control" placeholder="মতামত">{{old('note')}}</textarea>

                                        </div>

                                    </div>

                                    <div class="col-md-6 offset-3">

                                        <button class="btn btn-primary btn-round"> কিস্তি আদায় করুন</button>

                                    </div>
                                </form>

                            </div> --}}

                                <!--  Modal Start -->
                        <div class="modal fade" id="collection_coll_Modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2><strong> কিস্তি আদায় </strong>  করুন</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('LoanDepositSubmit')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" name="loan_id" value="{{$loan->id}}">
                                            <input type="hidden" name="user_id" value="{{$loan->user_id}}">


                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> কিস্তির পরিমান</small></label>

                                                    <input type="number" step="any" class="form-control" name="amount" placeholder="{{$loan->installment_amount}}" value="{{old('amount')}}">

                                                </div>

                                            </div>

                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> তারিখ </small></label>

                                                    <input type="text" class="form-control datepicker" name="date" placeholder=" তারিখ" value="{{old('date')}}">

                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> মতামত </small></label>

                                                    <textarea name="note" class="form-control" placeholder="মতামত">{{old('note')}}</textarea>

                                                </div>

                                            </div>

                                            <div class="col-md-12 text-center">

                                                <button class="btn btn-primary btn-round"> কিস্তি আদায় করুন</button>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Add Modal End-->

                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if($transactions)
            <div class="row clearfix">

                <div class="col-sm-12 col-md-12 col-lg-12">

                    <div class="card shadow">

                        <div class="header">

                            <h2><strong> পরিশোধ এর </strong>  রেকর্ড</h2>

                            <ul class="header-dropdown">

                                <li class="remove">

                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                                </li>

                            </ul>

                        </div>

                        <div class="body table-responsive members_profiles">

                            <table class="table table-hover">

                                <thead>

                                <tr>

                                    <th> #</th>
                                    <th>আদায়কারীর নাম</th>

                                    <th> লেনদেন কোড </th>
                                    <th> লেনদেনের ধরন </th>

                                    <th>পরিমান</th>
                                    <th> অবস্থা</th>

                                    <th> পরিশোধের সময়</th>

                                </tr>

                                </thead>

                                <tbody>
                                @foreach($transactions??array() as $item)


                                    <tr>

                                        <td>

                                            <a href="{{url('admin/loan-transaction/'.$item->id.'/edit')}}" class="btn btn-icon btn-neutral btn-icon-mini"><i class="zmdi zmdi-edit"> </i></a>
                                            <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                                {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/loan-transaction', $item->id],
                                                'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-times"></i> ', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs btnper',
                                                    'title' => 'Delete user',
                                                    'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                    )) !!}
                                                {!! Form::close() !!}
                                            </a>
                                        </td>                                    <td>{{$item->receiver->name??''}}</td>

                                        <td>{{$item->txn_id??''}}</td>
                                        <td>
                                            @if($item->type=='collect')
                                                কিস্তি গ্রহণ
                                            @else
                                                বিতরন
                                            @endif
                                        </td>

                                        <td style="color: green;font-weight: 700;">

                                            @if($item->type=='collect')
                                                + {{\App\NumberConverter::en2bn($item->incoming)}} টাকা
                                            @else
                                                - {{\App\NumberConverter::en2bn($item->outgoing)}} টাকা
                                            @endif

                                        </td>
                                        <td>নিশ্চিত </td>
                                        <td>{{\App\NumberConverter::en2bn(date("d-m-Y",strtotime($item->date)))}}</td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>
        @endif
    </div>
</section>

@endsection


@section('script')

@endsection

