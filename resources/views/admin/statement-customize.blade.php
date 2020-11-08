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
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">ঋণের তথ্য খুঁজুন</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="printable">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
                    <div class="body">

                        <form action="">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datetimepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small> পর্যন্ত</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datetimepicker" value="{{$_GET['to'] ?? ''}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2">

                                    <br>

                                    <div class="input-group">
                                        <button class="btn btn-primary btn-round">খুঁজুন</button>
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

        <?php
            $from = $_GET['from']?? date("Y-m-d H:i:s");
            $to = $_GET['to']?? date("Y-m-d H:i:s");
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

                    <div class="body row">

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
                                            <legend><a href="{{url('admin/transaction-by-head?head_id='.$income_head->id.'&from='.$from.'&to='.$to)}}">{{$income_head->name}}: {{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($income_head->id,$from,$to))}} টাকা</a></legend>
                                        @endif
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                @foreach($income_head->childs as $child)
                                                    <tr>
                                                        <td><a href="{{url('admin/transaction-by-head?head_id='.$child->id.'&from='.$from.'&to='.$to)}}">{{$child->name}}</a></td>
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
                                            <legend><a href="{{url('admin/transaction-by-head?head_id='.$expense_head->id.'&from='.$from.'&to='.$to)}}">{{$expense_head->name}}: {{\App\NumberConverter::en2bn(\App\Transaction::TransactionByHeadDate($expense_head->id,$from,$to))}} টাকা</a></legend>
                                        @endif
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            @foreach($expense_head->childs as $child)
                                                <tr>
                                                    <td><a href="{{url('admin/transaction-by-head?head_id='.$child->id.'&from='.$from.'&to='.$to)}}">{{$child->name}}</a></td>
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

