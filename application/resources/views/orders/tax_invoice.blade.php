<!Doctype html>
<html>
<head>
	<title>Tax Invoice</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/images/favicon.svg') }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
	body {
		font-family: Times New Roman;
		margin: 30px;
	}
	* {
		box-sizing: border-box
	}
	input[type=text], input[type=password], input[type=date] {
	  width: 100%;
	  display: inline-block;
	  border: none;
	  background: #f1f1f1;
	}

	input[type=text]:focus, input[type=password]:focus {
	  background-color: #ddd;
	  outline: none;
	}

	hr {
	  border: 1px solid #008074;
	  margin-bottom: 25px;
	}
	button {
	  background-color: #4CAF50;
	  color: white;
	  padding: 14px 20px;
	  margin: 8px 0;
	  border: none;
	  cursor: pointer;
	  width: 100%;
	  opacity: 0.9;
	}

	button:hover {
	  opacity:1;
	}
	.container {
	  padding: 16px;
	}
	.clearfix::after {
	  content: "";
	  clear: both;
	  display: table;
	}
	@media screen and (max-width: 300px) {
	  .cancelbtn, .signupbtn {
		 width: 100%;
	  }
	}

	.tr
	{
		height:1px;
		position: relative;
		height:1px;
	}
	tbody {
	  height: 5px;
	  overflow-y:auto;
	  overflow-x:hidden;
	}
	tbody td {
		background: #FFF;
		border-bottom: none;
		border-right: 0px solid #CCC;
		border-top: 1px solid #DDD;
		padding: 4px 3px 4px 4px;
		height:1px;
	}
