@extends('layouts.admin')
@section('style')
<style>

    @media print {


        .table td, .table th {
            padding: .01rem 0.25rem;
            vertical-align: top;
            border-top: 1px solid #000 !important;
            font-size: 12px !important;
        }
        .tableboder {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
            }

        @page { margin: 0; }
        body { margin: 0.6cm 2cm; }
    }



    </style>

@endsection
@section('content')


<!-- Main Content -->
<section class="content">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">সঞ্চয় পলিসি আমানত</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">সঞ্চয় পলিসি আমানত</a></li>
            </ul>
        </div>

        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong>সঞ্চয় পলিসি আমানত তালিকা</strong></h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>

                    @php
                        $from = $_GET['from']?? date("Y-m-d");
                        $to = $_GET['to']?? date("Y-m-d");
                    @endphp
                    <div class="body table-responsive">

                        <form action="">

                            <div class="row clearfix">

                                {{-- <div class="col-lg-4 col-md-3">

                                    <label for=""><small>ধরণ</small></label>

                                    <div class="input-group">
                                        <select name="type" id="" class="form-control">
                                            <option value="">বাছাই করুন</option>
                                            <option {{isset($_GET['type']) && $_GET['type']=='short'?'selected':'' }} value="approved">স্বল্পমেয়াদী সঞ্চয়</option>
                                            <option {{isset($_GET['type']) && $_GET['type']=='long'?'selected':'' }} value="closed">দীর্ঘ মেয়াদী সঞ্চয়</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-lg-3 col-md-3">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">

                                    <label for=""><small> পর্যন্ত</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['to'] ?? ''}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-1">

                                    <br>

                                    <div class="input-group">
                                        <button class="btn btn-primary btn-round">খুঁজুন</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <br>
                        <br>

                        <div id="printable">
                            <div class="row" >
                                <div class="col-sm-12">
                                    <div class="body">
                                        <h1 style="text-align: center">দি অন্তরঙ্গ বহুমুখী সমবায় সমিতি লিঃ</h1>
                                    <h5 style="text-align: center">৭৪১,মনিপুর,মিরপুর-২,ঢাকা-১২১৬ । রেজি নং-১৮৭/০১</h5>
                                    <h3 style="text-align: center">
                                        @if($type=='short')
                                        ৫ বছরের সঞ্চয় পলিসি আমানত তালিকা
                                        @elseif($type=='long')
                                        ১০ বছরের সঞ্চয় পলিসি আমানত তালিকা
                                        @elseif($type=='daily')
                                        দৈনিক সঞ্চয় পলিসি আমানত তালিকা
                                        @elseif($type=='current')
                                        সেভিংস সঞ্চয় পলিসি আমানত তালিকা
                                        @endif
                                        <span style="padding-left: 15px;">তারিখঃ</span>

                                         @if ($from != $to)
                                            {{NumberConverter::en2bn(date("d-m-Y",strtotime($from)))}} - {{NumberConverter::en2bn(date("d-m-Y",strtotime($to)))}}
                                        @else
                                            {{NumberConverter::en2bn(date("d-m-Y",strtotime($to)))}}
                                         @endif
                                    </h3>
                                    </div>
                                </div>
                            </div>
                        </div>




                            <table class="table table-bordered table-striped table-hover dataTable js-full-datatable">
                                <thead>
                                <tr>
                                    <th>ক্রঃ নং</th>
                                    <th> সদস্য নাম  </th>
                                    <th> সদস্য নং </th>
                                    <th> মোট সঞ্চয়</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ক্রঃ নং</th>
                                    <th> সদস্য নাম  </th>
                                    <th> সদস্য নং </th>
                                    <th> মোট সঞ্চয়</th>
                                </tr>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($records ?? array() as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->user->name_bn??'N/A'}}</td>
                                        <td>{{$item->user->unique_id??'N/A'}}</td>
                                        <td>{{\App\Saving::get_total_diposit_in_range($item->id,$from,$to)??'N/A'}}</td>

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
    </div>



</section>



{{-- <script>

    function printDiv() {

        var printContents = document.getElementById('printable').innerHTML;


        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;



        window.print();



        document.body.innerHTML = originalContents;

    }

</script> --}}

@endsection


@section('script')

@endsection

