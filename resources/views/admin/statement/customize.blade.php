@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>


    .table td, .table th {
    padding: .25rem;
    vertical-align: top;
    border-top: 1px solid #e3e6f0;
}
</style>

<!-- Main Content -->
<section class="content">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">লেনদেনের স্টেটমেন্ট</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">লেনদেনের স্টেটমেন্ট</a></li>
            </ul>
        </div>

        <div class="row">
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
                            <div class="col-lg-2 col-md-2">
                                <br>
                                <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন</a>
                            </div>
                        </div>
                    </form>
                    <br>

                    <div class="row " id="printable">

                        <div class="col-sm-6" style="width: 50% !important;float:left !important;">

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
                        <div class="col-sm-6" style="width: 50% !important;float:right !important;">
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
                    <br>
                    <div class="row">
                        <div class="col-sm-3" style="width: 50% !important;float:right !important;">
                            <div class="header">

                                <h2>সভাপতি</h2>

                            </div>
                        </div>
                        <div class="col-sm-3" style="width: 50% !important;float:right !important;">
                            <div class="header">

                                <h2>সাধারণ সম্পাদক</h2>

                            </div>
                        </div>
                        <div class="col-sm-3" style="width: 50% !important;float:right !important;">
                            <div class="header">

                                <h2>আর্থ-সম্পাদক</h2>

                            </div>
                        </div>
                        <div class="col-sm-3" style="width: 50% !important;float:right !important;">
                            <div class="header">

                                <h2>প্রস্তুত কারক</h2>

                            </div>
                        </div>
                     </div>
                    <div class="row" id="printable">
                        <div class="col-sm-4" style="width: 50% !important;float:left !important;">
                            <div class="body">

                                <fieldset>

                                        <legend></legend>

                                        {{-- <legend><a href="{{url('')}}">:  টাকা</a></legend> --}}

                                    <table class="table table-striped table-hover">
                                        <tbody>

                                            <tr>
                                                <td><a href="{{url('')}}">ব্যাংক ঋণ </a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">ব্যাংক ঋণ পরিশোধ</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">ব্যালেন্স</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-sm-4" style="width: 50% !important;float:left !important;">
                            <div class="body">

                                <fieldset>

                                        <legend></legend>

                                        {{-- <legend><a href="{{url('')}}">:  টাকা</a></legend> --}}

                                    <table class="table table-striped table-hover">
                                        <tbody>

                                            <tr>
                                                <td><a href="{{url('')}}">এফ ডি আর </a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">হাতে নগদ</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">ব্যাংক ব্যালেন্স</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">সর্বমোট</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-sm-4" style="width: 50% !important;float:left !important;">
                            <div class="body">

                                <fieldset>

                                        <legend> </legend>

                                        {{-- <legend><a href="{{url('')}}">:  টাকা</a></legend> --}}

                                    <table class="table table-striped table-hover">
                                        <tbody>

                                            <tr>
                                                <td><a href="{{url('')}}">ব্যাংকের নাম </a></td>
                                                <td style="width: 30%;">টাকা পরিমাণ</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">যমুনা</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">শাহজালাল</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">মার্কেন্টাইল</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{url('')}}">সর্বমোট</a></td>
                                                <td style="width: 30%;">০ টাকা</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </fieldset>
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

            <button class="btn btn-primary" onclick="printDiv()"><i class="zmdi zmdi-print"></i>প্রিন্ট করুন</button>

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

