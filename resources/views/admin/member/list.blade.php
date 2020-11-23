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



        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2><strong>সদস্যদের  </strong> তালিকা </h2>
                            </div>
                            <div class="float-right">
                                <a href="{{url('admin/members/create')}}" class="btn btn-primary">সদস্য যোগ করুন </a>
                            </div>
                        </div>
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

