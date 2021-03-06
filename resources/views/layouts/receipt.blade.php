<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" media="screen,print">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
    body {
        margin-top: 20px;
    }
    body .container{
        height: 350px;
    }


    @media print
        {
            .no-print
            {
                display: none !important;
            }

            #printContainer{
                float: left !important;
            }
        }

        @page { margin: 0; }
        body { margin: 1cm; }



        .barcode{
            height: 60px !important;
            width: 100% !important;
        }
    </style>

</head>
<body>
    <div class="container" id="printContainer" style="width: 350px">
        @yield('content')
    </div>

</body>
</html>
