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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">ব্যয় এর   তালিকা</a></li>
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

                                <div class="col-lg-3 col-md-3 col-sm-12">
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
                                <div class="col-lg-3 col-md-3">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">

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
                        <h2><strong>ব্যয় এর  </strong> তালিকা </h2>
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
                                    <td>{{$item->date}}</td>
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
            <div class="modal-body">
                <div class="card shadow">
                    <div class="header">
                    </div>
                    <div class="body">

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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
<!--Edit Modal End-->
@endforeach


@endsection


@section('script')

@endsection

