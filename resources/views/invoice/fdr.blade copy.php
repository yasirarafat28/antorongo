
@extends('layouts.receipt')
@section('content')
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="text-center">
                    <h3>{{\App\Setting::setting()->app_name}}</h3>
                    <p style="line-height: 0.6em;font-size: 14px;"> রেজি নং-১৮৭/০১, ফোনঃ ৯০০৫০৫২</p>
                    <p style="line-height: 0.6em;font-size: 14px;">৭৪১, মনিপুর, মিরপুর, ঢাকা-১২১৬।</p>
                </div>
                <div class="col-sm-6">
                    <address>
                        <h4>
                            <strong>সদস্য </strong>
                        </h4>
                        <p > <strong>সভ্য নংঃ </strong> {{$fdr->user->unique_id??''}}</p>
                        <div>
                            @php
                            $unique_id  = $fdr->user->unique_id??'';
                            @endphp
                            {!!barcode($unique_id)!!}
                        </div>
                    </address>

                </div>
                <div class="col-sm-6">
                    <address>
                        <h4>
                            <strong>এফ ডি আর</strong>
                        </h4>
                        <p>
                            <em>Date: {{date('d M, Y',strtotime($fdr->started_at))}}</em>
                        </p>
                        <div>
                            @php
                                $unique_id  = $fdr->txn_id??'';

                            @endphp
                            {!!barcode($unique_id)!!}
                        </div>
                    </address>

                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>

                        <br>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 40%">নামঃ</td>
                                    <td class="text-left">{{$fdr->user->name_bn}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">পিতার নামঃ</td>
                                    <td class="text-left">{{$fdr->user->father_name}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">ফোনঃ</td>
                                    <td class="text-left">{{$fdr->user->phone??''}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">বর্তমান ঠিকানাঃ</td>
                                    <td class="text-left">{{$fdr->user->present_address??''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">



                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="width: 40%">
                                    ধরন :
                                </td>
                                <td class="text-left">
                                    @if($fdr->profit_type=='daily')
                                        দৈনিক
                                    @elseif($fdr->profit_type=='weekly')
                                        মাসিক
                                    @else
                                        বাৎসরিক
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td  style="width: 40%">
                                    পলিসির পরিমান  :
                                </td>
                                <td class="text-left">
                                    {{\App\NumberConverter::en2bn($fdr->amount)}} টাকা
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%">
                                    অবস্থা :
                                </td>
                                <td class="text-left">
                                    {{$fdr->status}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                </span>
                <!--<table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em>Baked Rodopa Sheep Feta</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 2 </td>
                            <td class="col-md-1 text-center">$13</td>
                            <td class="col-md-1 text-center">$26</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Lebanese Cabbage Salad</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 1 </td>
                            <td class="col-md-1 text-center">$8</td>
                            <td class="col-md-1 text-center">$8</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Baked Tart with Thyme and Garlic</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 3 </td>
                            <td class="col-md-1 text-center">$16</td>
                            <td class="col-md-1 text-center">$48</td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong>$6.94</strong>
                            </p>
                            <p>
                                <strong>$6.94</strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>$31.53</strong></h4></td>
                        </tr>
                    </tbody>
                </table>-->
                <button type="button" onclick="window.print()" class="btn btn-success btn-lg btn-block no-print">
                    Print <span class="glyphicon glyphicon-chevron-right"></span>
                </button></td>
            </div>
        </div>
    </div>

@endsection