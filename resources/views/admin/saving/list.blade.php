@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

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

        <div class="row mb-3">

            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    বর্তমান  সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($active_count)}}</div>


                                <a href="/admin/saving/{{$type}}/list?filterBy=approved" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($pending_count)}}</div>
                                <a href="/admin/saving/{{$type}}/list?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                     সঞ্চয় প্রত্যাহার</div>

                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($closed_count)}}</div>

                                @if($type =='short' || $type == 'long')

                                <span style="font-size: 15px;">পলিসির পরিমান </span>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">  ৳ {{App\NumberConverter::en2bn($closed_target_amount)}} টাকা</div>
                                {{-- <span style="font-size: 15px;">মোট লাভ</span>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($closed_total_profit_paid + $closed_total_revenue_paid)}} টাকা</div>
                                <span style="font-size: 15px;">মোট ফেরত </span>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($closed_target_amount + $closed_total_profit_paid + $closed_target_amounta)}} টাকা</div> --}}
                            @endif
                                <a href="/admin/saving/{{$type}}/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
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
                                <div class="col-lg-2 col-md-2">
                                    <br>
                                    @if (count($_GET))

                                        <a href="?{{$_SERVER['QUERY_STRING']}}&limit=-1" class="btn btn-success">সবগুলো দেখুন </a>
                                    @else

                                        <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন </a>

                                    @endif
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
                                @if($type=='daily')
                                    <th> দৈনিক সঞ্চয়ের পরিমান  </th>
                                    <th> সময়কাল (মাস)  </th>
                                @elseif($type !='current')
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
                                @if($type =='daily')
                                    <th> দৈনিক সঞ্চয়ের পরিমান  </th>
                                    <th> সময়কাল (মাস)  </th>
                                @elseif($type !='current')
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
                                    @if($type =='daily')
                                        <td>{{\App\NumberConverter::en2bn($item->installment_amount)}} টাকা </td>
                                        <td>{{\App\NumberConverter::en2bn($item->duration)}} মাস </td>
                                    @elseif($type !='current')
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

