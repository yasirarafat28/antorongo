@extends('layouts.admin')
@section('style')

@endsection
@section('content')

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">সদস্য তালিকা</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">সদস্য তালিকা</a></li>
            </ul>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
                    <div class="body table-responsive">

                        <form action="">

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6">

                                    <label for=""><small>সার্চ করুন</small></label>

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="সার্চ করুন" onkeyup="$('div.dataTables_filter input').val(this.value); $('div.dataTables_filter input').keyup();" >


                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2  text-right">

                                    <br>

                                    <a href="{{url('admin/members/create')}}" class="btn btn-primary">সদস্য যোগ করুন </a>
                                </div>

                                <div class="col-lg-2 col-md-2 text-right">
                                    <div class="btn-group hidden-sm-down">
                                        <button type="button" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ফিল্টার<span class="caret"></span> </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="?filter=all">সবগুলো </a></li>
                                            <li><a href="?filter=active">সক্রিয় অ্যাকাউন্ট</a></li>
                                            <li><a href="?filter=deactive">নিষ্ক্রিয় অ্যাকাউন্ট</a></li>
                                        </ul>
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
                        <h2><strong>সদস্যদের  </strong> তালিকা </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-full-datatable" id="data-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>সদস্য নাম্বার </th>
                                <th>নাম </th>
                                <th>পিতার নাম </th>
                                <th>ফোন </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>সদস্য নাম্বার </th>
                                <th>নাম </th>
                                <th>পিতার নাম </th>
                                <th>ফোন </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($members??array() as $item)
                                <?php
                                        if (isset($_GET['filter']) && $_GET['filter']=='active')
                                        {
                                            if ($item->total_loan_count==0 && $item->total_fdr_count==0 && $item->total_saving_count==0)
                                            {
                                                continue;
                                            }
                                        }elseif(isset($_GET['filter']) && $_GET['filter']=='deactive')
                                        {
                                            if ($item->total_loan_count>0 || $item->total_fdr_count>0 || $item->total_saving_count>0)
                                            {
                                                continue;
                                            }

                                        }

                                ?>
                                <tr>
                                    <td>

                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                            <a href="{{url('admin/members/'.$item->id.'/edit')}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট</a>
                                            <a href="{{url('admin/members/find?id='.$item->id)}}" class="dropdown-item"><i class="fa fa-eye"> </i> বিস্তারিত</a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/members', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন', array(
                                                    'type' => 'submit',
                                                    'class' => 'dropdown-item',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                    )) !!}
                                            {!! Form::close() !!}
                                            <a href="{{url('admin/barcode-test/'.$item->id)}}" target="_blank" class="dropdown-item"><i class="fa fa-barcode"> </i> বারকোড</a>
                                        </div>



                                    </td>
                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->name_bn}}</td>
                                    <td>{{$item->father_name}}</td>
                                    <td>{{$item->phone}}</td>
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

@endsection


@section('script')
<script>
    $(function() {
        $('#data-table').DataTable({
            dom: 'lBfrtip',
            bFilter:true,

            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('members.datatables.data') !!}',
            columns: [
                { data: 'action', name: 'action' },
                { data: 'unique_id', name: 'unique_id' },
                { data: 'name_bn', name: 'name_bn' },
                { data: 'father_name', name: 'father_name' },
                { data: 'phone', name: 'phone' }
            ],
            order:[],
            paging: true,
        });
    });
    </script>

@endsection

