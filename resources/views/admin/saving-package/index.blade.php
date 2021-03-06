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
            <h1 class="h3 mb-0 text-gray-800">সঞ্চয় পাকেজ সমূহ</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">সঞ্চয় পাকেজ সমূহ</a></li>
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

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                মোট প্যাকেজ</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">৮৭৬৭ টি</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>


        {{-- <div class="row clearfix">
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
        </div> --}}

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2><strong>সঞ্চয় পাকেজ সমূহ </strong></h2>
                            </div>
                            <div class="float-right">
                                <a data-toggle="modal" data-target="#largeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> পাকেজ যোগ করুন </a>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>নাম </th>
                                <th>জমার পরিমান </th>
                                <th>মোট জমা </th>
                                <th>লাভ</th>
                                <th>সর্বমোট </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>নাম </th>
                                <th>জমার পরিমান </th>
                                <th>মোট জমা </th>
                                <th>লাভ</th>
                                <th>সর্বমোট </th>
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

                                                <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট</a>

                                                    {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/admin/saving/'.$type.'/packages', $item->id],
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন ', array(
                                                        'type' => 'submit',
                                                        'class' => 'dropdown-item',
                                                        'title' => 'Delete user',
                                                        'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                        )) !!}
                                                    {!! Form::close() !!}

                                            </div>
                                    </td>                                    <td>{{$item->name}}</td>
                                    <td>{{$item->installment_amount}}</td>
                                    <td>{{$item->target_amount}}</td>
                                    <td>{{$item->return_amount - $item->target_amount}}</td>
                                    <td>{{$item->return_amount}}</td>

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

<!-- Add Modal Start -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><strong>পাকেজ</strong> যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

                    <div class="modal-body">
                        <form action="{{url('/admin/saving/'.$type.'/packages/')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="{{$type}}">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>নাম</small></label>
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
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round"> সেভ করুন</button>
                                </div>
                            </div>
                        </form>
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

                        <div class="modal-header">
                            <h5 class="modal-title"><strong>পাকেজ</strong> এডিট করুন</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>


                        <div class="modal-body">
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
                                    <div class="col md 12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                    </div>
                                </div>
                            </form>

                </div>

            </div>
        </div>
    </div>
    <!--Edit  Modal End-->
@endforeach


@endsection


@section('script')

@endsection

