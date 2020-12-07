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
            <h1 class="h3 mb-0 text-gray-800">লেনদেনের খাত</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">লেনদেনের খাত</a></li>
            </ul>
        </div>



        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    {{-- <div class="header">
                        <h2><strong>খাতের তালিকা </strong> </h2>

                    </div> --}}

                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>খাতের তালিকা </h2>
                            </div>
                            <div class="float-right">
                                <a data-toggle="modal" data-target="#largeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> খাত যোগ করুন </a>
                            </div>
                        </div>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th> নাম </th>
                                <th> মুল খাত </th>
                                <th>স্লাগ </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th> নাম </th>
                                <th> মুল খাত </th>
                                <th>স্লাগ </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>
                                        @if ($item->system_managable=='no')
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a  data-toggle="modal" data-target="#largeShowModal{{$item->id}}" class="dropdown-item"><i class="fa fa-eye"> </i> দেখুন</a>
                                                <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট</a>
                                                    {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/admin/transaction-head', $item->id],
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

                                    </td>                                    <td> {{$item->name}}</td>
                                    <td>{{App\TransactionHead::find($item->parent)->name??''}}</td>
                                    <td>{{strip_tags($item->slug)}}</td>

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
                        <h2><strong> খাত</strong> যোগ  করুন</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/transaction-head')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="{{$type}}">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> নাম</small></label>
                                        <input type="text" class="form-control" placeholder=" নাম" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> স্লাগ</small></label>
                                        <input type="text" class="form-control" placeholder="স্লাগ" name="slug">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> মুল খাত </small></label>
                                        <select name="parent" class="form-control ms">
                                            <option value="0">বাছাই করুন </option>
                                            @foreach($parents as $parent)
                                                <option value="{{$parent->id}}">{{$parent->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                </div>
                            </div>
                        </form>

            </div>

        </div>
    </div>
</div>
<!--Add Modal End-->


@foreach($records as $item)
<!-- Edit Modal Start -->
<div class="modal fade" id="largeEditModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                    <div class="modal-header">
                        <h2><strong> খাত</strong> এডিট করুন</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/transaction-head/'.$item->id)}}" method="POST">
                            {{csrf_field()}}

                            {{method_field('PATCH')}}
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> নাম</small></label>
                                        <input type="text" class="form-control" placeholder=" নাম" name="name" value="{{$item->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> স্লাগ</small></label>
                                        <input type="text" class="form-control" placeholder="স্লাগ" name="slug" value="{{$item->slug}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> মুল খাত </small></label>
                                        <select name="parent" class="form-control ms">
                                            <option value="0">বাছাই করুন </option>
                                            @foreach($parents as $parent)
                                                <option value="{{$parent->id}}" {{$parent->id==$item->parent?'selected':''}} >{{$parent->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                </div>
                            </div>
                        </form>

            </div>

        </div>
    </div>
</div>

<!--Edit Modal End-->

<!-- Show Modal Start -->
<div class="modal fade" id="largeShowModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                    <div class="modal-header">
                        <h2><strong> খাত</strong> বিস্তারিত</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>নাম</td>
                                    <td>{{$item->subject}}</td>
                                </tr>
                                <tr>
                                    <td>স্লাগ</td>
                                    <td>{{$item->guest}}</td>
                                </tr>
                                <tr>
                                    <td>মুল খাত</td>
                                    <td>{{$item->decision}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


        </div>
    </div>
</div>
<!--Edit Modal End-->
@endforeach

<script>
    $(document).ready(function(){
        $( 'textarea.ckeditor' ).ckeditor();
    });
</script>

@endsection


@section('script')

@endsection

