<?php

while($row1 = mysql_fetch_array($resultSet1['resultSet1']))
{
	break;
}
while($row2 = mysql_fetch_array($resultSet2['resultSet2']))
{
	break;
}
$totalCost = 0;
if(!$row = mysql_fetch_array($resultSet['resultSet']))
{
	//Do nothing
}
else
{
	$totalCost = $totalCost + $row['totalCost'];
	while($row = mysql_fetch_array($resultSet['resultSet']))
	{
		$totalCost = $totalCost + $row['totalCost'];
	}
}
echo'
<html>
	<head>
		<title>Checkout Page</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		<style>
			body {background-image: url("http://cs-server.usc.edu:9046/CSCI571HW/background.jpg"); 
			background-size: 100%; 
			font-family:Calibri ,serif;
			color:#343434;
			font-size:15px
			line-height:1.5
			}
		    .button {
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #a6a6a6));
			background:-moz-linear-gradient(top, #000000 5%, #a6a6a6 100%);
			background:-webkit-linear-gradient(top, #000000 5%, #a6a6a6 100%);
			background:-o-linear-gradient(top, #000000 5%, #a6a6a6 100%);	
			background:-ms-linear-gradient(top, #000000 5%, #a6a6a6 100%);
			background:linear-gradient(to bottom, #000000 5%, #a6a6a6 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#a6a6a6",GradientType=0);
			background-color:#000000;
			-moz-border-radius:20px;
			-webkit-border-radius:20px;
			border-radius:20px;
			border:1px solid #7a827b;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:arial;
			font-size:20px;
			padding:5px 15px;
			text-decoration:none;
			}
			.button:hover {
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #a6a6a6), color-stop(1, #000000));
			background:-moz-linear-gradient(top, #a6a6a6 5%, #000000 100%);
			background:-webkit-linear-gradient(top, #a6a6a6 5%, #000000 100%);
			background:-o-linear-gradient(top, #a6a6a6 5%, #000000 100%);
			background:-ms-linear-gradient(top, #a6a6a6 5%, #000000 100%);
			background:linear-gradient(to bottom, #a6a6a6 5%, #000000 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#a6a6a6", endColorstr="#000000",GradientType=0);
			background-color:#a6a6a6;
			}
			.button:active {
			position:relative;
			top:1px;
			}
			.tb {
			border:2px solid #343434;
			border-radius:5px;
			height: 25px;
			width: 225px;
			}
			.rotb {
			border:2px solid #A9A9A9;
			border-radius:5px;
			height: 25px;
			width: 225px;
			}
			.sb {
			border:2px solid #343434;
			border-radius:5px;
			height: 25px;
			width: 470px;
			}
			label { 
			display: inline-block; 
			width: 200px; 
			}
			.ta {
			border:2px solid #343434;
			border-radius:5px;
			}
			th {
			font: bold 11px 
			font-family: Calibri, serif;
			color: #FFFFFF;
			border-right: 1px solid #343434;
			border-bottom: 1px solid #343434;
			border-top: 1px solid #343434;
			letter-spacing: 2px;
			text-transform: uppercase;
			text-align: left;
			padding: 6px 6px 6px 12px;
			background: #343434;
			}	
		</style>		
	</head>
	<body>
		<img src="http://cs-server.usc.edu:9046/CSCI571HW/header.png">
		<div id="addOnProducts" name="addOnProducts" class="reportDiv" style="width:80%;background:#ffffff;margin:0 auto;">
		<form name = "checkoutForm" action = "http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/receiptMain_c" onsubmit="return validateCheckout()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%;padding-right:10%">
			<table width="100%">
				<tr>
					<td width = "30%">Total Amount Due:</td>
					<td width = "20%">$'.$totalCost.'</td>
					<td width = "50%"></td>
				</tr>
			</table>
			<input type="hidden" name="totalCost" id="totalCost" value="'.$totalCost.'">
			<label>Shipping Address: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerAddress" name="customerAddress" value="'.$row1["customerAddress"].'" class="tb"><br/><br/>
			<label>Name on Credit Card: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCName" name="customerCCName" value="'.$row1["customerCCName"].'" class="tb"><br/><br/>
			<label>Billing Address: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerBillingAddress" name="customerBillingAddress" value="'.$row1["customerBillingAddress"].'" class="tb"><br/><br/>
			<label>Credit Card Number: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCNumber" name="customerCCNumber" maxLength="16" value="'.$row1["customerCCNumber"].'" class="tb" onkeypress="return checkIfNumber(event)" onChange="javascript:CheckCCNumber()"><br/><br/>
			<label>CVV: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCCVV" name="customerCCCVV" maxLength="3" value="'.$row1["customerCCCVV"].'" class="tb" onkeypress="return checkIfNumber(event)" onChange="javascript:CheckCCCVV()"><br/><br/>
			<label>Credit Card Expiry Date (mm/yyyy): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCExpDate" name="customerCCExpDate" value="'.$row1["customerCCExpDate"].'" class="tb" onChange="javascript:checkCCExpDate()"><br/><br/>
			<table width="100%">
				<tr>
					<td width = "30%">Confirm Purchase:</td>
					<td width = "20%"><input type="submit" name="purchase" value="Purchase" class="button" style="align:center; display: block; margin: 0 auto;"></td>
					<td width = "50%"></td>
				</tr>
			</table>
		</form>
		</div>
	</body>
	<script>
	var CCEXP = true;
	
	var CCNUM = true;
	function CheckCCNumber()
	{
		if($("#customerCCNumber").val().length < 16)
		{
			alert("Invalid Credit Card Number. Please enter a valid Credit Card Number.");
			CCNUM = false;
		}
		else
		{
			CCNUM = true;
		}
	}
	
	var CCCVV = true;
	function CheckCCCVV()
	{
		if($("#customerCCCVV").val().length < 3)
		{
			alert("Invalid Credit Card CVV. Please enter a valid Credit Card CVV.");
			CCCVV = false;
		} 
		else
		{
			CCCVV = true;
		}
	}
	
	function checkIfNumber(keyPressed) {
    	keyPressed = (keyPressed) ? keyPressed : window.event;
	    var charCode = (keyPressed.which) ? keyPressed.which : keyPressed.keyCode;
    	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        	return false;
    	}
    	return true;
	}
	function checkCCExpDate()
	{
		var validformat=/^\d{2}\/\d{4}$/; //Basic check for format validity
		var returnval=false;
		if (!validformat.test($("#customerCCExpDate").val()))
		{
			CCEXP = false;
			alert("Invalid Date Format. Please correct the date.");
			return false;
		}	
		else
		{ 
			var monthfield=$("#customerCCExpDate").val().split("/")[0];
			var yearfield=$("#customerCCExpDate").val().split("/")[1];
			var dayobj = new Date(yearfield, monthfield-1);
			if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getFullYear()!=yearfield))
			{
				CCEXP = false;
				alert("InvalidMonth, or Year range detected. Please correct the date.");
				return false;
			}
			else
			{
				CCEXP = true;
			}	
			if(new Date().getFullYear()>dayobj.getFullYear())
			{
				CCEXP = false;
				alert("Your Card Is No Longer Valid");
				return false;
			}
			else
			{
				CCEXP = true;
			}	
			if(new Date().getFullYear()==dayobj.getFullYear())
			{
				if(new Date().getMonth()>dayobj.getMonth())	
				{
					CCEXP = false;
					alert("Your Card Is No Longer Valid");
					return false;
				}	
				else
				{
					CCEXP = true;
				}	
			}	
		}		
	}
	function validateCheckout()
	{
		message = "Please fill in the following details before proceeding: "		
		if($("#customerAddress").val()=="")
			message = message + "Address  "
		if($("#customerCCName").val()=="")
			message = message + "Name on CC  "
		if($("#customerBillingAddress").val()=="")
			message = message + "Billing Address  "	
		if($("#customerCCNumber").val()=="")
			message = message + "CC Number  "
		if($("#customerCCCVV").val()=="")
			message = message + "CVV  "	
		if($("#customerCCExpDate").val()=="")
			message = message + "CC Expiry Date  " 
		if(message != "Please fill in the following details before proceeding: ")
  		{
  			alert(message);
  			return false;
  		}
  		else if(CCEXP == false || CCNUM == false || CCCVV == false)
  		{
  			correctionMessage = "Please correct the following details before proceeding: "
  			if(CCEXP == false)
  				correctionMessage = correctionMessage + "CC Expiry Date  "
  			if(CCNUM == false)
  				correctionMessage = correctionMessage + "CC Number  "
  			if(CCCVV == false)
  				correctionMessage = correctionMessage + "CC CVV  "
  			alert(correctionMessage);	
  			return false;
  		}				
  		else
  		{	
			return true;	
  		}	
	}
	</script>
</html>';

?>