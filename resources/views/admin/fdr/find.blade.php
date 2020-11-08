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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">এফ ডি আর খুঁজুন</a></li>
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
                        <h2><strong>এফ ডি আর খুঁজুন</strong><small></small> </h2>
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
                                        <input type="text" class="form-control" placeholder="এফ ডি আর নাম্বার" name="q" value="{{$query}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <hr>
                    @if($fdr)

                        @php
                            $total_deposited = $fdr->transactions->where('type','deposit')->sum('amount');
                            $total_profit = $fdr->transactions->where('type','profit')->sum('amount');
                            $total_withdraw = $fdr->transactions->where('type','withdraw')->sum('amount');

                        @endphp

                    <div class="col-md-12 row mb-3">



                        <div class="col-lg-2 col-md-2 col-sm-12">

                            <div class="mt-5 profile-image float-md-right"> <img src="{{url($fdr->user->photo??'')}}" onerror="this.onerror=null;this.src='{{asset('images/no_img_avaliable.jpg')}}';"> </div>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">

                            <div class="header">

                                <h2><strong> এফ ডি আর </strong> বিস্তারিত</h2>

                            </div>

                            <span class="m-t-0 m-b-0"><strong>নামঃ  {{$fdr->user->name}}</strong></span>
                            <hr>

                            <span class="job_post">সভ্য আইডি : {{$fdr->user->unique_id??''}}</span>

                            <hr>

                            <span class="job_post">এফ ডি আর আইডি : {{$fdr->txn_id??''}}</span>
                            <hr>
                            <span class="job_post">ধরন :
                                @if($fdr->profit_type=='daily')
                                    দৈনিক
                                @elseif($fdr->profit_type=='weekly')
                                    মাসিক
                                @else
                                    বাৎসরিক
                                @endif

                            </span>

                            <hr>

                            <span class="job_post">  টাকার পরিমান  : {{\App\NumberConverter::en2bn($fdr->transactions->where('type','deposit')->sum('amount'))}} টাকা </span>

                            <hr>

                            <span class="job_post"> মোট প্রাপ্ত লাভ  : {{\App\NumberConverter::en2bn($fdr->transactions->where('type','profit')->sum('amount'))}} টাকা || <button
                                        class="btn btn-primary" id="add_profit_add_btn" onclick="Add_profit_Wrapper()">লাভ যোগ করুন </button></span>

                            <hr>

                            <span class="job_post"> অবস্থা : {{$fdr->status}} </span>

                            <hr>
                            <br>

                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12 offset-1">

                            <div class="header">

                                <h2><strong> উত্তোলন </strong>  করুন</h2>

                            </div>
                            <form action="{{url('admin/fdr/withdraw')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}

                                <input type="hidden" name="fdr_id" value="{{$fdr->id}}">
                                <input type="hidden" name="user_id" value="{{$fdr->user_id}}">
                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> উত্তলনের উৎস </small></label>
                                        <select name="withdraw_source" id="" class="form-control ms">
                                            <option value="revenue">মূলধনসহ উত্তোলন</option>
                                            <option value="profit"> লাভ উত্তোলন</option>
                                        </select>


                                    </div>

                                </div>
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

        @if($fdr->transactions)
        <div class="row clearfix"  id="add-profit-wrapper" style="display: none;">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card">

                    <div class="header">

                        <h2><strong> এফ ডি আর </strong> এর লাভ যোগ করুন</h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>

                    <div class="body table-responsive members_profiles">
                        <form action="{{url('admin/fdr/add-profit-manually')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                            {{csrf_field()}}

                            <input type="hidden" name="fdr_id" value="{{$fdr->id}}">
                            <input type="hidden" name="user_id" value="{{$fdr->user_id}}">

                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> লাভের পরিমান</small></label>

                                    <input type="number" step="any" class="form-control" name="amount" placeholder="লাভের পরিমান" id="amount">

                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12">

                                <div class="form-group">

                                    <label for=""><small> লাভের তারিখ </small></label>

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

                                <button class="btn btn-primary btn-round"> লাভ যোগ  করুন</button>

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($fdr->transactions)
        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card">

                    <div class="header">

                        <h2><strong> এফ ডি আর </strong> এর লেনদেন রেকর্ড</h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>

                    <div class="body table-responsive members_profiles datatable ">

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
                                $total_balance =0;
                            @endphp
                            @foreach($transactions as $item)


                                <tr>

                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->started_at)}}</td>
                                    <td>{{ \App\BanglaMonth::MonthName(date('m',strtotime($item->started_at)))}}</td>

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

                                        @if($item->type=='deposit' || $item->type=='profit')
                                            + {{\App\NumberConverter::en2bn($item->amount)}} টাকা

                                            @php
                                                $total_balance +=$item->amount;
                                            @endphp
                                        @else
                                            - {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                            @php
                                                $total_balance -=$item->amount;
                                            @endphp
                                        @endif

                                    </td>
                                    <td>
                                        {{\App\NumberConverter::en2bn($total_balance)}} টাকা
                                    </td>
                                    <td>{{$item->note??''}}</td>
                                    <td>{{$item->receiver->name??''}}</td>

                                    <td>



                                            <a href="{{url('admin/fdr-transaction/'.$item->id.'/edit')}}" class="btn btn-icon btn-neutral btn-icon-mini"><i class="zmdi zmdi-edit"> </i></a>
                                            <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                                {!! Form::open([
                                                   'method'=>'DELETE',
                                                   'url' => ['/admin/fdr-transaction', $item->id],
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
                                        {{\App\NumberConverter::en2bn($total_deposited)}} টাকা
                                    </td>
                                    <td  colspan="4"></td>
                                </tr>
                                <tr>
                                    <td  colspan="5" class="text-right">
                                        মোট লাভ

                                    </td>
                                    <td>
                                        {{\App\NumberConverter::en2bn($total_profit)}} টাকা ({{\App\NumberConverter::en2bn(number_format($total_profit/$total_deposited*100,2))}}%)
                                    </td>
                                    <td  colspan="4"></td>
                                </tr>
                                <tr>
                                    <td  colspan="5" class="text-right">
                                        মোট উত্তোলন

                                    </td>
                                    <td>
                                        {{\App\NumberConverter::en2bn($total_withdraw)}} টাকা
                                    </td>
                                    <td  colspan="4"></td>
                                </tr>
                                <tr>
                                    <td  colspan="5" class="text-right">
                                        বর্তমান ব্যালেন্স

                                    </td>
                                    <td>
                                        {{\App\NumberConverter::en2bn($total_balance)}} টাকা
                                    </td>
                                    <td  colspan="4"></td>
                                </tr>

                                @if($fdr->status=='closed')
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

<script>
    function Add_profit_Wrapper()
    {

        $('#add-profit-wrapper').toggle();

        // /$(this).next(".add-profit-wrapper").toggle();
    }
</script>

@endsection


@section('script')

@endsection

