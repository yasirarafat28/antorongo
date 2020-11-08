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
                        <h2><strong>ঋণের  </strong> তালিকা </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-full-datatable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>ঋণ আইডি </th>
                                <th>পুরাতন ঋণ আইডি </th>
                                <th> সদস্য আইডি  </th>
                                <th> সদস্য নাম  </th>
                                <th> ঋণের পরিমান  </th>
                                <th> মোট পরিশোধ</th>
                                <th> মোট বকেয়া</th>
                                <th> তারিখ </th>
                                <th>  অবস্থা</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>ঋণ আইডি </th>
                                <th>পুরাতন ঋণ আইডি </th>
                                <th> সদস্য আইডি  </th>
                                <th> সদস্য নাম  </th>
                                <th> ঋণের পরিমান  </th>
                                <th> মোট পরিশোধ</th>
                                <th> মোট বকেয়া</th>
                                <th> তারিখ </th>
                                <th>  অবস্থা</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records ?? array() as $item)
                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->old_txn}}</td>
                                    <td>{{$item->user->unique_id??''}}</td>
                                    <td>{{$item->user->name_bn??''}}</td>
                                    <td>
                                        @if($item->status=='active')
                                            {{\App\NumberConverter::en2bn($item->approved_amount)}}
                                        @else
                                            {{\App\NumberConverter::en2bn($item->request_amount)}}
                                        @endif
                                    </td>
                                    <td>{{\App\NumberConverter::en2bn($item->transactions->sum('incoming'))}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->request_amount + ($item->request_amount* $item->interest_rate/100) - $item->transactions->sum('incoming'))}}</td>
                                    <td>{{date('Y/m/d',strtotime($item->start_at))}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>

                                        <a href="{{url('admin/loan/find?q='.$item->unique_id)}}" class="btn  btn-primary"><i class="zmdi zmdi-eye"> </i> বিস্তারিত </a>
                                        <a href="{{url('admin/loan/edit/'.$item->id)}}" class="btn  btn-primary"><i class="fa fa-pencil"> </i> এডিট করুন  </a>
                                        @if($item->status=='active')
                                            <a href="{{url('admin/collection/collect?q='.$item->unique_id)}}" class="btn btn-success"><i class="fa fa-plus">কিস্তি </i></a>
                                        @else
                                            <a data-toggle="modal" data-target="#ActiveModal{{$item->id}}" class="btn btn-success"><i class="fa fa-check">অনুমোদন </i></a>
                                            <a href="{{url('admin/loan/Remove/'.$item->id)}}" class="btn btn-success"><i class="fa fa-check" onclick="return confirm('Are you Sure?? ');">মুছে ফেলুন </i></a>
                                            @if($item->status !='rejected')
                                                <a href="{{url('admin/loan/reject/'.$item->id)}}" class="btn btn-danger btn-icon-mini"><i class="fa fa-times">প্রত্যাখ্যান</i></a>
                                            @endif
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


@foreach($records as $item)
    <!-- Edit Large Modal -->
    <div class="modal fade" id="ActiveModal{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="header">
                            <h2><strong>ঋণ অনুমোদন করুন </strong></h2>
                        </div>
                        <div class="body">
                            <form action="{{url('admin/loan/active/'.$item->id)}}" method="POST">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ঋণের পরিমান </small></label>
                                            <input type="text" class="form-control" placeholder="ঋণের পরিমান" name="approved_amount" value="{{$item->request_amount}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>মেয়াদ </small></label>
                                            <input type="text" class="form-control" placeholder="মেয়াদ" name="duration" value="{{$item->name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>লাভের হার  </small></label>
                                            <input type="text" class="form-control" placeholder="লাভের হার" name="interest_rate" value="{{$item->interest_rate}}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-round">SAVE CHANGES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit  Modal End-->
@endforeach




@endsection


@section('script')

@endsection

