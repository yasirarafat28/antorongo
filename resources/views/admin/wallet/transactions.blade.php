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
            <h1 class="h3 mb-0 text-gray-800">লেনদেন রেকর্ড</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">লেনদেন রেকর্ড</a></li>
            </ul>
        </div>


        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>লেনদেন রেকর্ড</strong></h2>
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
                                <th> #</th>
                                <th>লেনদেন কোড </th>
                                <th> আদায়কারীর নাম  </th>
                                <th> লেনদেনের ধরন </th>
                                <th>পরিমান</th>
                                <th> অবস্থা</th>
                                <th> পরিশোধের সময়</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> #</th>

                                <th>লেনদেন কোড </th>
                                <th> লেনদেনের ধরন </th>
                                <th>পরিমান</th>
                                <th> অবস্থা</th>
                                <th> পরিশোধের সময়</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($records as $item)


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


                                <td>{{$item->txn_id??''}}</td>
                                <td>
                                    @if($item->flag=='give_away')
                                         ঋণ প্রদান
                                    @elseif($item->flag=='revenue_add')
                                        আসল যোগ
                                    @elseif($item->flag=='revenue_deduct')
                                         আসল প্রদান
                                    @elseif($item->flag=='interest')
                                        সুদ আদায়
                                    @elseif($item->flag=='add_interest')
                                        সুদ যোগ

                                    @endif
                                </td>

                                <td style="color: green;font-weight: 700;">

                                    @if($item->flag=='reveanue_add' || $item->flag=='add_interest' || $item->flag=='give_away')
                                        + {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                    @else
                                        - {{\App\NumberConverter::en2bn($item->amount)}} টাকা
                                    @endif

                                </td>
                                <td>{{$item->status}}</td>

                                <td>{{\App\NumberConverter::en2bn(date("d-m-Y",strtotime($item->date)))}}</td>

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

