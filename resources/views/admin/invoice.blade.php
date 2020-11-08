@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>
    p{
        line-height: 0.6em;
    }
    h2{line-height: 0.6em;
    }

    td{
        border-collapse: collapse !important;
        border-bottom: 1px solid #0c0c0c !important;
    }
    th{
        border-collapse: collapse !important;
        border: 1px solid #0c0c0c !important;
    }
    table{

        border: 1px solid #0c0c0c;
    }

</style>

<link rel="stylesheet" href="{{asset('assets/css/inbox.css')}}">
<section class="content inbox">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Inbox
                <small>Welcome to {{\App\Setting::setting()->app_name}}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong> আয় যোগ </strong>  করুন</h2>

                    </div>
                    <div class="body row" id="printable">

                        <div class="" style="width: 45%;float: left;margin-top:10px;margin-right:  5%;" >
                            <div style="height: 130px;" >
                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;">
                                        <img  src="{{asset('assets/images/logo.svg')}}" width="48" height="48" alt="{{\App\Setting::setting()->app_name}}">
                                    </div>
                                    <div class="col-md-8" style="text-align: center;">
                                        <h2 style="line-height: 0.6em;font-size: 24px;">দি-অন্তরঙ্গ সঞ্চয় প্রকল্প</h2>
                                        <p style="line-height: 0.6em;font-size: 14px;"> পরিচালনায়ঃ <b>{{\App\Setting::setting()->app_name}}</b></p>
                                        <p style="line-height: 0.6em;font-size: 14px;"> রেজি নং-১৮৭/০১, ফোনঃ ৯০০৫০৫২</p>
                                        <p style="line-height: 0.6em;font-size: 14px;">৭৪১, মনিপুর, মিরপুর, ঢাকা-১২১৬।</p>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <p style="line-height: 1.4em;font-size: 12px;">অফিস<br>কপি</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 row">
                                    <p class="col-md-8"  style="line-height: 0.6em">নামঃ {{$user->name_bn??'ইয়াসির আরাফাত'}}</p>
                                    <p class="col-md-4" style="line-height: 0.6em">তারিখঃ  rtert</p>
                                    <p class="col-md-6" style="line-height: 0.6em">সভ্য নংঃ   {{$user->unique_id??'১২৩২৪৫৩৬৪৭'}}</p>
                                </div>
                            </div>

                            <table style="font-size: 16px;margin-top: 4px;border: 1px solid #0c0c0c;">
                                <thead>
                                <tr>
                                    <th  style="width: 450px;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">বিবিধ</th>
                                    <th style="width:130px;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">টাকা </th>
                                    <th style="width: 100px;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">পয়সা</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">ভর্তি ফি</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> 0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> সঞ্চয় পলিসি আমানত </td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> মেয়াদী আমানত আদায়</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">ব্যাংক হতে উত্তোলন </td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">ব্যাংক লাভ আদায়</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">জরিমানা</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">অপলাভ আদায়</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">বিবিধ</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">0</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> মোট</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">7868</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">০</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                        <div class="" style="width: 45%;float: left;margin-top:10px;margin-left: 5%;" >
                            <div style="height: 130px;" >
                                <div class="row">
                                    <div class="col-md-2" style="text-align: right;">
                                        <img  src="{{asset('assets/images/logo.svg')}}" width="48" height="48" alt="{{\App\Setting::setting()->app_name}}">
                                    </div>
                                    <div class="col-md-8" style="text-align: center;">
                                        <h2 style="line-height: 0.6em;font-size: 24px;">দি-অন্তরঙ্গ সঞ্চয় প্রকল্প</h2>
                                        <p style="line-height: 0.6em;font-size: 14px;"> পরিচালনায়ঃ <b>{{\App\Setting::setting()->app_name}}</b></p>
                                        <p style="line-height: 0.6em;font-size: 14px;"> রেজি নং-১৮৭/০১, ফোনঃ ৯০০৫০৫২</p>
                                        <p style="line-height: 0.6em;font-size: 14px;">৭৪১, মনিপুর, মিরপুর, ঢাকা-১২১৬।</p>
                                    </div>
                                    <div class="col-md-2" style="text-align: center">
                                        <p style="line-height: 1.4em;font-size: 12px;">গ্রাহক<br>কপি</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 row">
                                    <p class="col-md-8"  style="line-height: 0.6em">নামঃ {{$user->name_bn??'ইয়াসির আরাফাত'}}</p>
                                    <p class="col-md-4" style="line-height: 0.6em">তারিখঃ  </p>
                                    <p class="col-md-6" style="line-height: 0.6em">সভ্য নংঃ   </p>
                                </div>
                            </div>

                            <table style="font-size: 16px;margin-top: 4px;border: 1px solid #0c0c0c;">
                                <thead>
                                <tr>
                                    <th  style="width: 450px;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">বিবিধ</th>
                                    <th style="width:130px;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">টাকা </th>
                                    <th style="width: 100px;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">পয়সা</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">ভর্তি ফি</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> fdgdfg</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">fdgdfg</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> সঞ্চয় পলিসি আমানত </td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">54</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> মেয়াদী আমানত আদায়</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">ব্যাংক হতে উত্তোলন </td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">ব্যাংক লাভ আদায়</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">জরিমানা</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">456</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">4564</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">অপলাভ আদায়</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">sewr</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">wertwe</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">বিবিধ</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">345</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">345</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> মোট</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">345</td>
                                        <td style="text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">০</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                        <div style="clear: both;"></div>
                    </div>

                    <?php /* ?<

                    <div class="body row" id="printable">

                        <div class="" style="width: 65%;float: left;margin-top:10px;" id="prindtable">

                            <div style="height: 130px;">

                            </div>

                            <div class="row">
                                <div class="col-md-12 row">
                                    <p class="col-md-8"  style="line-height: 0.6em">নামঃ {{$user->name??'ইয়াসির আরাফাত'}}</p>
                                    <p class="col-md-4" style="line-height: 0.6em">তারিখঃ  {{$date??'১৪-৪-২০১৯'}}</p>
                                    <p class="col-md-6" style="line-height: 0.6em">সভ্য নংঃ   {{$user->unique_id??'১২৩২৪৫৩৬৪৭'}}</p>
                                </div>
                            </div>

                            <table style="font-size: 16px;margin-top: 4px;">
                                <thead>
                                <tr>
                                    <th  style="width: 450px;text-align: center;">.</th>
                                    <th style="width:130px;text-align: center;"> .</th>
                                    <th style="width: 100px;text-align: center;"> .</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <!--ভর্তি ফি--> </td>
                                        <td style="text-align: center;"> {{\App\NumberConverter::en2bn($admission_fee??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($admission_fee_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--সঞ্চয় পলিসি আমানত--> </td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($saving_amount??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($saving_amount_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--েয়াদী আমানত আদায়--> </td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($durable_saving_amount??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($durable_saving_amount_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--ব্যাংক হতে উত্তোলন--> </td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($bank_withdrawal??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($bank_withdrawal_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--ব্যাংক লাভ আদায়--> </td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($bank_profit??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($bank_profit_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--জরিমানা --></td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($fine??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($fine_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--অপলাভ আদায়--></td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($prfit_share_dec??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($prfit_share_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td> <!--িবিধ--></td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($others??0)}}</td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($others_dec??0)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"> <!--মোট--></td>
                                        <td style="text-align: center;">{{\App\NumberConverter::en2bn($total)}}</td>
                                        <td style="text-align: center;">০</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                        <div class="" style="width: 30%;float: left; display: none;">

                            <div class="row">

                                <div class="col-md-2 text-right">
                                    <img src="{{asset('assets/images/logo.svg')}}" width="48" height="48" >
                                </div>
                                <div class="col-md-8 text-center">
                                    <h2 style="line-height: 0.6em;">দি-অন্তরঙ্গ সঞ্চয় প্রকল্প</h2>
                                    <p style="line-height: 0.6em;"> পরিচালনায়ঃ {{\App\Setting::setting()->app_name}}</p>
                                    <p style="line-height: 0.6em;"> রেজি নং-১৮৭/০১, ফোনঃ ৯০০৫০৫২</p>
                                    <p style="line-height: 0.6em;">৭৪১, মনিপুর, মিরপুর, ঢাকা-১২১৬।</p>
                                </div>
                                <div class="col-md-2 text-left" style="margin-top: 2px;">
                                    <p style="line-height: 0.6em;">অফিস কপি</p>
                                </div>
                                <div class="col-md-12 row">
                                    <p class="col-md-8"  style="line-height: 0.6em">নামঃ {{$user->name??'ইয়াসির আরাফাত'}}</p>
                                    <p class="col-md-4" style="line-height: 0.6em">তারিখঃ  {{$user->name??'১৪-৪-২০১৯'}}</p>
                                    <p class="col-md-6" style="line-height: 0.6em">সভ্য নংঃ   {{$user->unique_id??'১২৩২৪৫৩৬৪৭'}}</p>
                                </div>
                            </div>

                            <table style="font-size: 16px;">
                                <thead>
                                <tr>
                                    <th  style="width: 450px;text-align: center;">বিবরণ</th>
                                    <th style="width:130px;text-align: center;"> টাকা</th>
                                    <th style="width: 100px;text-align: center;"> পয়সা</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <!--ভর্তি ফি--> </td>
                                <td style="text-align: center;"> ০</td>
                                <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--সঞ্চয় পলিসি আমানত--> </td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--েয়াদী আমানত আদায়--> </td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--ব্যাংক হতে উত্তোলন--> </td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--ব্যাংক লাভ আদায়--> </td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--জরিমানা --></td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--অপলাভ আদায়--></td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td> <!--িবিধ--></td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                <tr>
                                    <td class="text-right"> <!--মোট--></td>
                                    <td style="text-align: center;">০</td>
                                    <td style="text-align: center;">০</td>
                                </tr>
                                </tbody>

                                </table>
                        </div>

                        <div style="clear: both;"></div>
                    </div> <?php */ ?>
                </div>
            </div>
        </div>


        <div class="row clearfix">

            <br>

            <div class="col-md-2 offset-5">

                <button class="btn btn-primary" onclick="printDiv()"><i class="zmdi zmdi-print"></i> Print</button>

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


