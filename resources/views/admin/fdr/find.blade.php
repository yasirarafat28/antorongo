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
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>এফ ডি আর খুঁজুন</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">এফ ডি আর খুঁজুন</a></li>
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

                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>এফ ডি আর খুঁজুন </h2>
                            </div>
                            {{-- <div class="float-right">
                                <a data-toggle="modal" data-target="#addProfiteModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> লাভ যোগ করুন </a>
                                <a data-toggle="modal" data-target="#withDrawModal" class="btn btn-primary"> <i class="fas fa-fw fa-minus"></i> উত্তোলন করুন </a>
                            </div> --}}
                        </div>

                    </div>

                    <div class="body members_profiles">
                        <form method="GET">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="এফ ডি আর নাম্বার" name="q" value="{{$query}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>
                                {{-- <div class="col-lg-3 col-md-12">
                                    @if (count($_GET))

                                        <a href="?{{$_SERVER['QUERY_STRING']}}&limit=-1" class="btn btn-success">সবগুলো দেখুন </a>
                                    @else

                                        <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন </a>

                                    @endif
                                </div> --}}
                            </div>
                        </form>
                    </div>


                    <hr>
                    @if($fdr)

                        @php
                            $total_deposited = $fdr->deposits->sum('amount');
                            $total_profit = $fdr->profits->sum('amount');
                            $total_withdraw = $fdr->withdraws->sum('amount');

                        @endphp

                    <div class="row mb-3">

                        <div class="col-md-12 text-center mb-3">
                            <h2><strong> এফ ডি আর </strong> বিস্তারিত</h2>
                        </div>



                        <div class="col-md-4">

                            <div class="body">

                                <table class="table table-stripped">
                                    <tbody>
                                        <tr>
                                            <td class="text-right">নাম :</td>
                                            <td class="text-left">{{$fdr->user->name_bn??''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">সভ্য আইডি : </td>
                                            <td class="text-left">{{$fdr->user->unique_id??''}}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">এফ ডি আর আইডি : </td>
                                            <td class="text-left">{{$fdr->txn_id??''}}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">
                                                ধরন :
                                            </td>
                                            <td class="text-left">
                                                @if($fdr->profit_type=='daily')
                                                    দৈনিক
                                                @elseif($fdr->profit_type=='weekly')
                                                    মাসিক
                                                @else
                                                    বাৎসরিক
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">
                                                টাকার পরিমান  :
                                            </td>
                                            <td class="text-left">
                                                {{\App\NumberConverter::en2bn($total_deposited)}} টাকা
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">
                                                মোট প্রাপ্ত লাভ  :
                                            </td>
                                            <td class="text-left">
                                                {{\App\NumberConverter::en2bn($total_profit)}} টাকা ||
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                অবস্থা :
                                            </td>
                                            <td class="text-left">
                                                {{$fdr->status}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <hr>
                            <br>

                        </div>

                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-xl-6 col-md-6 mb-4">
                                    @php
                                        $total =0;
                                    @endphp
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        মোট জমা
                                                    </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_deposited,2))}} টাকা </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_profit,2))}} টাকা </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        মোট উত্তোলন
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_withdraw,2))}} টাকা </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        বর্তমান মূলধন  ব্যালেন্স
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($fdr->revenue_balance(),2))}} টাকা </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        বর্তমান লাভ  ব্যালেন্স
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($fdr->profit_balance(),2))}} টাকা </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{url('admin/fdr/edit/'.$fdr->id)}}" class="btn btn-primary"><i class="fa fa-edit"> </i> এডিট</a>
                            @if($fdr->status=='pending')
                                <a href="{{url('admin/fdr-approve/'.$fdr->id)}}" class="btn btn-primary"><i class="fa fa-check"> </i> অনুমোদন করুন</a>
                                <a href="{{url('admin/fdr-decline/'.$fdr->id)}}" class="btn btn-primary"><i class="fa fa-times"> প্রত্যাখ্যান করুন</i></a>
                                <a href="{{url('admin/fdr/Remove/'.$fdr->id)}}" class="btn btn-danger"><i class="fa fa-trash" onclick="return confirm('Are you Sure?? ');"> মুছে ফেলুন </i></a>
                            @elseif($fdr->status=='approved')
                            <a data-toggle="modal" data-target="#addProfiteModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> লাভ যোগ করুন </a>
                            <a data-toggle="modal" data-target="#withDrawModal" class="btn btn-primary"> <i class="fa fa-upload"></i> উত্তোলন করুন </a>
                            <a data-toggle="modal" data-target="#FdrFineIncomeModal" class="btn btn-primary"> <i class="fa fa-upload"></i> জরিমানা করুন </a>
                                {!! Form::open([
                                    'method'=>'POST',
                                    'url' => ['/admin/fdr/close', $fdr->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>  সদস্য পদ প্রত্যাহার', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger',
                                    'title' => 'সদস্য পদ প্রত্যাহার',
                                    'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                    )) !!}
                                {!! Form::close() !!}

                            @endif



                            <a href="{{url('admin/print/fdr/'.$fdr->txn_id)}}" class="btn btn-primary"><i class="fa fa-print"> </i> প্রিন্ট </a>



                            @if ($fdr->status=='closed')
                            <br>

                            <br>

                            <div class="col-md-12">

                                <div class="alert alert-danger">
                                    সদস্য পদ প্রত্যাহার করা হয়েছে ।

                                </div>
                            </div>

                        @endif


                        </div>


                        <!--  Modal Start -->
                        <div class="modal fade" id="withDrawModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2><strong> উত্তোলন </strong>  করুন</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/fdr/withdraw')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                            {{csrf_field()}}

                                            <input type="hidden" name="fdr_id" value="{{$fdr->id}}">
                                            <input type="hidden" name="user_id" value="{{$fdr->user_id}}">

                                            @if (env('PREVIOUS_DATA_ENTRY','no')=='yes')


                                                <div class="col-lg-12 col-md-12">

                                                    <div class="form-group">

                                                        <label for=""><small> ব্যালেন্স কে অ্যাডজাস্ট করবে? </small></label>
                                                        <select name="canculatable" id="" class="form-control" required>
                                                            <option value="yes">হা  </option>
                                                            <option value="no">না</option>
                                                        </select>
                                                    </div>

                                                </div>

                                            @endif

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

                                                <button class="btn btn-primary btn-round"> উত্তোলন করুন</button>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Add Modal End-->


                        <!--  Modal Start -->
                        <div class="modal fade" id="addProfiteModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2><strong> এফ ডি আর </strong> এর লাভ যোগ করুন</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/fdr/add-profit-manually')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                            {{csrf_field()}}

                                            <input type="hidden" name="fdr_id" value="{{$fdr->id}}">
                                            <input type="hidden" name="user_id" value="{{$fdr->user_id}}">

                                            @if (env('PREVIOUS_DATA_ENTRY','no')=='yes')

                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> ব্যালেন্স কে অ্যাডজাস্ট করবে? </small></label>
                                                    <select name="canculatable" id="" class="form-control" required>
                                                        <option value="yes">হা  </option>
                                                        <option value="no">না</option>
                                                    </select>
                                                </div>

                                            </div>

                                            @endif
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

                                                <button class="btn btn-primary btn-round"> লাভ যোগ  করুন</button>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  Modal Start -->
                        <div class="modal fade" id="FdrFineIncomeModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2><strong> জরিমানা</strong> করুন</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/fdr/fine_income')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                            {{csrf_field()}}

                                            <input type="hidden" name="fdr_id" value="{{$fdr->id}}">
                                            <input type="hidden" name="user_id" value="{{$fdr->user_id}}">

                                            @if (env('PREVIOUS_DATA_ENTRY','no')=='yes')

                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> ব্যালেন্স কে অ্যাডজাস্ট করবে? </small></label>
                                                    <select name="canculatable" id="" class="form-control" required>
                                                        <option value="yes">হা  </option>
                                                        <option value="no">না</option>
                                                    </select>
                                                </div>

                                            </div>

                                            @endif
                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small>জরিমানার পরিমান</small></label>

                                                    <input type="number" step="any" class="form-control" name="amount" placeholder="লাভের পরিমান" id="amount">

                                                </div>

                                            </div>

                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> জরিমানার তারিখ </small></label>

                                                    <input type="date" class="form-control" name="date" placeholder="উত্তলনের তারিখ">

                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12">

                                                <div class="form-group">

                                                    <label for=""><small> মতামত </small></label>

                                                    <textarea name="note" class="form-control" placeholder="মতামত"></textarea>

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

                                                <button class="btn btn-primary btn-round"> লাভ যোগ  করুন</button>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                </div>

            </div>

        </div>

        @if( isset($fdr->histories) &&  $fdr->histories)

        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

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

                                    <th> #</th>
                                    <th> তারিখ</th>
                                    <th> মাস </th>
                                    <th> লেনদেন কোড </th>
                                    <th> লেনদেনের ধরন </th>
                                    <th>পরিমান</th>
                                    <!--<th>ব্যালেন্স</th>-->
                                    <th> নোট</th>
                                    <th>আদায়কারীর নাম</th>

                                </tr>

                            </thead>

                            <tbody>
                            @php
                                $total =0;
                            @endphp
                            @forelse($fdr->histories as $item)


                                <tr>

                                    <td>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                            <a href="{{url('admin/transactions/'.$item->id.'/edit')}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট</a>
                                                {!! Form::open([
                                                   'method'=>'DELETE',
                                                   'url' => ['/admin/transactions', $item->id],
                                                   'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন ', array(
                                                     'type' => 'submit',
                                                     'class' => 'dropdown-item',
                                                    'title' => 'মুছে ফেলুন',
                                                    'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                     )) !!}
                                                {!! Form::close() !!}
                                        </div>
                                    </td>
                                    <td>{{\App\NumberConverter::en2bn($item->date)}}</td>
                                    <td>{{ \App\BanglaMonth::MonthName(date('m',strtotime($item->date)))}}</td>

                                    <td>{{$item->txn_id??''}}</td>
                                    <td>
                                        @if($item->flag=='deposit')
                                            জমা
                                        @elseif($item->flag=='profit')
                                            লাভ
                                        @elseif($item->flag=='fine')
                                            জরিমানা
                                        @else
                                            উত্তোলন
                                        @endif
                                    </td>

                                    <td style="color: green;font-weight: 700;">

                                        @if($item->flag=='deposit' || $item->flag=='profit')
                                            + {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                        @else
                                            - {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                        @endif

                                    </td>
                                    <!--<td>{{\App\NumberConverter::en2bn($total??'')}}</td>-->
                                    <td>{{$item->note}}</td>
                                    <td>{{$item->receiver->name??''}}</td>

                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center" >No Entry found!</td>
                                    </tr>
                                @endforelse

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

