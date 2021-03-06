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
            <h1 class="h3 mb-0 text-gray-800">লেনদেন এর তালিকা </h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">লেনদেন এর তালিকা </a></li>
            </ul>
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
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
                    <div class="body">

                        <form action="">

                            <div class="row clearfix">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=""><small> ব্যালেন্স </small></label>
                                        <select name="wallet" class="form-control ms">
                                            <option value="">বাছাই করুন </option>

                                            <option {{isset($_GET['wallet']) && $_GET['wallet']=='office'?'selected':''}} value="office">Office</option>
                                            <option {{isset($_GET['wallet']) && $_GET['wallet']=='cashier'?'selected':''}} value="cashier">Cashier</option>
                                            <option {{isset($_GET['wallet']) && $_GET['wallet']=='bank'?'selected':''}} value="bank">Bank</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=""><small> আয়ের খাত বাছাই করুন </small></label>
                                        <select name="head_id" class="form-control ms">
                                            <option value="0">বাছাই করুন </option>

                                            @foreach($parents??array() as $parent)
                                                @if(sizeof($parent->childs))
                                                    <optgroup label="{{$parent->name}}">
                                                        @foreach($parent->childs??array() as $item)
                                                            <option value="{{$item->id}}" {{isset($_GET['head_id']) && $_GET['head_id']==$item->id ? 'selected':''}} >{{$item->name}}</option>
                                                        @endforeach

                                                    </optgroup>
                                                @else
                                                    <option value="{{$parent->id}}" {{isset($_GET['head_id']) && $_GET['head_id']==$parent->id ? 'selected':''}} >{{$parent->name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-md-2">

                                    <label for=""><small> পর্যন্ত</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['to'] ?? ''}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-1 col-md-1">

                                    <br>

                                    <div class="input-group">
                                        <button class="btn btn-primary btn-round"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-1">
                                    <br>
                                    @if (count($_GET))

                                        <a href="?{{$_SERVER['QUERY_STRING']}}&limit=-1" class="btn btn-success">সবগুলো দেখুন </a>
                                    @else

                                        <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন </a>

                                    @endif
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
                        <h2><strong>লেনদেন </strong>এর তালিকা </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>কোড   </th>
                                <th>খাত  </th>
                                <th> টাকার পরিমান  </th>
                                <th>  তারিখ</th>
                                <th>  অবস্থা</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>কোড   </th>
                                <th>খাত  </th>
                                <th> টাকার পরিমান  </th>
                                <th>  তারিখ</th>
                                <th>  অবস্থা</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($transactions ?? array() as $item)
                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>

                                    <td>{{$item->txn_id}}</td>
                                    <td>{{$item->head->name??''}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->amount)}}</td>
                                    <td>{{date("d-m-Y",strtotime($item->date))}}</td>
                                    <td>{{ucfirst($item->status)}}</td>
                                    <td style="width: 12%">

                                        <a data-toggle="modal" data-target="#largeShowModal{{$item->id}}"  class="btn btn-primary"><i class="fa fa-eye"> </i> বিস্তারিত </a>
                                        <!--<a class="btn btn-danger" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/expense', $item->id],
                                               'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i> ', array(
                                                 'type' => 'submit',
                                                 'class' => 'btn btn-danger btn-xs btnper',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                 )) !!}
                                            {!! Form::close() !!}
                                        </a>-->
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

@foreach($transactions as $item)
<!-- Show Modal Start -->
<div class="modal fade" id="largeShowModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>লেনদেন </strong>এর বিস্তারিত</h5>
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
                                <td>{{$item->head->name??''}}</td>
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
<!--Edit Modal End-->
@endforeach


@endsection


@section('script')

@endsection

