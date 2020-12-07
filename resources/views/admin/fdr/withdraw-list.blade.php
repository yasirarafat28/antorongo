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
                <h1 class="h3 mb-0 text-gray-800">এফ ডি আর উত্তলনের রিপোর্ট</h1>

                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">এফ ডি আর উত্তলনের রিপোর্ট</a></li>
                </ul>
            </div>

            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        মোট উত্তোলন</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total,2))}} টাকা </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                        <h2><strong>এফ ডি আর উত্তলনের রিপোর্ট </strong></h2>
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

                        <table class="table table-bordered table-striped table-hover dataTable  js-full-datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>সভ্য আইডি </th>
                                <th>এফ ডি আর আইডি </th>
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
                                <th>#</th>
                                <th>সভ্য আইডি </th>
                                <th>এফ ডি আর আইডি </th>
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
                                        </td>                                        <td>{{$item->user->unique_id??''}}</td>
                                        <td>{{$item->fdr->txn_id??''}}</td>
                                        <td>{{$item->txn_id??''}}</td>
                                        <td>{{$item->user->name??''}}</td>
                                        <td>{{$item->receiver->name??''}}</td>
                                        <td>
                                                উত্তোলন
                                        </td>

                                        <td style="color: green;font-weight: 700;">
                                            - {{\App\NumberConverter::en2bn($item->amount)}} টাকা

                                        </td>
                                        <td>নিশ্চিত </td>
                                        <td>{{\App\NumberConverter::en2bn($item->started_at)}}</td>

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

