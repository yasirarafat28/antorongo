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
            <h1 class="h3 mb-0 text-gray-800">সঞ্চয়ের তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">সঞ্চয়ের তালিকা</a></li>
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
                                    মোট সঞ্চয়</div>
                                <div class="h৬ mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                        <h2><strong> সঞ্চয়ের </strong> তালিকা </h2>
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
                                <th>ক্রিয়াকলাপ</th>
                                <th>সভ্য আইডি </th>
                                <th>সঞ্চয় আইডি </th>
                                <th> সদস্য নাম  </th>
                                @if($type='daily')
                                    <th> দৈনিক সঞ্চয়ের পরিমান  </th>
                                    <th> সময়কাল (মাস)  </th>
                                @else
                                    <th> পলিসির পরিমান  </th>
                                    <th> মোট লাভ</th>
                                    <th> মোট ফেরত</th>
                                @endif
                                <th>  অবস্থা</th>
                                <th>  তারিখ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>সভ্য আইডি </th>
                                <th>সঞ্চয় আইডি </th>
                                <th> সদস্য নাম  </th>
                                @if($type='daily')
                                    <th> দৈনিক সঞ্চয়ের পরিমান  </th>
                                    <th> সময়কাল (মাস)  </th>
                                @else
                                    <th> পলিসির পরিমান  </th>
                                    <th> মোট লাভ</th>
                                    <th> মোট ফেরত</th>
                                @endif
                                <th>  অবস্থা</th>
                                <th>  তারিখ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records ?? array() as $item)
                                <tr>
                                    <td style="width: 12%">
                                        <!--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <a href="{{url('admin/saving/edit/'.$item->id)}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট </a>
                                        @if($item->status=='pending')
                                            <a href="{{url('admin/saving-approve/'.$item->id)}}" class="dropdown-item"><i class="fa fa-check"> </i> অনুমোদন করুন</a>
                                            <a href="{{url('admin/saving-decline/'.$item->id)}}" class="dropdown-item"><i class="fa fa-times"> প্রত্যাখ্যান করুন</i></a>
                                        @elseif($item->status=='approved')
                                            <a href="{{url('admin/saving/find?q='.$item->txn_id)}}" class="dropdown-item"><i class="fa fa-money-bill-alt"> </i> ডিপোজিট করুন</a>
                                            <a href="{{url('admin/saving/'.$type.'/withdraw?q='.$item->txn_id)}}" class="dropdown-item"><i class="fa fa-money-bill-alt"> </i> উত্তোলন করুন</a>

                                        @endif
                                        </div>-->

                                    <a href="/admin/saving/find?q={{$item->txn_id}}"> <i class="fa fa-eye"></i> </a>
                                    </td>
                                    <td>{{$item->user->unique_id??''}}</td>
                                    <td>{{$item->txn_id}}</td>
                                    <td>{{$item->user->name_bn??''}}</td>
                                    @if($type='daily')
                                        <td>{{\App\NumberConverter::en2bn($item->installment_amount)}} টাকা </td>
                                        <td>{{\App\NumberConverter::en2bn($item->duration)}} মাস </td>
                                    @else
                                        <td>{{\App\NumberConverter::en2bn($item->target_amount)}}</td>
                                        <td>{{\App\NumberConverter::en2bn($item->return_amount-$item->target_amount)}}</td>
                                        <td>{{\App\NumberConverter::en2bn($item->return_amount)}}</td>
                                    @endif
                                    <td>{{ucfirst($item->status)}}</td>
                                    <td>{{$item->started_at}}</td>

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

