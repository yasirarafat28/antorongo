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

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">কালেকশন/আদায়ের তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">কালেকশন/আদায়ের তালিকা</a></li>
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
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
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
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>কালেকশন/আদায়ের  </strong> রিপোর্ট </h2>
                    </div>
                    <div class="body table-responsive">

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
                        <table class="table table-bordered table-striped table-hover dataTable js-full-datatable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>সভ্য আইডি </th>
                                <th>সঞ্চয় আইডি </th>
                                <th>লেনদেন কোড </th>
                                <th> সদস্য নাম  </th>
                                <th> আদায়কারীর নাম  </th>
                                <th> লেনদেনের ধরন </th>
                                <th>পরিমান</th>
                                <th> অবস্থা</th>
                                <th> পরিশোধের সময়</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>সভ্য আইডি </th>
                                <th>সঞ্চয় আইডি </th>
                                <th>লেনদেন কোড </th>
                                <th> সদস্য নাম  </th>
                                <th> আদায়কারীর নাম  </th>
                                <th> লেনদেনের ধরন </th>
                                <th>পরিমান</th>
                                <th> অবস্থা</th>
                                <th> পরিশোধের সময়</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>

                                @foreach($transactions as $item)


                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->user->unique_id??''}}</td>
                                        <td>{{$item->savings->txn_id??''}}</td>
                                        <td>{{$item->txn_id??''}}</td>
                                        <td>{{$item->user->name??''}}</td>
                                        <td>{{$item->receiver->name??''}}</td>
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

                                            @if($item->type=='deposit'||$item->type=='profit')
                                                +
                                            @else
                                                -
                                            @endif

                                            {{\App\NumberConverter::en2bn($item->amount)}} টাকা

                                        </td>
                                        <td>নিশ্চিত </td>
                                        <td>{{\App\NumberConverter::en2bn($item->date)}}</td>
                                        <td>
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a href="{{url('admin/saving-transaction/'.$item->id.'/edit')}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট </a>
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/admin/saving-transaction', $item->id],
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন ', array(
                                                        'type' => 'submit',
                                                        'class' => 'dropdown-item',
                                                        'title' => 'Delete user',
                                                        'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                        )) !!}
                                                    {!! Form::close() !!}

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <div class="pull-right">
                            {!! $transactions->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
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

