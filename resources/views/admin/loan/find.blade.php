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
                    <h3><strong>ঋণ খুঁজুন</strong><small></small> </h3>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">ঋণ খুঁজুন</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">
                        <h2><strong>ঋণ খুঁজুন</strong><small></small> </h2>
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
                                        <input type="text" class="form-control" placeholder="ঋণ নাম্বার" name="q" value="{{$query}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>

                            </div>
                        </form>
                    </div>


                    <hr>
                    @if($loan)

                    @php

                        $total_give_away = $loan->loan_give_away->sum('amount');
                        $total_interest = $loan->interests->sum('amount');
                        $total_reveanue_paid = $loan->paid_reveanues->sum('amount');
                        $total_reveanue_added = $loan->added_reveanues->sum('amount');


                        $total_interest_added = $loan->added_interests->sum('amount');
                        $all_paid = $total_interest+ $total_reveanue_paid;
                    @endphp

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
                                            <td class="text-left">{{$loan->user->name_bn??''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">সভ্য আইডি : </td>
                                            <td class="text-left">{{$loan->user->unique_id??''}}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">ঋণ আইডি :</td>
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
                                                মোট ঋণ প্রদান :
                                            </td>
                                            <td class="text-left">
                                                {{\App\NumberConverter::en2bn($total_give_away)}} টাকা
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">
                                                মোট পরিশোধ :
                                            </td>
                                            <td class="text-left">
                                                {{\App\NumberConverter::en2bn($all_paid)}} টাকা
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                মোট বকেয়া :
                                            </td>
                                            <td class="text-left">
                                                {{\App\NumberConverter::en2bn($loan->current_payable())}} টাকা
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

                            </div>
                            <hr>
                        <br>
                    </div>

                    <div class="col-md-8">

                        <div class="row">



                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    মোট আসল আদায়
                                                </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_reveanue_paid,2))}} টাকা </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    মোট লাভ আদায়
                                                </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_interest,2))}} টাকা </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">

                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    মোট আদায়
                                                </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_reveanue_paid + $total_interest ,2))}} টাকা </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    আসল বকেয়া
                                                </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_give_away + $total_reveanue_added-$total_reveanue_paid,2))}} টাকা </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    লাভ বকেয়া
                                                </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total_interest_added - $total_interest,2))}} টাকা </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    মোট বকেয়া
                                                </div>
                                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($loan->current_payable(),2))}} টাকা </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{url('admin/loan/edit/'.$loan->id)}}" class="btn btn-primary"><i class="fa fa-edit"> </i> এডিট করুন  </a>
                        @if($loan->status=='active')
                            <a data-toggle="modal" data-target="#loanGiveAwawModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> ঋণ প্রদান করুন
                             </a>
                            <a data-toggle="modal" data-target="#LoanInterestCollectModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> লাভ আদায় করুন </a>
                            <a data-toggle="modal" data-target="#LoanDeductRevenueModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> আসল আদায় করুন </a>
                            <a data-toggle="modal" data-target="#LoanAddRevenueModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> আসল বকেয়া </a>
                            <a data-toggle="modal" data-target="#LoanInterestAddModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> লাভ  বকেয়া </a>
                            <a data-toggle="modal" data-target="#LoanFineIncomeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> জরিমানা করুন</a>
                            <a data-toggle="modal" data-target="#LoanWaiverModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> ঋণ মওকুফ করুন</a>

                            {!! Form::open([
                                'method'=>'POST',
                                'url' => ['/admin/loan/close', $loan->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>  সদস্য পদ প্রত্যাহার', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger',
                                'title' => 'সদস্য পদ প্রত্যাহার',
                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                )) !!}
                            {!! Form::close() !!}
                        @elseif($loan->status=='pending')
                            <a data-toggle="modal" data-target="#ActiveModal{{$loan->id}}" class="btn btn-primary"><i class="fa fa-check"> অনুমোদন </i></a>
                             @if($loan->status !='rejected')
                                <a href="{{url('admin/loan/reject/'.$loan->id)}}" class="btn btn-danger"><i class="fa fa-times"> প্রত্যাখ্যান</i></a>
                            @endif
                        @endif

                        <a href="{{url('admin/print/loan/'.$loan->unique_id)}}" class="btn btn-primary"><i class="fa fa-print"> </i> প্রিন্ট </a>
                        <a href="{{url('admin/loan/depository/'.$loan->id)}}" class="btn btn-primary"><i class="fa fa-list"> </i> জামানত </a>
                        <a href="{{url('admin/loan/Remove/'.$loan->id)}}" class="btn btn-primary"><i class="fa fa-trash" onclick="return confirm('Are you Sure?? ');"> মুছে ফেলুন </i></a>


                        @if ($loan->status=='closed')

                        <br>
                        <br>

                        <div class="col-md-12">

                            <div class="alert alert-danger">
                                সদস্য পদ প্রত্যাহার করা হয়েছে ।

                            </div>
                        </div>

                    @endif
                    </div>

                    @include('admin.loan.modals')

                </div>
                @endif
            </div>
        </div>
    </div>


        @if( isset($loan->histories) && $loan->histories)
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
                                    <th> তারিখ</th>
                                    <th> মাস </th>
                                    <th> লেনদেন কোড </th>
                                    <th> লেনদেনের ধরন </th>
                                    <th>পরিমান</th>
                                    <th> নোট</th>
                                    <th>আদায়কারীর নাম</th>

                                </tr>

                            </thead>

                            <tbody>
                            @forelse($loan->histories as $item)


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
                                    <td>{{\App\NumberConverter::en2bn(date("d-m-Y",strtotime($item->date)))}}</td>
                                    <td>{{ \App\BanglaMonth::MonthName(date('m',strtotime($item->date)))}}</td>

                                    <td>{{$item->txn_id??''}}</td>
                                    <td>
                                        @if($item->flag=='give_away')
                                             ঋণ প্রদান
                                        @elseif($item->flag=='revenue_add')
                                            আসল বকেয়া যোগ
                                        @elseif($item->flag=='revenue_deduct')
                                             আসল প্রদান
                                        @elseif($item->flag=='interest')
                                            লাভ আদায়
                                        @elseif($item->flag=='fine')
                                            জরিমানা
                                        @elseif($item->flag=='add_interest')
                                            লাভ বকেয়া যোগ

                                        @endif
                                    </td>

                                    <td style="color: green;font-weight: 700;">

                                        @if($item->flag=='reveanue_add' || $item->flag=='add_interest' || $item->flag=='give_away')
                                            + {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                        @else
                                            - {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                        @endif

                                    </td>
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

@endsection


@section('script')

@endsection

