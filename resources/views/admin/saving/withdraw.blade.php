@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>
    .dataTables_wrapper .dt-buttons{
        display: none;
    }
</style>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">সঞ্চয় খুঁজুন</a></li>
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
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card">

                    <div class="header">
                        <h2><strong>সঞ্চয় খুঁজুন</strong><small></small> </h2>
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
                                        <input type="text" class="form-control" placeholder="সঞ্চয় নাম্বার" name="q" value="{{$query}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <hr>
                    @if($saving)

                    <div class="col-md-12 row mb-3">



                        <div class="col-lg-2 col-md-2 col-sm-12">

                            <div class="mt-5 profile-image float-md-right"> <img src="{{url($saving->user->photo??'')}}" onerror="this.onerror=null;this.src='{{asset('images/no_img_avaliable.jpg')}}';"> </div>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">

                            <div class="header">

                                <h2><strong> সঞ্চয় </strong> বিস্তারিত</h2>

                            </div>

                            <span class="m-t-0 m-b-0"><strong>নামঃ  {{$saving->user->name}}</strong></span>
                            <hr>

                            <span class="job_post">সভ্য আইডি : {{$saving->user->unique_id??''}}</span>

                            <hr>

                            <span class="job_post">সঞ্চয় আইডি : {{$saving->txn_id??''}}</span>
                            <hr>
                            <span class="job_post">ধরন :
                                @if($saving->type=='short')
                                    স্বল্প মেয়াদী (৫ বছর মেয়াদী)
                                @elseif($saving->type=='long')
                                    দীর্ঘ মেয়াদী (১০ বছর মেয়াদী)
                                @else
                                    দৈনিক
                                @endif

                            </span>

                            <?php
                                $deposited  = $transactions->where('type','deposit')->sum('amount');
                                $total_profit  = $transactions->where('type','profit')->sum('amount');
                                $total_withdraw  = $transactions->sum('outgoing');

                            ?>

                            <hr>
                            @if($saving->type=='daily')
                                <span class="job_post"> মোট জমা হয়েছে : {{\App\NumberConverter::en2bn($deposited)}} টাকা </span>

                                <hr>
                            @else

                                <span class="job_post"> পলিসির পরিমান  : {{\App\NumberConverter::en2bn($saving->target_amount)}} টাকা </span>

                                <hr>

                                <span class="job_post"> মোট জমা হয়েছে : {{\App\NumberConverter::en2bn($deposited)}} টাকা </span>

                                <hr>

                                <span class="job_post"> মোট লাভ হয়েছে : {{\App\NumberConverter::en2bn($total_profit)}} টাকা </span>

                                <hr>

                                <span class="job_post"> মোট  ফেরত : {{\App\NumberConverter::en2bn($saving->return_amount)}} টাকা </span>

                                <hr>
                            @endif

                            <span class="job_post"> অবস্থা : {{$saving->status}} </span>

                            <hr>

                            <br>

                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12 offset-1">

                            <div class="header">

                                <h2><strong> উত্তোলন </strong>  করুন</h2>

                            </div>
                            <form action="{{url('admin/saving/withdraw')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="saving_id" value="{{$saving->id}}">
                                <input type="hidden" name="user_id" value="{{$saving->user_id}}">


                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> উত্তলনের পরিমান</small></label>

                                        <input type="number" step="any" class="form-control" name="amount" placeholder="উত্তলনের পরিমান" id="amount">

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> উত্তলনের তারিখ </small></label>

                                        <input type="date" class="form-control" name="date" placeholder="উত্তলনের তারিখ">

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> মতামত </small></label>

                                        <textarea name="note" class="form-control" placeholder="মতামত"></textarea>

                                    </div>

                                </div>

                                <div class="col-md-6 offset-3">

                                    <button class="btn btn-primary btn-round"> উত্তোলন করুন</button>

                                </div>
                            </form>

                        </div>
                    </div>
                    @endif
                </div>

            </div>

        </div>

        @if($transactions)
        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card">

                    <div class="header">

                        <h2><strong> সঞ্চয় </strong> এর লেনদেন রেকর্ড</h2>

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

                                <th>সিরিয়াল</th>

                                <th> তারিখ</th>
                                <th> মাস </th>
                                <th> লেনদেন কোড </th>
                                <th> লেনদেনের ধরন </th>
                                <th>পরিমান</th>
                                <th>ব্যালেন্স</th>
                                <th> নোট</th>
                                <th>আদায়কারীর নাম</th>
                                <th> #</th>

                            </tr>

                            </thead>

                            <tbody>
                            @php
                                $total =0;
                            @endphp
                            @foreach($transactions as $item)


                                <tr>

                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->date)}}</td>
                                    <td>{{ \App\BanglaMonth::MonthName(date('m',strtotime($item->date)))}}</td>

                                    <td>{{$item->txn_id??''}}</td>
                                    <td>
                                        @if($item->type=='deposit')
                                            জমা
                                        @elseif($item->type=='profit')
                                            লাভ
                                        @else
                                            উত্তোলন
                                        @endif
                                    </td>

                                    <td style="color: green;font-weight: 700;">

                                        @php
                                            $total +=$item->amount;
                                            $total -=$item->outgoing;
                                        @endphp


                                        @if($item->type=='deposit' || $item->type=='profit')
                                            + {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                        @else
                                            - {{\App\NumberConverter::en2bn($item->outgoing)}} টাকা
                                        @endif

                                    </td>
                                    <td>{{\App\NumberConverter::en2bn($total)}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{$item->receiver->name??''}}</td>
                                    <td>


                                        <a href="{{url('admin/saving-transaction/'.$item->id.'/edit')}}" class="btn btn-icon btn-neutral btn-icon-mini"><i class="zmdi zmdi-edit"> </i></a>
                                        <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/saving-transaction', $item->id],
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
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td  colspan="5" class="text-right">
                                    মোট জমা

                                </td>
                                <td>
                                    {{\App\NumberConverter::en2bn($deposited)}} টাকা
                                </td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td  colspan="5" class="text-right">
                                    মোট লাভ

                                </td>
                                <td>
                                    {{\App\NumberConverter::en2bn($total_profit)}} টাকা ({{\App\NumberConverter::en2bn(number_format($total_profit/$deposited*100,2))}}%)
                                </td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td  colspan="5" class="text-right">
                                    মোট উত্তোলন

                                </td>
                                <td>
                                    {{\App\NumberConverter::en2bn($total_withdraw)}} টাকা
                                </td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td  colspan="5" class="text-right">
                                    বর্তমান ব্যালেন্স

                                </td>
                                <td>
                                    {{\App\NumberConverter::en2bn($total)}} টাকা
                                </td>
                                <td colspan="3"></td>
                            </tr>

                            @if($saving->status=='closed')
                                <tr>
                                    <td colspan="8">

                                        <div class="alert alert-danger">
                                            সদস্য পদ প্রত্যাহার

                                        </div>
                                    </td>
                                </tr>
                            @endif

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

