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
            <h1 class="h3 mb-0 text-gray-800">ব্লগ এর তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">ব্লগ এর তালিকা</a></li>
            </ul>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>ব্লগ এর তালিকা</h2>
                            </div>
                            <div class="float-right">
                                <a href="/admin/blogs/create" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> ব্লগ যোগ করুন </a>
                            </div>
                        </div>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th> ছবি </th>
                                <th> শিরোনাম </th>
                                <th>বিস্তারিত </th>
                                <th>অবস্থা  </th>
                                <th>সময়</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th> ছবি </th>
                                <th> শিরোনাম </th>
                                <th>বিস্তারিত </th>
                                <th>অবস্থা  </th>
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

                                        <a  data-toggle="modal" data-target="#blogEditModal{{$item->id}}" class="dropdown-item"><i class="fa fa-eye"> </i> এডিট  </i></a>
                                        <a  data-toggle="modal" data-target="#blogShowModal{{$item->id}}" class="dropdown-item"><i class="fa fa-eye"> </i> বিস্তারিত </i></a>

                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/blogs', $item->id],
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
                                    <td>
                                        <img src="{{asset( $item->feature_image??'')}}" onerror="this.src='/front/images/no_img_avaliable.jpg';" alt="s2.jpg" width="60">
                                    </td>
                                    <td>{{$item->title}}</td>
                                    <td>{!! $item->description !!}</td>
                                    <td>{{$item->status}}</td>
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

    <!-- Edit Modal Start -->
    <div class="modal fade" id="blogEditModal{{$row->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                        <div class="modal-header">
                            <h2><strong> ব্লগ</strong> এডিট</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('admin/blogs/'.$row->id)}}" method="POST">
                                {{csrf_field()}}

                                {{method_field('PATCH')}}
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>শিরোনাম</small></label>
                                            <input type="text" placeholder="শিরোনাম" name="title" class="form-control" value="{{$row->title}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>ছবি</small></label>
                                            <input type="file" placeholder="ছবি" name="feature_image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><small>অবস্থা</small></label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="active" {{$row->status=='active' ? 'selected' : ''}}>Active</option>
                                                <option value="inctive" {{$row->status=='inactive' ? 'selected' : ''}}>Inctive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">

                                            <label for=""><small> নোট/বিস্তারিত </small></label>

                                            <textarea name="description" class="form-control" placeholder="নোট/বিস্তারিত">{!! $row->description !!}</textarea>

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


    <!-- Show Modal Start -->
    <div class="modal fade" id="blogShowModal{{$row->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">


                        <div class="modal-header">
                            <h2><strong> ব্লগ</strong> বিস্তারিত</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <table class="table">
                                <tbody>
                                <tr>
                                    <td> ছবি </td>
                                    <td>
                                        <img src="{{asset( $row->feature_image??'')}}" width="100" onerror="this.src='/front/images/no_img_avaliable.jpg';" alt="s2.jpg">
                                    </td>
                                </tr>
                                <tr>
                                    <td>শিরোনাম </td>
                                    <td>{{$row->title??""}}</td>
                                </tr>
                                <tr>
                                    <td>বিস্তারিত</td>
                                    <td>{!! $row->description !!}</td>
                                </tr>
                                <tr>
                                    <td>অবস্থা</td>
                                    <td>{{$row->status}}</td>
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

