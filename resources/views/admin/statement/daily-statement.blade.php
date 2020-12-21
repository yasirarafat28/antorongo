@extends('layouts.admin')
@section('style')
<style>

    @media print {


        .table td, .table th {
            padding: .01rem 0.25rem;
            vertical-align: top;
            border-top: 1px solid #e3e6f0 !important;
            font-size: 12px !important;
        }
        .tableboder {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
            }

        @page { margin: 0; }
        body { margin: 0.6cm; }
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
                                    <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন</a>
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
                                    <h3 style="text-align: center">দৈনিক প্রাপ্তি-প্রদান বিবরণী  <span style="padding-left: 15px;">তারিখঃ</span> {{$_GET['date']??''}}</h3>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="width: 50% !important;float:left !important;">
                                    <div class="body">

                                        <fieldset>
                                            <table class="tableboder">
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
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                                <br>
                                <br>

                                <div class="col-sm-12" style="width: 100% !important; margin-top:2rem">

                                    <div class="body">

                                            <fieldset>
                                                <table class="table table-bordered table-hover">
                                                    <tbody>
                                                            <tr>
                                                                <td style="width: 5%;">ক্রঃ নং</td>
                                                                <td style="width: 25%;">প্রাপ্তি বিবরণী</td>
                                                                <td style="width: 10%;">টাকা</td>
                                                                <td style="width: 10%;">টাকা</td>
                                                                <td style="width: 5%;">ক্রঃ নং</td>
                                                                <td style="width: 25%;">প্রাদান বিবরণী</td>
                                                                <td style="width: 10%;">টাকা</td>
                                                                <td style="width: 10%;">টাকা</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">১</td>
                                                                <td style="width: 25%;">পরিচালক সভ্য খাতে প্রাপ্তি</td>
                                                                <td style="width: 10%;"> </td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;">১</td>
                                                                <td style="width: 25%;">ক) জমি ক্রয়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক) আমানত</td>
                                                                <td style="width: 10%;">{{\App\NumberConverter::en2bn(\App\Transaction::total_by_slug_date('fdr_deposit',$from,$to))}} টাকা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ) ব্যাংক জমা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ) ঋণের আসল আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ) গৃহ নির্মাণ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ) ঋণের লাভ আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঘ) ব্যাংক ঋণ পঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঙ) ঋণ প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">২</td>
                                                                <td style="width: 25%;">সঞ্চয় প্রকল্প খাতে প্রাপ্তি</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঙ) ঋণ প্রদান(স্বর্ণ মরগেজ)</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক)সঞ্চয় প্রকল্প আমানত-৫</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">চ) সাধারন সঞ্চয় ফেরত(সেভিং)</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ)সঞ্চয় প্রকল্প আমানত-১০</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ছ) বেতন ভাতা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ) ৫ বছর ঋণের আসল আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">জ) বিদ্যুৎ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঘ) ৫ বছর ঋণের লাভ আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঝ) অফিস ভাড়া</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঙ) ১০ বছর ঋণের আসল আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঞ) গোডাউন ভাড়া</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">চ) ১০ বছর ঋণের লাভ আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ট) আপ্যায়ন</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ছ) দৈনিক সঃ ঋণের আসল আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঠ) ষ্টেশনারী</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">জ) দৈনিক সঃ ঋণের লাভ আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ড) যাতায়াত</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঝ) ভর্তি ফী</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঢ) পানির/ময়লার/ডিশ বিল</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঞ) ঋনের ফরম</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ণ) টেলিফোন</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ট) জরিমানা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ত) মোবাইল</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঠ) ভ্যাট আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">থ) ইলেকাট্রনিক্স যন্ত্রাংশ মেরাঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ড) অপলাভ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">দ) নেট বিল</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঢ) ব্যাংক লাভ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ধ) এফ ডি আর ব্যাংক</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ণ) বিবিধ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ন) বিবিধ খরচ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৩</td>
                                                                <td style="width: 25%;">সাধারন সঞ্চয় (সেভিংস)</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;">২</td>
                                                                <td style="width: 25%;">সঞ্চয় প্রকল্প খাতে প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৪</td>
                                                                <td style="width: 25%;">দৈনিক সঞ্চয় আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক) সঞ্চয় প্রঃ আমানত ৫ ফেরত</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৫</td>
                                                                <td style="width: 25%;">মেয়াদী আমানত আদায়</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ)সঞ্চয় প্রঃ আঃ ৫ লাভ প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ)সঞ্চয় প্রঃ আমানত ১০ ফেরত</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৬</td>
                                                                <td style="width: 25%;">ব্যাংক হতে প্রাপ্তি</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঘ)সঞ্চয় প্রঃ আঃ ১০ লাভ প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক)ব্যাংক হতে উত্তোলন</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঙ)দৈনিক সঞ্চয় ফেরত</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ)ব্যাংক হতে ঋণ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">চ)দৈনিক সঃ লাভ প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ)এফ.ডি.আর আসল</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ছ)মেয়াদী আমানত ফেরত</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঘ)এফ.ডি.আর লাভ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">জ)লাভাংশ প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোট প্রাপ্তি</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোট প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৭</td>
                                                                <td style="width: 25%;">সর্বমোট প্রাপ্তি</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;">৩</td>
                                                                <td style="width: 25%;">সর্বমোট প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক)পূর্বের হাতে নগদ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক)পূর্বের প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ)আজকের হাতে নগদ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ)আজকের প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ)</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ) আজকের আতিরিক্ত প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঘ)ক্যাশিয়ার কে প্রদান</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ঘ)</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৮</td>
                                                                <td style="width: 25%;">ব্যাংক ব্যালেন্সঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;">৪</td>
                                                                <td style="width: 25%;">ব্যাংক ব্যালেন্সঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক) পূর্বের জমা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">ক) পূর্বের জমা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ ) (+) অদ্য জমা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">খ ) (+) অদ্য জমা</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ) (-) উত্তোলন</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;">গ) (-) উত্তোলন</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">স্থিতিঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">স্থিতিঃ</td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;">৯</td>
                                                                <td style="width: 25%;">প্রারম্ভিক জের</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;">৫</td>
                                                                <td style="width: 25%;">হাতে নগদ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 5%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 10%; text-align:right">মোটঃ</td>
                                                                <td style="width: 10%;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 3%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 12%; text-align:right">সর্বমোট হিসাবঃ</td>
                                                                <td style="width: 10%;"></td>
                                                                <td style="width: 3%;"></td>
                                                                <td style="width: 25%;"></td>
                                                                <td style="width: 12%; text-align:right">সর্বমোট হিসাবঃ</td>
                                                                <td style="width: 10%;"></td>
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

                                                    <tr>
                                                        <td>ব্যাংক ঋণ =</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ব্যাংক ঋণ পরিশোধ =</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ব্যালেন্স =</td>
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
                                                        <td>এফ ডি আর =</td>
                                                    </tr>
                                                    <tr>
                                                        <td>হাতে নগদ =</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ব্যাংক ব্যালেন্স =</td>
                                                    </tr>
                                                    <tr>
                                                        <td>সর্বমোট =</td>
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
                                                        <td>{{App\Wallet::balance('bank',$from,$to,1)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>শাহজালাল</td>
                                                        <td>{{App\Wallet::balance('bank',$from,$to,2)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>মার্কেন্টাইল</td>
                                                        <td>{{App\Wallet::balance('bank',$from,$to,3)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>সর্বমোট =</td>
                                                        <td>{{App\Wallet::balance('bank',$from,$to)}}</td>
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

