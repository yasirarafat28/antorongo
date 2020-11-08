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
                        <?php
                        $barcontent = peal\barcodegenerator\Facades\BarCode::barcodeFactory("BarCode")
                            ->renderBarcode(
                                $filepath ='',
                                $text="HelloHello",
                                $size='50',
                                $orientation="horizontal",
                                $code_type="code39", // code_type : code128,code39,code128b,code128a,code25,codabar
                                $print=false,
                                $sizefactor=1
                            );

                        ?>
                        <img src="{{$barcontent}}" alt="">

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


