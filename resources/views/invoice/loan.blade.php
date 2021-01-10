
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
                <div class="col-md-12">
                    <address>
                        <h4>
                            <strong>সদস্য </strong>
                        </h4>
                        <p > <strong>সভ্য নংঃ </strong> {{$loan->user->unique_id??''}}</p>
                        <div>
                            @php
                            $unique_id  = $loan->user->unique_id??'';

                            @endphp
                            {!!barcode($unique_id)!!}
                        </div>
                        <p>{{$loan->user->name_bn}}</p>
                        <br>

                        <h4>
                            <strong>ঋণ </strong>
                        </h4>
                        <p > <strong>ঋণ নংঃ </strong> {{$loan->unique_id??''}}</p>
                        <p>
                            <em>Date: {{date('d M, Y',strtotime($loan->started_at))}}</em>
                        </p>
                        <div>
                            @php
                                $unique_id  = $loan->unique_id??'';
                            @endphp
                                {!!barcode($unique_id)!!}
                        </div>

                    </address>
                </div>
            </div>
            <div class="row">
                </span>

                <button type="button" onclick="window.print()" class="btn btn-success btn-lg btn-block no-print">
                    Print <span class="glyphicon glyphicon-chevron-right"></span>
                </button></td>
            </div>
        </div>
    </div>

@endsection
