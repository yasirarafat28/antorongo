<!DOCTYPE html>
<html>
<head>
	<title>Point Withdrawal Receipt</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		#invoice-POS{
			  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
			  padding:2mm;
			  margin: 0 auto;
			  width: 84mm;
			  background: #FFF;
			  
			  
			::selection {background: #f31544; color: #FFF;}
			::moz-selection {background: #f31544; color: #FFF;}
		}
			h1{
			  font-size: 1.5em;
			  color: #222;
			}
			h2{
			  font-size: 1.5em;
			  font-weight: 300;
			  line-height: 2em;
			}
			h3{
			  font-size: 1em;
			  font-weight: 300;
			  line-height: 2em;
			}
			p{
			  font-size: .7em;
			  color: #666;
			  line-height: 1.2em;
			}
			 
			#top, #mid,#bot{ /* Targets all id with 'col-' */
			  border-bottom: 1px solid #EEE;
			}

			#top{min-height: 100px;}
			#mid{min-height: 80px;} 
			#bot{ min-height: 50px;}

			#top .logo{
			  //float: left;
				height: 60px;
				width: 60px;
				background: url('{{asset("assets/images/logo.svg")}}') no-repeat;
				background-size: 60px 60px;
			}
			.clientlogo{
			  float: left;
				height: 60px;
				width: 60px;
				background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
				background-size: 60px 60px;
			  border-radius: 50px;
			}
			.info{
			  display: block;
			  //float:left;
			  margin-left: 0;
			}
			.title{
			  float: right;
			}
			.title p{text-align: right;} 
			table{
			  width: 100%;
			  border-collapse: collapse;
			}
			td{
			  //padding: 5px 0 5px 15px;
			  //border: 1px solid #EEE
			}
			.tabletitle{
			  //padding: 5px;
			  font-size: .5em;
			  background: #EEE;
			}
			.service{border-bottom: 1px solid #EEE;}
			.item{width: 24mm;}
			.itemtext{font-size: .8em;}

			#legalcopy{
			  margin-top: 5mm;
			}
	</style>
</head>
<body>

  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>{{\App\Setting::setting()->app_name}}</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            <!--Address : street city, state 0000-->
            Email   : {{\App\Setting::setting()->admin_email}}</br>
            Phone   : {{\App\Setting::setting()->admin_phone}}</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item" colspan="2"><h2>Withdrawal Description</h2></td>
                </tr>

                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Member Name</p></td>
                    <td class="tableitem"><p class="itemtext">{{$withdraw->user->name}}</p></td>
                </tr>
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Member ID</p></td>
                    <td class="tableitem"><p class="itemtext">{{$withdraw->user->unique_id}}</p></td>
                </tr>
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Date</p></td>
                    <td class="tableitem"><p class="itemtext">{{$withdraw->expected_approved_date}}</p></td>
                </tr>

                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Withdraw Point</p></td>
                    <td class="tableitem"><p class="itemtext">{{$withdraw->amount}} pts</p></td>
                </tr>
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">Withdraw Point(BDT)</p></td>
                    <td class="tableitem"><p class="itemtext">৳ {{$withdraw->amount * 10}}</p></td>
                </tr>


                <tr >
                    <td colspan="2">
                        <img src="{{url($withdraw->user->signature ?? '')}}" alt="">
                    </td>
                </tr>

            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Thank you for your business!</strong>  Payment is confirmed; please process this invoice within that time.
            </p>
        </div>

    </div><!--End InvoiceBot-->
      <div class="row">
          <br>
          <div class="col-md-2 offset-5">
              <button class="btn btn-primary" onclick="window.print()">Print</button>
          </div>
      </div>
  </div><!--End Invoice-->


</body>
</html>
