<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction Invoice</title>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" media="screen,print">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <style>
        body {
            margin-top: 20px;
        }
        @media print
            {
                .no-print
                {
                    display: none !important;
                }
            }

            @page { margin: 0; }
            body { margin: 1.6cm; }

            img{
                height: 80px;
            }

            td{
                padding-left: 5px;
                padding-right: 5px;
            }
        </style>
</head>
<body>
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
    <section class="content inbox">
        <div class="container-full">
            @for ($i = 0; $i < 2; $i++)
                <div class="" style="width: 48%;float: left;margin-top:10px; @if($i==0) margin-right:  2%; @else  margin-left:  2%; @endif " >
                    <div style="height: 130px;" >
                        <div class="row">

                            <div class="col-sm-10" style="text-align: center;">
                                <h2 style="line-height: 0.6em;font-size: 24px;">দি-অন্তরঙ্গ সঞ্চয় প্রকল্প</h2>
                                <p style="line-height: 0.6em;font-size: 14px;"> পরিচালনায়ঃ <b>{{\App\Setting::setting()->app_name}}</b></p>
                                <p style="line-height: 0.6em;font-size: 14px;"> রেজি নং-১৮৭/০১, ফোনঃ ৯০০৫০৫২</p>
                                <p style="line-height: 0.6em;font-size: 14px;">৭৪১, মনিপুর, মিরপুর, ঢাকা-১২১৬।</p>
                            </div>
                            <div class="col-sm-2" style="text-align: center">
                                @if ($i==0)
                                    <p style="line-height: 1.4em;font-size: 12px;text-decoration:underline;">অফিস কপি</p>
                                @else
                                    <p style="line-height: 1.4em;font-size: 12px;text-decoration:underline;">গ্রাহক কপি</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @php
                        $total = $transaction->amount;
                        $user = $transaction->user;
                    @endphp

                    <div class="container">

                        <div class="row">
                            <div class="col-sm-8">
                                <p style="line-height: 0.6em">নামঃ {{$user->name_bn??''}}</p>

                                <p style="line-height: 0.6em">সভ্য নংঃ   {{$user->unique_id??''}}</p>
                            </div>
                            <div class="col-sm-4">
                                <p  style="line-height: 0.6em">তারিখঃ  {{App\NumberConverter::en2bn(date("Y-m-d",strtotime($transaction->date)))}}</p>
                            </div>
                        </div>
                    </div>

                    <table style="font-size: 16px;margin-top: 4px;border: 1px solid #0c0c0c; width:100%">
                        <thead>
                        <tr>
                            <th  style="width: 70%;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">বিবিধ</th>
                            <th style="width:30%;text-align: center;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">টাকা </th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">{{$transaction->head->name??''}}</td>
                                <td style="text-align: right;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> ৳ {{App\NumberConverter::en2bn($transaction->amount)}}</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">বিবিধ</td>
                                <td style="text-align: right;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">৳ {{App\NumberConverter::en2bn(0)}}</td>
                            </tr>
                            <tr>
                                <td class="text-right" style="border-bottom: 1px solid #0c0c0c;border-collapse: collapse;"> মোট</td>
                                <td style="text-align: right;border-bottom: 1px solid #0c0c0c;border-collapse: collapse;">৳ {{App\NumberConverter::en2bn($total)}}</td>
                            </tr>
                        </tbody>

                    </table>

                    <address>
                        <br>
                        <br>
                        <strong>তথ্যঃ</strong> {{$transaction->note}}
                    </address>
                </div>

            @endfor



            <div style="clear: both;"></div>


            <div class="row clearfix  no-print">

                <br>

                <div class="col-md-12 text-center">

                    <button class="btn btn-primary" onclick="window.print()"><i class="zmdi zmdi-print"></i> Print</button>

                </div>

            </div>
        </div>
    </section>


</body>
</html>
