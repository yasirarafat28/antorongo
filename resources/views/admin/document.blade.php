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
            <h1 class="h3 mb-0 text-gray-800">ডকুমেন্ট এর তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">ডকুমেন্ট এর তালিকা</a></li>
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
                                 মোট ডকুমেন্ট</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">4343 টি</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                    <h2>ডকুমেন্ট এর তালিকা  </h2>
                                </div>
                                <div class="float-right">
                                    <a data-toggle="modal" data-target="#largeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> ডকুমেন্ট যোগ করুন </a>
                                </div>
                            </div>

                        </div>
                    <div class="body">
                        @forelse ($records??array() as $document)
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="">
                                    <div class="card-body file_manager">
                                        <div class="file">
                                            <a target="_blank" href="{{
                                                // storage_file_path(
                                                    $document->file??''}}">
                                                <div class="hover">
                                                    <!--<button type="button" class="bg-transparent remove text-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>-->
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-file"></i>
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">{{$document->title}}</p>
                                                    <small>
                                                        {{-- Size: {{number_format($document->size/1000000,2)}} MB  --}}
                                                        <span class="date text-muted">{{date('F d, Y',strtotime($document->created_at))}}</span></small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty

                            <div class="col-md-12 text-center">
                                <h5><strong>Sorry!</strong> No record found!</h5>
                            </div>

                        @endforelse

                        {{-- <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th> নাম </th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th> নাম </th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td> {{$item->title}}</td>
                                        <td>
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                 <a class="dropdown-item"  title="বিস্তারিত" href="{{url($item->file??'')}}"><i class="fa fa-eye"> </i> বিস্তারিত </i></a>
                                                <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="dropdown-item" title="সম্পাদনা করুন"><i class="fa fa-edit"> </i> এডিট</a>
                                                {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/documents', $item->id],
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
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="pull-right">
                            {!! $records->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- #END# Exportable Table -->
</section>

<!-- Add Modal Start -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                    <div class="modal-header">
                        <h2><strong> ডকুমেন্ট</strong> যোগ করুন</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/documents')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> নাম</small></label>
                                        <input type="text" class="form-control" placeholder="নাম" name="title">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>ডকুমেন্ট</small></label>
                                        <input type="file" class="form-control" placeholder="ডকুমেন্ট" name="file">
                                    </div>
                                </div>

                                {{-- <div class='col-md-12 mb-4 mt-2'>
                                    <!-- Dropzone -->
                                    <div action="{{route('upload')}}" class='dropzone' >
                                    </div>
                                </div> --}}

                                <div class="col-md-12 text-center">
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
                                <h2><strong> ডকুমেন্ট</strong> এডিট</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{url('admin/documents/'.$item->id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    {{method_field('PATCH')}}
                                    <div class="row clearfix">

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for=""><small> নাম</small></label>
                                                <input type="text" class="form-control" placeholder="নাম" name="title">
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for=""><small>ডকুমেন্ট</small></label>
                                                <input type="file" class="form-control" placeholder="ডকুমেন্ট" name="file">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                        </div>
                                    </div>
                                </form>
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

{{-- <script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    //Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{

        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        uploadMultiple:false,
        success: function (file, response) {
            let url = '';
            if(typeof file.xhr.response !== 'undefined'){
                url = file.xhr.response;
            }else{
                url = response;

            }
            $('form').append('<input type="hidden" name="documents[]" value="' + url + '">')
        },
        success: function (file, response) {
            console.log(response);
            let url = '';
            if(typeof file.xhr.response !== 'undefined'){
                url = file.xhr.response;
            }else{
                url = response;

            }
            $('form').append('<input type="hidden" name="documents[]" value="' + url + '">')
        },
        addedFile: function (file) {
            console.log(file);
        },
        removedfile: function (file) {
            var url = ''
            if (typeof file.xhr.response !== 'undefined') {
                name = file.xhr.response
            } else {
                name = uploadedDocumentMap[file.name]
            }

            $.ajax({
              type:"GET",
              url:"{{url('documents-remove')}}/",
              data:{
                  "url":name
              },
              success:function(data){
                  console.log(data);

                    file.previewElement.remove();
                    $('form').find('input[name="documents[]"][value="' + name +  '"]').remove();
              },
              error:function(xhr){
                  console.log(xhr);
              }
            });

        },
    });
    myDropzone.on("sending", function(file, xhr, formData) {
       formData.append("_token", CSRF_TOKEN);
    });
</script> --}}
@endsection

