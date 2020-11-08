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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">সদস্য তালিকা</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar">
                    <div class="body">

                        <form action="">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datetimepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small> পর্যন্ত</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datetimepicker" value="{{$_GET['to'] ?? ''}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
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
                <div class="card">
                    <div class="header">
                        <h2><strong>কালেকশন/আদায়ের  </strong> রিপোর্ট </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
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
                                            @else
                                                উত্তোলন
                                            @endif
                                        </td>

                                        <td style="color: green;font-weight: 700;">

                                            @if($item->type=='deposit')
                                                +
                                            @else
                                                -
                                            @endif

                                            {{\App\NumberConverter::en2bn($item->amount)}} টাকা

                                        </td>
                                        <td>নিশ্চিত </td>
                                        <td>{{\App\NumberConverter::en2bn($item->date)}}</td>
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

