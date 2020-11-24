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

    <div class="container-fluid" id="printable">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ঋণের তথ্য খুঁজুন</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">ঋণের তথ্য খুঁজুন</a></li>
            </ul>
        </div>

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <?php
            $from = $_GET['from']?? date("Y-m-d");
            $to = $_GET['to']?? date("Y-m-d");
        ?>



        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong> লেনদেনের স্টেটমেন্ট  </strong></h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>
                    <div class="body">
                    <form action="">

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4">

                                <label for=""><small>থেকে</small></label>

                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-calendar"></i>
                                        </span>
                                    <input type="text" class="form-control datepicker" value="{{$from}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">

                                <label for=""><small> পর্যন্ত</small></label>

                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="zmdi zmdi-calendar"></i>
                                        </span>
                                    <input type="text" class="form-control datepicker" value="{{$to}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">

                                <br>

                                <div class="input-group">
                                    <button class="btn btn-primary btn-round">খুঁজুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>

                    <div class="row">

                        <div class="col-md-5">

                            <div class="header">

                                <h2>মোট প্রাপ্তি </h2>

                            </div>
                            <div class="body">
                                @foreach($income_heads as $income_head)
                                    <?php
                                    $total=0;
                                    ?>

                                    <fieldset>
                                        @if(sizeof($income_head->childs))
                                            <legend>{{$income_head->name}}: {{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($income_head->id,$from,$to))}} টাকা</legend>
                                        @else
                                            <legend><a href="{{url('admin/transactions?head_id='.$income_head->id.'&from='.$from.'&to='.$to)}}">{{$income_head->name}}: {{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($income_head->id,$from,$to))}} টাকা</a></legend>
                                        @endif
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                @foreach($income_head->childs as $child)
                                                    <tr>
                                                        <td><a href="{{url('admin/transactions?head_id='.$child->id.'&from='.$from.'&to='.$to)}}">{{$child->name}}</a></td>
                                                        <td style="width: 30%;">{{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($child->id,$from,$to)->sum('amount'))}} টাকা</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </fieldset>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-5 offset-2">
                            <div class="header">

                                <h2>মোট প্রদান </h2>

                            </div>
                            <div class="body">
                                @foreach($expense_heads as $expense_head)
                                    <?php
                                    $total=0;
                                    ?>

                                    <fieldset>
                                        @if(sizeof($expense_head->childs))
                                            <legend>{{$expense_head->name}}: {{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($expense_head->id,$from,$to))}} টাকা</legend>
                                        @else
                                            <legend><a href="{{url('admin/transactions?head_id='.$expense_head->id.'&from='.$from.'&to='.$to)}}">{{$expense_head->name}}: {{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($expense_head->id,$from,$to))}} টাকা</a></legend>
                                        @endif
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            @foreach($expense_head->childs as $child)
                                                <tr>
                                                    <td><a href="{{url('admin/transactions?head_id='.$child->id.'&from='.$from.'&to='.$to)}}">{{$child->name}}</a></td>
                                                    <td style="width: 30%;">{{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($child->id,$from,$to)->sum('amount'))}} টাকা</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </fieldset>
                                @endforeach
                            </div>

                        </div>


                    </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <div class="row clearfix">

        <br>

        <div class="col-md-2 offset-5">

            <button class="btn btn-primary" onclick="printDiv()"><i class="zmdi zmdi-print"></i> Print</button>

        </div>

    </div>
</section>



<script>

    function printDiv() {

        var printContents = document.getElementById('printable').innerHTML;

        var originalContents = document.body.innerHTML;



        document.body.innerHTML = printContents;



        window.print();



        document.body.innerHTML = originalContents;

    }

</script>

@endsection


@section('script')

@endsection

