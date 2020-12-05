<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" media="screen,print">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
    body {
        margin-top: 20px;
    }
    body .container{
        height: 400px;
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
    </style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="text-center">
                        <h3>{{\App\Setting::setting()->app_name}}</h3>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong>Office</strong>
                            <p > রেজি নং-১৮৭/০১, ফোনঃ ৯০০৫০৫২</p>
                            <p>৭৪১, মনিপুর, মিরপুর, ঢাকা-১২১৬।</p>
                        </address>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <em>Date: 1st November, 2013</em>
                        </p>
                        <p>
                            <em>Receipt #: 34522677W</em>
                        </p>
                    </div>
                </div>
                <div class="row">
                    </span>
                    <table class="table table-hover">
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
                    </table>
                    <button type="button" onclick="window.print()" class="btn btn-success btn-lg btn-block no-print">
                        Print <span class="glyphicon glyphicon-chevron-right"></span>
                    </button></td>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
