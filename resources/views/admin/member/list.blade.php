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
                                <a href="{{url('admin/members/create')}}" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> সদস্য যোগ করুন </a>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <form class="row clearfix">
                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">
                                    <label for="">প্রকল্প</label>

                                    <select name="project" onchange="this.form.submit()" id="project" class="form-control ms">
                                        <option value=""> সবগুলো   </option>
                                        <option {{isset($_GET['project']) && $_GET['project']=='founding_member'?'selected':''}} value="founding_member"> পরিচালক সদস্য   </option>
                                        <option {{isset($_GET['project']) && $_GET['project']=='daily_saving'?'selected':''}} value="daily_saving"> দৈনিক  সঞ্চয়ী প্রকল্প </option>
                                        <option {{isset($_GET['project']) && $_GET['project']=='current_saving'?'selected':''}} value="current_saving"> চলতি  প্রকল্প </option>
                                        <option {{isset($_GET['project']) && $_GET['project']=='fdr_member'?'selected':''}} value="fdr_member"> সঞ্চয়ী আমানত </option>
                                        <option {{isset($_GET['project']) && $_GET['project']=='short_term'?'selected':''}} value="short_term"> সল্প মেয়াদী(৫ বছর মেয়াদী) </option>
                                        <option {{isset($_GET['project']) && $_GET['project']=='long_term'?'selected':''}} value="long_term"> দীর্ঘ মেয়াদী(১০ বছর মেয়াদী) </option>
                                    </select>
                                </div>

                            </div>
                        </form>
                        <table class="table table-bordered table-striped table-hover js-full-datatable" id="data-table">
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
        var oTable = $('#data-table').DataTable({
            dom: 'lBfrtip',
            bFilter:true,

            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
            buttons: [
                // {
                //     extend: 'copy',
                //     exportOptions: {
                //         columns: ':gt(0)'
                //     }
                // },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: ':gt(0)'
                //     }
                // },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
            ],
            processing: true,
            serverSide: true,
            // ajax: '{!! route('members.datatables.data') !!}',
            // data: function (d) {
            //     d.project = $('#project').val(),
            // },
            ajax: {
                url: '{!! route('members.datatables.data') !!}',
                data: {
                    "project":$('#project').val(),
                },
            },
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



        $('#project').on('change',function(event){
            oTable.draw();
            event.preventDefault();
        });


    });





    </script>

@endsection

