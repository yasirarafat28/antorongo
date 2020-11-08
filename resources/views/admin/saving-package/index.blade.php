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
                    <li class="breadcrumb-item"><a href="{{url('')}}"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">সঞ্চয় পাকেজ সমূহ</li>
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
                <div class="card action_bar shadow">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-6">

                            </div>
                            <div class="col-lg-7 col-md-7 col-3 text-right">
                                <a  data-toggle="modal" data-target="#largeModal" class="btn btn-neutral hidden-sm-down">
                                    <i class="zmdi zmdi-plus-circle"></i>
                                </a>


                                <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-csv')[0].click();">
                                    <i class="zmdi zmdi-archive"></i>
                                </button>
                                <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-print')[0].click();">
                                    <i class="zmdi zmdi-print"></i>
                                </button>
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
                        <h2><strong>Users </strong> </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>নাম </th>
                                <th>জমার পরিমান </th>
                                <th>মোট জমা </th>
                                <th>লাভ</th>
                                <th>সর্বমোট </th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>নাম </th>
                                <th>জমার পরিমান </th>
                                <th>মোট জমা </th>
                                <th>লাভ</th>
                                <th>সর্বমোট </th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->installment_amount}}</td>
                                    <td>{{$item->target_amount}}</td>
                                    <td>{{$item->return_amount - $item->target_amount}}</td>
                                    <td>{{$item->return_amount}}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="btn btn-icon btn-icon-mini" title="সম্পাদনা করুন"><i class="zmdi zmdi-edit"> </i></a>
                                        <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/saving/'.$type.'/packages', $item->id],
                                               'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i> ', array(
                                                 'type' => 'submit',
                                                 'class' => 'btn btn-danger btn-xs btnper',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                 )) !!}
                                            {!! Form::close() !!}
                                        </a>
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

<!-- Add Modal Start -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>পাকেজ</strong> যোগ করুন</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('/admin/saving/'.$type.'/packages/')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="{{$type}}">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>Name</small></label>
                                        <input type="text" class="form-control" placeholder="নাম" name="name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>জমার পরিমান</small></label>
                                        <input type="number" step="any" class="form-control" placeholder="জমার পরিমান" name="installment_amount">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> মোট জমা</small></label>
                                        <input type="number" step="any" class="form-control" placeholder="মোট জমা" name="target_amount">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>সর্বমোট</small></label>
                                        <input type="number" step="any" class="form-control" placeholder="সর্বমোট" name="return_amount">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>মুনাফা হার</small></label>
                                        <input type="number" step="any" class="form-control" placeholder="মুনাফা হার" name="interest_rate">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>মোট কিস্তি</small></label>
                                        <input type="number" class="form-control" placeholder="মোট কিস্তি" name="installment_qty">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-round"> সেভ করুন</button>
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
<!--Add Modal End-->

@foreach($records as $item)
    <!-- Edit Large Modal -->
    <div class="modal fade" id="largeEditModal{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="header">
                            <h2><strong> পাকেজ</strong> এডিট করুন </h2>
                        </div>
                        <div class="body">
                            <form action="{{url('/admin/saving/'.$type.'/packages/'.$item->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <div class="row clearfix">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>Name</small></label>
                                            <input type="text" class="form-control" placeholder="নাম" name="name" value="{{$item->name}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>জমার পরিমান</small></label>
                                            <input type="number" step="any" class="form-control" placeholder="জমার পরিমান" name="installment_amount" value="{{$item->installment_amount}}">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small> মোট জমা</small></label>
                                            <input type="number" step="any" class="form-control" placeholder="মোট জমা" name="target_amount" value="{{$item->target_amount}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>সর্বমোট</small></label>
                                            <input type="number" step="any" class="form-control" placeholder="সর্বমোট" name="return_amount" value="{{$item->return_amount}}">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>মুনাফা হার</small></label>
                                            <input type="number" step="any" class="form-control" placeholder="মুনাফা হার" name="interest_rate" value="{{$item->interest_rate}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>মোট কিস্তি</small></label>
                                            <input type="number" class="form-control" placeholder="মোট কিস্তি" name="installment_qty" value="{{$item->installment_qty}}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
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

