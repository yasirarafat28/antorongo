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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">সঞ্চয়ের তালিকা</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
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
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-full-datatable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
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
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
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
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records ?? array() as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
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
                                    <td style="width: 12%">

                                        <a href="{{url('admin/saving/edit/'.$item->id)}}" class="btn  btn-primary"><i class="fa fa-pencil"> </i> এডিট করুন  </a>
                                        @if($item->status=='pending')
                                            <a href="{{url('admin/saving-approve/'.$item->id)}}" class="btn btn-primary"><i class="fa fa-check"> </i> অনুমোদন করুন</a>
                                            <a href="{{url('admin/saving-decline/'.$item->id)}}" class="btn btn-danger"><i class="fa fa-times"> প্রত্যাখ্যান করুন</i></a>
                                        @elseif($item->status=='approved')
                                            <a href="{{url('admin/saving/find?q='.$item->txn_id)}}" class="btn btn-success"><i class="fa fa-money-bill-alt"> </i> ডিপোজিট করুন</a>
                                            <a href="{{url('admin/saving/'.$type.'/withdraw?q='.$item->txn_id)}}" class="btn btn-secondary"><i class="fa fa-money-bill-alt"> </i> উত্তোলন করুন</a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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

