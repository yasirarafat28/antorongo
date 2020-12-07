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
                <h1 class="h3 mb-0 text-gray-800">আয়ের রিপোর্ট</h1>

                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">আয়ের রিপোর্ট</a></li>
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
                                        মোট আয়</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn(number_format($total,2))}} টাকা</div>
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
                        <h2><strong>আয়ের </strong>রিপোর্ট </h2>
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

                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>কোড   </th>
                                <th>খাত  </th>
                                <th> টাকার পরিমান  </th>
                                <th>  তারিখ</th>
                                <th>  অবস্থা</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>কোড   </th>
                                <th>খাত  </th>
                                <th> টাকার পরিমান  </th>
                                <th>  তারিখ</th>
                                <th>  অবস্থা</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($transactions ?? array() as $item)
                                <tr>
                                    <td style="width: 12%">

                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                        <a data-toggle="modal" data-target="#largeShowModal{{$item->id}}"  class="dropdown-item"><i class="fa fa-eye"> </i> বিস্তারিত </a>
                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}"  class="dropdown-item"><i class="fa fa-edit"> </i> এডিট</a>
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/income', $item->id],
                                               'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন', array(
                                                 'type' => 'submit',
                                                 'class' => 'dropdown-item',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                 )) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                    <td>{{$item->txn_id}}</td>
                                    <td>{{$item->head->name??''}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->amount)}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{ucfirst($item->status)}}</td>

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

@foreach($transactions as $item)
<!-- Show Modal Start -->
<div class="modal fade" id="largeShowModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


                    <div class="modal-header">
                        <h2><strong> আয়ের</strong> বিস্তারিত</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <table class="table">
                            <tbody>
                            <tr>
                                <td>কোড </td>
                                <td>{{$item->txn_id}}</td>
                            </tr>
                            <tr>
                                <td>খাত </td>
                                <td>{{$item->head->name??""}}</td>
                            </tr>
                            <tr>
                                <td>টাকার পরিমান </td>
                                <td>{{\App\NumberConverter::en2bn($item->amount)}} টাকা </td>
                            </tr>
                            <tr>
                                <td>তারিখ </td>
                                <td>{{$item->date}}</td>
                            </tr>
                            <tr>
                                <td>বিস্তারিত</td>
                                <td>{!! $item->note !!}</td>
                            </tr>
                            </tbody>
                        </table>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="largeEditModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                    <div class="modal-header">
                        <h2><strong> আয়ের</strong> এডিট করুন</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="col-lg-10 col-md-10 col-sm-12 offset-1">


                            <form action="{{url('admin/income/'.$item->id)}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}

                        {{method_field('PATCH')}}

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> আয়ের খাত বাছাই করুন </small></label>
                                        <select name="head_id" class="form-control ms">
                                            <option value="0">বাছাই করুন </option>

                                            @foreach($parents??array() as $parent)
                                                @if(sizeof($parent->childs))
                                                    <optgroup label="{{$parent->name}}">
                                                        @foreach($parent->childs??array() as $Headitem)
                                                            <option value="{{$Headitem->id}}" {{$item->head_id==$Headitem->id?'selected':''}} >{{$Headitem->name}}</option>
                                                        @endforeach

                                                    </optgroup>
                                                @else
                                                    <option value="{{$parent->id}}" {{$item->head_id==$parent->id?'selected':''}} >{{$parent->name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> টাকার পরিমান </small></label>

                                        <input type="number" step="any" class="form-control" name="amount" placeholder="টাকার পরিমান" value="{{$item->amount}}">

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> তারিখ </small></label>

                                        <input type="date" class="form-control" name="date" placeholder="উত্তলনের তারিখ" value="{{date('Y-m-d',strtotime($item->date))}}">

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <label for=""><small> নোট/বিস্তারিত </small></label>

                                        <textarea name="note" class="form-control" placeholder="নোট/বিস্তারিত">{{$item->note}}</textarea>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <input id="remember_me_{{$item->id}}" name="invoice" type="checkbox">
                                            <label for="remember_me_{{$item->id}}">
                                                টাকা জমার রশিদ
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">

                                    <button class="btn btn-primary btn-round"> সেভ করুন</button>

                                </div>
                            </form>

                        </div>

            </div>

        </div>
    </div>
</div>
<!--Edit Modal End-->
@endforeach


@endsection


@section('script')

@endsection