</style>
</head>
<body>
        <div>  <a href="{{ url()->previous() }}" class="btn btn-info">Back</a></div>
      
        <div>
		<div class="col-md-12"><a style="float:right;padding:8px;margin:-25px 45px 0px 0px;" class="btn btn-success" onclick="printDiv('mydiv')"><i class="fa fa-print" aria-hidden="true"></i> Print</a></div>
		<br>
        <div class="container" style="border: solid #b3b7c3 1px;margin-top:0%;" id="mydiv">
			<img src="{{ asset('admin/assets/images/logo.png')}}"height="60px" width="200px"alt="logo">
			<center>
            <p style="font-size:16px;margin-top:-70px;"><b>FINLEY ASIA PVT.LTD</b>
				 <br>E-29 Sector-63 Noida-201301
				 <br><b>GSTIN:</b>33AAVGS9012N1ZP</p></center>
			<hr>
            <h4 align="center" style="font-size:13px;margin-top:-0.3%"><b>TAX INVOICE</b></h4>
            <table class="table table-bordered" style="margin-top:-0.5%">
            <tbody>
              <tr class="tr">  
             <td style="width:35%">
            <p style="font-size:14px;"><b>Details Of Receiver(Billed To)</b> 
			<br>FINLEY ASIA PVT.LTD
			<br>E-29 Sector-63 Noida-201301
            <br><b>GSTIN:</b>33AAVGS9012N1ZP    
		   </td>
              
            <td style="width:35%">
            <p  style="font-size:14px;"><b>Details Of Consignee(Shipped To)</b>
			<br>
			   Rajesh Kumar
			<br>Pryagraj Utter Pradesh-2215602</p>
              </td>
			   <td style="width:30%">
            <br>
            <p style="font-size:14px;"><b>Invoice Date:&nbsp;&nbsp;</b>06-10-2023
			<br><b>Invoice No: &nbsp;&nbsp;&nbsp;</b>#00003442
            <br><b>Payment Status:&nbsp;&nbsp;</b>Order Made</p>
			
              </td>
            </tr>
            </tbody>
            </table>

            <!--<div class="col-md-12">-->
			 <table class="" style="margin-top:0%;width:100%;border:1px solid lightgrey">
				  <thead style="margin-top:-2%;height:2%;" class="tr">
					 <th  style="font-size:14px;text-align:center;">S.No.</th>
					 <th  style="font-size:14px;text-align:center;">Description Of Product</th>
					 <th  style="font-size:14px;text-align:center;">Qty</th>
					 <th  style="font-size:14px;text-align:center;">Price</th>
					 <th  style="font-size:14px;text-align:center;">Amount</th>
				 </thead>
				 <tbody style="height:1px;">
				 
					  <tr style="margin-top:-2%;">
						 <td  style="font-size:14px;height:1px;text-align:center;">1</td>
						 <td  style="font-size:14px;text-align:center;">Product Name </td>
						 <td  style="font-size:14px;text-align:center;">1</td>
						 <td  style="font-size:14px;text-align:center;">₹ 300000</td>
						 <td  style="font-size:14px;text-align:center;">₹ 300000</td>
					 </tr> 
				</tbody>
			 </table>
				 
			<table class="table table-bordered" style="margin-top:1%">
			<tbody>
			<tr class="tr">  
			<td style="width:40%" ><p style="font-size:14px;"><b>Total Invoice Value(In Word)</b><br>
			<?php $number = 206500.00;
			   $no = floor($number);
			   $point = round($number - $no) * 100;
			   $hundred = null;
			   $digits_1 = strlen($no);
			   $i = 0;
			   $str = array();
			   $words = array('0' => '', '1' => 'one', '2' => 'two',
				'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
				'7' => 'seven', '8' => 'eight', '9' => 'nine',
				'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
				'13' => 'thirteen', '14' => 'fourteen',
				'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
				'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
				'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
				'60' => 'sixty', '70' => 'seventy',
				'80' => 'eighty', '90' => 'ninety');
			   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
			   while ($i < $digits_1) {
				 $divider = ($i == 2) ? 10 : 100;
				 $number = floor($no % $divider);
				 $no = floor($no / $divider);
				 $i += ($divider == 10) ? 1 : 2;
				 if ($number) {
					$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
					$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
					$str [] = ($number < 21) ? $words[$number] .
						" " . $digits[$counter] . $plural . " " . $hundred
						:
						$words[floor($number / 10) * 10]
						. " " . $words[$number % 10] . " "
						. $digits[$counter] . $plural . " " . $hundred;
				 } else $str[] = null;
			  }
			  $str = array_reverse($str);
			  $result = implode('', $str);
			  $points = ($point) ?
				"." . $words[$point / 10] . " " . 
					  $words[$point = $point % 10] : '';
			  echo "<br>"."Rs- ".strtoupper($result) . " " . strtoupper($points);?>
			</p></td>   
			<td style="width:60%">
			<p style="font-size:14px;"><b>Tax:&nbsp;&nbsp;&nbsp;</b><span style="float:right">--</span></p><br>
			<p style="font-size:14px;"><b>Discount:&nbsp;&nbsp;&nbsp;</b><span style="float:right">--</span></p><br>
			<p style="font-size:14px;"><b>Total Amount:&nbsp;&nbsp;&nbsp;<span style="float:right"> ₹ 206500.00</span></b></p>
			</td></tr>
			</tbody>
			</table>
			<table class="table table-bordered" style="margin-top:-0.5%">
            <tbody>
            <tr class="tr">  
            <td style="width:35%" >
            <p style="font-size:14px;"><b>Contact Information</b> 
			<br>Account Team:
			<br>+91 XXXX012345
            <br>info@finley.asia.com   
			</td>
              
            <td style="width:35%">
            <p  style="font-size:14px;"><b>Payment Details(Pay To)</b>
			<br><b>Bank Name:</b>&nbsp;&nbsp; XYZ Bank
			<br><b>Name:</b>&nbsp;&nbsp;&nbsp; FINLEY ASIA PVT.LTD
			<br><b>A/c No:</b>&nbsp; &nbsp; &nbsp;&nbsp; XXXXXXXXXXXXX
			<br><b>IFSC Code:</b>&nbsp;&nbsp;&nbsp; XXXX012345
			</p>
              </td>
			   <td style="width:30%;text-align:center">
			 <p  style="font-size:14px;margin-top:65px">(Authorised Signatory)</p>
              </td>
            </tr>
            </tbody>
            </table>
           <table class="table table-bordered" style="margin-top:-0.5%">
           <tbody>
            <tr class="tr">  
            <td style="width:35%" ><p style="font-size:14px;">1.Please pay cheque/draft in favor of  FINLEY ASIA PVT.LTD.
			  <br>2. Price And Validity will be revised as per market rule and regulation.
			  <br>3. if service unused invoice will be auto cancelled after 30 days.
			  <br>4. This is a computer generated invoice. No signature is required.</p></td>
		    </tr>
            </tbody>
            </table>
          </div>
      </div>

</body>
</html>

<script>
function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;
	 document.body.innerHTML = printContents;
	 window.print();
	 document.body.innerHTML = originalContents;
}
</script>