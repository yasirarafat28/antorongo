@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>
    .dataTables_wrapper .dt-buttons , .dataTables_wrapper .dataTables_filter{
        display: none;
    }

</style>

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
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-full-datatable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>সদস্য নাম্বার </th>
                                <th>নাম </th>
                                <th>পিতার নাম </th>
                                <th>ফোন </th>
                                <th>বর্তমান ঠিকানা</th>
                                <th>তারিখ</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>সদস্য নাম্বার </th>
                                <th>নাম </th>
                                <th>পিতার নাম </th>
                                <th>ফোন </th>
                                <th>বর্তমান ঠিকানা</th>
                                <th>তারিখ</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($members as $item)
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
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->name_bn}}</td>
                                    <td>{{$item->father_name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->present_address}}</td>
                                    <td>{{date('Y/m/d',strtotime($item->created_at))}}</td>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <div class="pull-right">
                            {!! $members->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>



<script type="text/javascript">

    function get_district_list(division_id)
    {
        var list = $("#district-form");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getDistrict') }}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "division_id": division_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {
                    list.append(new Option(item.name, item.id));
                });
            },

            error: function (error) {
                console.log(error);
                $('#package-lists').html(error);
            },

        });
    }

    function get_thana_list(district_id)
    {
        var list = $("#thana-form-count");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getThana') }}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "district_id": district_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {
                    list.append(new Option(item.name+" ("+item.members_count+") ", item.id));
                });
            },

            error: function (error) {
                console.log(error);
                $('#package-lists').html(error);
            },

        });
    }
</script>
@endsection


@section('script')

@endsection

