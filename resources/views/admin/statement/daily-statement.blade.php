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
            <h1 class="h3 mb-0 text-gray-800">দৈনিক প্রাপ্তি-প্রদান বিবরণী</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">দৈনিক প্রাপ্তি-প্রদান বিবরণী</a></li>
            </ul>
        </div>

        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong>দৈনিক প্রাপ্তি-প্রদান বিবরণী</strong></h2>

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
                                {{-- <div class="col-lg-2 col-md-2">
                                    <br>
                                    @if (count($_GET))

                                        <a href="?{{$_SERVER['QUERY_STRING']}}&limit=-1" class="btn btn-success">সবগুলো দেখুন </a>
                                    @else

                                        <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন </a>

                                    @endif
                                </div> --}}
                            </div>
                        </form>
                        <br>

                        <div id="printable">
                            <div class="row" >
                                <div class="col-sm-8" style="width: 50% !important;float:left !important;">
                                    <div class="body">
                                        <h1 style="text-align: center">দি অন্তরঙ্গ বহুমুখী সমবায় সমিতি লিঃ</h1>
                                    <h5 style="text-align: center">৭৪১,মনিপুর,মিরপুর-২,ঢাকা-১২১৬ । রেজি নং-১৮৭/০১</h5>
                                    <h3 style="text-align: center">দৈনিক প্রাপ্তি-প্রদান বিবরণী  <span style="padding-left: 15px;">তারিখঃ</span>

                                         @if ($from != $to)
                                            {{NumberConverter::en2bn($from)}} -  {{NumberConverter::en2bn($to)}}
                                        @else
                                            {{NumberConverter::en2bn($to)}}
                                         @endif
                                    </h3>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="width: 50% !important;float:left !important;">
                                    <div class="body">

                                        <fieldset>
                                            {{-- <table class="tableboder">
                                                <tbody>

                                                    <tr>
                                                        <td style="padding-left: 5px;">মোট প্রাপ্তির ভাউচার সংখ্যা =</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-left: 5px;">মোট প্রদান ভাউচার সংখ্যা =</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;">সর্বমোট =</td>
                                                    </tr>
                                                </tbody>
                                            </table> --}}
                                        </fieldset>
                                    </div>
                                </div>
                                <br>
                                <br>

                                @php
                                    $director_income = 0;
                                    $saving_field_income = 0;
                                    $general_field_income = 0;
                                    $daily_field_income = 0;
                                    $fdr_field_income = 0;
                                    $bank_field_income = 0;
                                @endphp

                                    <div class="col-sm-6" style="width: 45% !important;">

                                        <div class="body">

                                                <fieldset>
                                                    <table class="table table-bordered table-hover">
                                                        <tbody>
                                                                <tr>
                                                                    <td style="width: 10%;">ক্রঃ নং</td>
                                                                    <td style="width: 50%;">প্রাপ্তি বিবরণী</td>
                                                                    <td style="width: 20%;">টাকা</td>
                                                                    <td style="width: 20%;">টাকা</td>

                                                                </tr>
                                                                <tr>
                                                                    <td>১</td>
                                                                    <td>পরিচালক সভ্য খাতে প্রাপ্তি</td>
                                                                    <td></td>
                                                                    <td></td>

                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক) আমানত</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('fdr_revenue_income',['founding_member'],$from,$to);

                                                                        $director_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>

                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ) ঋণের আসল আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_revenue_collect_income',['founding_member'],$from,$to);

                                                                        $director_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>

                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ) ঋণের লাভ আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_profit_collect_income',['founding_member'],$from,$to);

                                                                        $director_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td>{{NumberConverter::en2bn($director_income)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>২</td>
                                                                    <td>সঞ্চয় প্রকল্প খাতে প্রাপ্তি</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক)সঞ্চয় প্রকল্প আমানত-৫</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('saving_project_5_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ)সঞ্চয় প্রকল্প আমানত-১০</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('saving_project_10_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ) ৫ বছর ঋণের আসল আদায়</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_revenue_collect_income',['short_term'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঘ) ৫ বছর ঋণের লাভ আদায়</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_profit_collect_income',['short_term'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঙ) ১০ বছর ঋণের আসল আদায়</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_revenue_collect_income',['long_term'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>চ) ১০ বছর ঋণের লাভ আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_profit_collect_income',['long_term'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ছ) দৈনিক সঃ ঋণের আসল আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_revenue_collect_income',['daily_saving'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>জ) দৈনিক সঃ ঋণের লাভ আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_profit_collect_income',['daily_saving'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ছ) মেয়াদী আমানত ঋণের আসল আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_revenue_collect_income',['fdr_member'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>জ) মেয়াদী আমানত ঋণের লাভ আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_account_project_date('loan_profit_collect_income',['fdr_member'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr><tr>
                                                                    <td></td>
                                                                    <td>ছ) অন্যান্য সঃ ঋণের আসল আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_except_project_date('loan_revenue_collect_income',['fdr_member','founding_member','daily_saving','short_term','long_term'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>জ) অন্যান্য সঃ ঋণের লাভ আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_except_project_date('loan_profit_collect_income',['fdr_member','founding_member','daily_saving','short_term','long_term'],$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঝ) ভর্তি ফী</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('addmission_fee_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঞ) ঋনের ফরম</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('loan_form',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ট) জরিমানা</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('fine_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঠ) ভ্যাট আদায়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('vat_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ড) অপলাভ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('suppression_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঢ) ব্যাংক লাভ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_profit_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ণ) বিবিধ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('other_income',$from,$to);

                                                                        $saving_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td>{{NumberConverter::en2bn($saving_field_income)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৩</td>
                                                                    <td>সাধারন সঞ্চয় (সেভিংস)</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('general_saving_income',$from,$to);

                                                                        $general_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৪</td>
                                                                    <td>দৈনিক সঞ্চয় আদায়</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('daily_saving_collection_income',$from,$to);

                                                                        $daily_field_income +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৫</td>
                                                                    <td>মেয়াদী আমানত আদায়</td>

                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('fdr_revenue_income',$from,$to);

                                                                        $fdr_field_income += $amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৬</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৭</td>
                                                                    <td>ব্যাংক হতে প্রাপ্তি</td>
                                                                    <td>


                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক)ব্যাংক হতে উত্তোলন</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_withdraw_income',$from,$to);

                                                                        $bank_field_income += $amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ)ব্যাংক হতে ঋণ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_loan_income',$from,$to);

                                                                        $bank_field_income += $amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ)এফ.ডি.আর আসল</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_fdr_revenue_income',$from,$to);

                                                                        $bank_field_income += $amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঘ)এফ.ডি.আর লাভ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_fdr_profit_income',$from,$to);

                                                                        $bank_field_income += $amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td>{{NumberConverter::en2bn($bank_field_income)}}</td>
                                                                </tr>

                                                                @php
                                                                    $grand_total_income = $fdr_field_income +  $daily_field_income +  $bank_field_income
                                                                     +  $saving_field_income +  $general_field_income + $director_income;
                                                                @endphp
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোট প্রাপ্তি</td>
                                                                    <td>{{NumberConverter::en2bn($grand_total_income)}}</td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="width: 45% !important;">


                                        @php
                                            $general_expense = 0;
                                            $saving_field_expense = 0;
                                        @endphp
                                        <div class="body">

                                                <fieldset>
                                                    <table class="table table-bordered table-hover">
                                                        <tbody>
                                                                <tr>
                                                                    <td style="width: 10%;">ক্রঃ নং</td>
                                                                    <td style="width: 50%;">প্রদান বিবরণী</td>
                                                                    <td style="width: 20%;">টাকা</td>
                                                                    <td style="width: 20%;">টাকা</td>

                                                                </tr>
                                                                <tr>

                                                                    <td>১</td>
                                                                    <td>ক) জমি ক্রয়</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('land_buy_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>খ) ব্যাংক জমা</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_deposit_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ) গৃহ নির্মাণ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('house_construction_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>ঘ) ব্যাংক ঋণ পরিশোধ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_loan_payment_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঙ) ঋণ প্রদান</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('loan_giving_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঙ) ঋণ প্রদান(স্বর্ণ মরগেজ)</td>
                                                                    <td>
                                                                        @php
                                                                        $gold_loan_ids =App\Loan::withCount('OrnamentDepositors')->having('ornament_depositors_count','>',0)->get('id')->pluck('id')->toArray();
                                                                        $amount = App\Transaction::whereHas('head',function($q){
                                                                            $q->where('slug','loan_giving_expense');

                                                                        })
                                                                        ->where(function($q) use($from,$to){
                                                                            if($from){
                                                                                $q->where(DB::raw('DATE(date)'),'>=',$from);
                                                                            }
                                                                            if($to){
                                                                                $q->where(DB::raw('DATE(date)'),'<=',$to);
                                                                            }

                                                                        })
                                                                        ->whereIn('transactable_id',$gold_loan_ids)->sum('amount');
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>চ) সাধারন সঞ্চয় ফেরত(সেভিং)</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('general_saving_refund_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ছ) বেতন ভাতা</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('salary_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>জ) বিদ্যুৎ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('electricity_bill_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঝ) অফিস ভাড়া</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('office_rent_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঞ) গোডাউন ভাড়া</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('warehouse_rent',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ট) আপ্যায়ন</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('appayon_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঠ) ষ্টেশনারী</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('stationary_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>ড) যাতায়াত</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('travell_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঢ) পানির বিল</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('water_bill_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঢ) ডিশ বিল</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('dish_bill_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঢ) ময়লার বিল</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('dirty_bill_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ণ) টেলিফোন</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('Teliphone_bill_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ত) মোবাইল</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('Mobile_bill_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>থ) ইলেকাট্রনিক্স যন্ত্রাংশ মেরাঃ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('Electronic_Tools expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>দ) নেট বিল</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('Net_ bill',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ধ) এফ ডি আর ব্যাংক</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('bank_fdr_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>.</td>
                                                                    <td></td>
                                                                    <td>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ন) বিবিধ খরচ</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('other_expense',$from,$to);

                                                                        $general_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td>{{NumberConverter::en2bn($general_expense)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>২</td>
                                                                    <td>সঞ্চয় প্রকল্প খাতে প্রদান</td>

                                                                    <td>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক) সঞ্চয় প্রঃ আমানত ৫ ফেরত</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('saving_project_5_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ)সঞ্চয় প্রঃ আঃ ৫ লাভ প্রদান</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('saving_project_5_profit_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ)সঞ্চয় প্রঃ আমানত ১০ ফেরত</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('saving_project_10_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঘ)সঞ্চয় প্রঃ আঃ ১০ লাভ প্রদান</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('saving_project_10_profit_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঙ)দৈনিক সঞ্চয় ফেরত</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('daily_saving_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>চ)দৈনিক সঃ লাভ প্রদান</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('daily_saving_profit_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ছ)মেয়াদী আমানত ফেরত</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('fdr_refund_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>জ)লাভাংশ প্রদান</td>
                                                                    <td>
                                                                        @php
                                                                        $amount = App\Transaction::total_by_slug_date('fdr_profit_expense',$from,$to);

                                                                        $saving_field_expense +=$amount;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($amount)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td>
                                                                        {{NumberConverter::en2bn($saving_field_expense)}}</td>
                                                                </tr>

                                                                @php
                                                                    $grand_expense_total = $saving_field_expense + $general_expense;
                                                                @endphp
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোট প্রদান</td>
                                                                    <td>{{NumberConverter::en2bn($grand_expense_total)}}</td>
                                                                </tr>

                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                        </div>
                                    </div>


                            </div>



                            @php
                                $cashier_balance = App\Wallet::balance('cashier',null,$to);
                                $office_balance = App\Wallet::balance('office',null,$to);
                                $bank_fdr = App\Transaction::total_by_slug_date('bank_fdr_expense',null,$to);
                                $bank_fdr_withdraw = App\Transaction::total_by_slug_date('bank_fdr_revenue_income',null,$to);
                                $fdr_balance = $bank_fdr - $bank_fdr_withdraw;
                                $hand_balance = $cashier_balance + $office_balance;
                                $bank_balance = App\Wallet::balance('bank',null,$to);
                                $total_balance = $fdr_balance + $hand_balance + $bank_balance;


                                $previous_date = Carbon\Carbon::parse($from)->subDay('1')->format('Y-m-d');

                                $previous_cashier_balance = App\Wallet::balance('cashier',null,$previous_date);
                                $previous_office_balance = App\Wallet::balance('office',null,$previous_date);
                                $previous_hand_balance = $previous_cashier_balance + $previous_office_balance;
                            @endphp


                            <div class="row" >

                                    <div class="col-sm-6" style="width: 45% !important;">

                                        <div class="body">

                                                <fieldset>
                                                    <table class="table table-bordered table-hover">
                                                        <tbody>
                                                                <tr>
                                                                    <td style="width: 10%;">৮</td>
                                                                    <td style="width: 50%;">সর্বমোট প্রাপ্তি</td>
                                                                    <td style="width: 20%;"></td>
                                                                    <td style="width: 20%;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক)পূর্বের হাতে নগদ</td>
                                                                    {{-- <td>{{App\NumberConverter::en2bn(App\Wallet::balance('office',$from,$to))}}</td> --}}
                                                                    <td>
                                                                        @php
                                                                            $today_from_cashier = App\Transaction::total_by_slug_date('today_from_cashier_income',$from,$to);

                                                                        @endphp
                                                                        {{NumberConverter::en2bn($today_from_cashier)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ)আজকের হাতে নগদ</td>
                                                                    <td>

                                                                        @php
                                                                            $today_income_balance = $grand_expense_total < $grand_total_income ? $grand_total_income - $grand_expense_total:0;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($today_income_balance)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ)</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ঘ)ক্যাশিয়ার কে প্রদান</td>
                                                                    <td>

                                                                        @php
                                                                            $today_to_cashier = App\Transaction::total_by_slug_date('today_to_cashier_expense',$from,$to);

                                                                        @endphp
                                                                        {{NumberConverter::en2bn($today_to_cashier)}}

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৯</td>
                                                                    <td>ব্যাংক ব্যালেন্সঃ</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক) পূর্বের জমা</td>
                                                                    <td></td>
                                                                    <td></td>

                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ ) (+) অদ্য জমা</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ) (-) উত্তোলন</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td style="text-align:right">স্থিতিঃ</td>
                                                                    <td>{{NumberConverter::en2bn($bank_balance)}}</td>
                                                                    <td></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>১০</td>
                                                                    <td style="text-align: right">প্রারম্ভিক জের</td>
                                                                    <td>{{NumberConverter::en2bn($previous_hand_balance)}}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">সর্বমোট হিসাবঃ</td>
                                                                    <td></td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="width: 45% !important;">

                                        <div class="body">

                                                <fieldset>
                                                    <table class="table table-bordered table-hover">
                                                        <tbody>
                                                                <tr>
                                                                    <td style="width: 10%;">৩</td>
                                                                    <td style="width: 50%;">সর্বমোট প্রদান</td>
                                                                    <td style="width: 20%;"></td>
                                                                    <td style="width: 20%;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক)পূর্বের প্রদান</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>খ)আজকের প্রদান</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>গ) আজকের আতিরিক্ত প্রদান</td>
                                                                    <td>
                                                                        @php
                                                                            $extra_paid = $grand_expense_total > $today_income_balance ? $grand_expense_total - $today_income_balance:0;
                                                                        @endphp
                                                                        {{NumberConverter::en2bn($extra_paid)}}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>ঘ)</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৪</td>
                                                                    <td>ব্যাংক ব্যালেন্সঃ</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>ক) পূর্বের জমা</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>

                                                                    <td></td>
                                                                    <td>খ ) (+) অদ্য জমা</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>গ) (-) উত্তোলন</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td style="text-align:right">স্থিতিঃ</td>
                                                                    <td>{{NumberConverter::en2bn($bank_balance)}}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>৫</td>
                                                                    <td>হাতে নগদ</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">মোটঃ</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">সর্বমোট হিসাবঃ</td>
                                                                    <td></td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                        </div>
                                    </div>


                            </div>
                            <br>
                            <div style="clear: both"></div>
                            <div class="row">
                                <div class="col-sm-3" style="width: 25% !important;float:left !important;">
                                    <div class="header">

                                        <h5>সভাপতি</h5>

                                    </div>
                                </div>
                                <div class="col-sm-3" style="width: 25% !important;float:left !important;">
                                    <div class="header">

                                        <h5>সাধারণ সম্পাদক</h5>

                                    </div>
                                </div>
                                <div class="col-sm-3" style="width: 25% !important;float:left !important;">
                                    <div class="header">

                                        <h5>আর্থ-সম্পাদক</h5>

                                    </div>
                                </div>
                                <div class="col-sm-3" style="width: 25% !important;float:left !important;">
                                    <div class="header">

                                        <h5>প্রস্তুত কারক</h5>

                                    </div>
                                </div>
                            </div>

                            <div style="clear: both"></div>
                            <div class="row">
                                <div class="col-sm-4" style="width: 33.333% !important;float:left !important;">
                                    <div class="body">

                                        <fieldset>

                                                <legend></legend>

                                                {{-- <legend><a href="{{url('')}}">:  টাকা</a></legend> --}}

                                            <table class="table table-bordered table-hover">
                                                <tbody>

                                                    @php
                                                        $bank_loan_total = App\Transaction::total_by_slug_date('bank_loan_income',null,$to);
                                                        $bank_loan_paid = App\Transaction::total_by_slug_date('bank_loan_payment_expense',null,$to);
                                                    @endphp

                                                    <tr>
                                                        <td>ব্যাংক ঋণ = {{NumberConverter::en2bn($bank_loan_total)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ব্যাংক ঋণ পরিশোধ ={{NumberConverter::en2bn($bank_loan_paid)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ব্যালেন্স ={{NumberConverter::en2bn($bank_loan_total - $bank_loan_paid)}}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="width: 33.333% !important;float:left !important;">
                                    <div class="body">

                                        <fieldset>

                                                <legend></legend>

                                                {{-- <legend><a href="{{url('')}}">:  টাকা</a></legend> --}}

                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>এফ ডি আর = {{NumberConverter::en2bn($fdr_balance)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>হাতে নগদ = {{NumberConverter::en2bn($hand_balance)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ব্যাংক ব্যালেন্স = {{NumberConverter::en2bn($bank_balance)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>সর্বমোট = {{NumberConverter::en2bn($total_balance)}}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="width: 33.333% !important;float:left !important;">
                                    <div class="body">

                                        <fieldset>

                                                <legend> </legend>

                                                {{-- <legend><a href="{{url('')}}">:  টাকা</a></legend> --}}

                                            <table class="table table-bordered table-hover">
                                                <tbody>

                                                    <tr>
                                                        <th>ব্যাংকের নাম</th>
                                                        <th>টাকার পরিমাণ</th>

                                                    </tr>
                                                    <tr>
                                                        <td>যমুনা</td>
                                                        <td>{{NumberConverter::en2bn(App\Wallet::balance('bank',$from,$to,1))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>শাহজালাল</td>
                                                        <td>{{NumberConverter::en2bn(App\Wallet::balance('bank',$from,$to,2))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>মার্কেন্টাইল</td>
                                                        <td>{{NumberConverter::en2bn(App\Wallet::balance('bank',$from,$to,3))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>সর্বমোট =</td>
                                                        <td>{{NumberConverter::en2bn(App\Wallet::balance('bank',$from,$to))}}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">

                            <br>

                            <div class="col-md-2 offset-5">

                                <button class="btn btn-primary" onclick="printDiv()"><i class="zmdi zmdi-print"></i>প্রিন্ট করুন</button>
                                {{-- <button class="btn btn-primary" onclick="window.print()"><i class="zmdi zmdi-print"></i>প্রিন্ট করুন</button> --}}

                            </div>

                        </div>
                    </div>
                </div>

            </div>

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

