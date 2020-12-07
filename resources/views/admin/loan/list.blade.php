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
    <div class="container-fluid">


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ঋণ তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">ঋণ তালিকা</a></li>
            </ul>
        </div>



        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                 মোট ঋণ</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">$ ৪৩৫৬৪৫</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    মোট আদায়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">$ 215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
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

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>ঋণের  </strong> তালিকা </h2>
                    </div>
                    <div class="body">

                        <form action="">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small> পর্যন্ত</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['to'] ?? ''}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2">

                                    <br>

                                    <div class="input-group">
                                        <button class="btn btn-primary btn-round">খুঁজুন</button>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 text-right">
                                    <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-csv')[0].click();">
                                        <i class="zmdi zmdi-archive"></i>
                                    </button>
                                    <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-print')[0].click();">
                                        <i class="zmdi zmdi-print"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <br>
                        <br>
                        <table class="table table-bordered table-striped table-hover dataTable js-full-datatable table-responsive">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>ঋণ আইডি </th>
                                <th>পুরাতন ঋণ আইডি </th>
                                <th> সদস্য আইডি  </th>
                                <th> সদস্য নাম  </th>
                                <th> ঋণের পরিমান  </th>
                                <th> মোট পরিশোধ</th>
                                <th> মোট বকেয়া</th>
                                <th> তারিখ </th>
                                <th>  অবস্থা</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>ঋণ আইডি </th>
                                <th>পুরাতন ঋণ আইডি </th>
                                <th> সদস্য আইডি  </th>
                                <th> সদস্য নাম  </th>
                                <th> ঋণের পরিমান  </th>
                                <th> মোট পরিশোধ</th>
                                <th> মোট বকেয়া</th>
                                <th> তারিখ </th>
                                <th>  অবস্থা</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records ?? array() as $item)
                                <tr>
                                    <td>

                                        <a href="{{url('admin/loan/find?q='.$item->unique_id)}}" class="btn btn-primary"><i class="fa fa-eye"> </i> </a>

                                        <!--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                                <a href="{{url('admin/loan/find?q='.$item->unique_id)}}" class="dropdown-item"><i class="fa fa-eye"> </i> বিস্তারিত </a>
                                                <a href="{{url('admin/loan/edit/'.$item->id)}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট করুন  </a>
                                                @if($item->status=='active')
                                                    <a href="{{url('admin/collection/collect?q='.$item->unique_id)}}" class="dropdown-item"><i class="fa fa-plus">কিস্তি </i></a>
                                                @else
                                                    <a data-toggle="modal" data-target="#ActiveModal{{$item->id}}" class="dropdown-item"><i class="fa fa-check">অনুমোদন </i></a>
                                                    <a href="{{url('admin/loan/Remove/'.$item->id)}}" class="dropdown-item"><i class="fa fa-trash" onclick="return confirm('Are you Sure?? ');">মুছে ফেলুন </i></a>
                                                    @if($item->status !='rejected')
                                                        <a href="{{url('admin/loan/reject/'.$item->id)}}" class="dropdown-item text-danger"><i class="fa fa-times">প্রত্যাখ্যান</i></a>
                                                    @endif
                                                @endif

                                        </div>-->
                                    </td>                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->old_txn}}</td>
                                    <td>{{$item->user->unique_id??''}}</td>
                                    <td>{{$item->user->name_bn??''}}</td>
                                    <td>
                                        @if($item->status=='active')
                                            {{\App\NumberConverter::en2bn($item->approved_amount)}}
                                        @else
                                            {{\App\NumberConverter::en2bn($item->request_amount)}}
                                        @endif
                                    </td>
                                    <td>{{\App\NumberConverter::en2bn($item->interests->sum('amount')   +   $item->paid_reveanues->sum('amount'))}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->current_payable())}}</td>
                                    <td>{{date('Y/m/d',strtotime($item->start_at))}}</td>
                                    <td>{{$item->status}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {!! $records->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>


@endsection


@section('script')

@endsection

