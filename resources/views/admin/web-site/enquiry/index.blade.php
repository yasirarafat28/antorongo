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
            <h1 class="h3 mb-0 text-gray-800">কাস্টমার মেসেজ তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">কাস্টমার মেসেজ তালিকা</a></li>
            </ul>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>কাস্টমার মেসেজ তালিকা</h2>
                            </div>

                        </div>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th> নাম </th>
                                <th>ইমেল </th>
                                <th>বিষয়</th>
                                <th>ফোন</th>
                                <th>সময়</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th> নাম </th>
                                <th>ইমেল </th>
                                <th>বিষয়</th>
                                <th>ফোন</th>
                                <th>সময়</th>
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

                                        <a  data-toggle="modal" data-target="#enquiryShowModal{{$item->id}}" class="dropdown-item"><i class="fa fa-eye"> </i> বিস্তারিত </i></a>

                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/enquiries', $item->id],
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

                                    <td>{{$item->first_name??''}} {{$item->last_name??''}}</td>
                                    <td>{{$item->email??''}}</td>
                                    <td>{{$item->subject??''}}</td>
                                    <td>{{$item->phone??''}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->created_at)}}</td>
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

    @foreach($records as $row)
    <!-- Show Modal Start -->
    <div class="modal fade" id="enquiryShowModal{{$row->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">


                        <div class="modal-header">
                            <h2><strong> কাস্টমার মেসেজ</strong> বিস্তারিত</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>নাম </td>
                                    <td>{{$row->first_name??""}} {{$row->last_name??""}}</td>
                                </tr>
                                <tr>
                                    <td>ইমেল </td>
                                    <td>{{$row->email??""}}</td>
                                </tr>
                                <tr>
                                    <td>বিষয় </td>
                                    <td>{{$row->subject??""}}</td>
                                </tr>
                                <tr>
                                    <td>ফোন </td>
                                    <td>{{$row->phone??""}}</td>
                                </tr>
                                <tr>
                                    <td>বিস্তারিত</td>
                                    <td>{!! $row->description !!}</td>
                                </tr>

                                <tr>
                                    <td>তারিখ </td>
                                    <td>{{\App\NumberConverter::en2bn($row->created_at)}}</td>
                                </tr>

                                </tbody>
                            </table>

                </div>

            </div>
        </div>
    </div>
    @endforeach



@endsection


@section('script')
<script>
    $(document).ready(function(){
        $( 'textarea.ckeditor' ).ckeditor();
    });
</script>
@endsection

