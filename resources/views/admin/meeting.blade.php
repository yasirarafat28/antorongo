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
                    <li class="breadcrumb-item active">মিটিং এর তালিকা</li>
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
                <div class="card">
                    <div class="header">
                        <h2><strong>মিটিং এর তালিকা </strong> </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th> অতিথি </th>
                                <th> আলোচনার বিষয় </th>
                                <th>বিস্তারিত </th>
                                <th>সিদ্ধান্ত  </th>
                                <th>সময়</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th> অতিথি </th>
                                <th> আলোচনার বিষয় </th>
                                <th>বিস্তারিত </th>
                                <th>সিদ্ধান্ত  </th>
                                <th>সময়</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td> {{$item->guest}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>{{strip_tags($item->details)}}</td>
                                    <td>{{$item->decision}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->created_at)}}</td>
                                    <td>
                                        <a  data-toggle="modal" data-target="#largeShowModal{{$item->id}}" class="btn btn-icon btn-icon-mini"  title="দেখুন"><i class="zmdi zmdi-eye"> </i></a>
                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="btn btn-icon btn-icon-mini" title="সম্পাদনা করুন"><i class="zmdi zmdi-edit"> </i></a>
                                        <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/admin/meeting', $item->id],
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
                <div class="card">
                    <div class="header">
                        <h2><strong> মিটিং</strong> এডিট  করুন</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('admin/meeting')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> বিষয়</small></label>
                                        <input type="text" class="form-control" placeholder="বিষয়" name="subject">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> অতিথি</small></label>
                                        <input type="text" class="form-control" placeholder="অতিথি" name="guest">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> সিদ্ধান্ত </small></label>
                                        <input type="text" class="form-control" placeholder="সিদ্ধান্ত" name="decision">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>বিস্তারিত</small></label>
                                        <textarea name="details" id="ckeditor" placeholder="বিস্তারিত" class="form-control"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">বন্ধ করুন</button>
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
            <div class="modal-body">
                <div class="card">
                    <div class="header">
                        <h2><strong> মিটিং</strong> বিস্তারিত</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('admin/meeting/'.$item->id)}}" method="POST">
                            {{csrf_field()}}

                            {{method_field('PATCH')}}
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> বিষয়</small></label>
                                        <input type="text" class="form-control" placeholder="বিষয়" name="subject" value="{{$item->subject}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> অতিথি</small></label>
                                        <input type="text" class="form-control" placeholder="অতিথি" name="guest" value="{{$item->guest}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> সিদ্ধান্ত </small></label>
                                        <input type="text" class="form-control" placeholder="সিদ্ধান্ত" name="decision" value="{{$item->decision}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>বিস্তারিত</small></label>
                                        <textarea name="details" id="" placeholder="বিস্তারিত" class="form-control ckeditor">{{$item->details}}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                            </div>
                        </form>
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

<!-- Show Modal Start -->
<div class="modal fade" id="largeShowModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="header">
                        <h2><strong> মিটিং</strong> যোগ করুন</h2>
                    </div>
                    <div class="body">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>বিষয়</td>
                                    <td>{{$item->subject}}</td>
                                </tr>
                                <tr>
                                    <td>অতিথি</td>
                                    <td>{{$item->guest}}</td>
                                </tr>
                                <tr>
                                    <td>সিদ্ধান্ত</td>
                                    <td>{{$item->decision}}</td>
                                </tr>
                                <tr>
                                    <td>বিস্তারিত</td>
                                    <td>{!! $item->details !!}</td>
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

<script>
    $(document).ready(function(){
        $( 'textarea.ckeditor' ).ckeditor();
    });
</script>

@endsection


@section('script')

@endsection

