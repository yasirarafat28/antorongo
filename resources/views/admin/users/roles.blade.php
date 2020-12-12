@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

</style>

<!-- Main Content -->
<section class="content">

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
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">পদবী তালিকা</h1>

                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">পদবী তালিকা</a></li>
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
                                        মোট পদবী</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">১৩ টি</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
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
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>পদবী  তালিকা</h2>
                            </div>
                            <div class="float-right">
                                <a data-toggle="modal" data-target="#largeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> পদবী  তৈরি করুন </a>
                            </div>
                        </div>

                    </div>
                    <div class="body">

                        {{-- <div class="col-lg-5 col-md-12 col-12">
                            <div class="input-group search">
                                <input type="text" class="form-control" placeholder="ইমেইল, ফোন ,আইডি">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-search"></i>
                                </span>
                                <div class="col-lg-6 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>
                            </div>

                        </div> --}}
                        <div class="body members_profiles">
                            <form method="GET">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="ইমেইল, ফোন ,আইডি" name="q" >
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <button class="btn btn-primary btn-round">খুজুন</button>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <br>
                        <br>
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>নাম </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>নাম </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>
                                        @if ($item->name!='super_admin')
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="dropdown-item" title="সম্পাদনা করুন"><i class="fa fa-edit"> </i> এডিট</a>
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/roles', $item->id],
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
                                        @endif
                                    </td>
                                    <td>{{$item->name}}</td>
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
                        <h2><strong>পদবী</strong> তৈরি করুন</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/roles')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>পদবী</small></label>
                                        <input type="text" class="form-control" placeholder="পদবী" name="name">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">সংরক্ষণ করুন</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

    </div>
</div>
<!--Add Modal End-->

@foreach($records as $role)
    <!-- Edit Large Modal -->
    <div class="modal fade" id="largeEditModal{{$role->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                        {{-- <div class="header">
                            <h2><strong>পদবী আধুনিক করুন</strong></h2>
                        </div> --}}
                        <div class="modal-header">
                            <h2><strong>পদবী</strong> আধুনিক করুন</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('admin/roles/'.$role->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}

                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>পদবী</small></label>
                                            <input type="text" class="form-control" placeholder="পদবী" name="name" value="{{$role->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">সংরক্ষণ করুন</button>
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

