<?php
while($row = mysql_fetch_array($resultSet))
{
	break;
}
echo'
<html>
	<head>
		<title>Main Page</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css"/>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>
			
	</head>
	<body>
		<style>
			body {background-image: url("http://cs-server.usc.edu:9046/CSCI571HW/background.jpg"); 
			background-size: 100%; 
			font-family:Calibri ,serif;
			color:#343434;
			font-size: 0.6in;
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
			font-family:Calibri ,serif;
			font-size:0.5in;
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
			font-family:Calibri ,serif;
			color:#343434;
			font-size: 30px;
			}
			.ta {
			border:2px solid #343434;
			border-radius:5px;
			}
			th {
			font: bold; 
			font-family: Calibri, serif;
			font-size:0.6in;
			color: #FFFFFF;
			border-right: 1px solid #343434;
			border-bottom: 1px solid #343434;
			border-top: 1px solid #343434;
			letter-spacing: 2px;
			text-transform: uppercase;
			text-align: center;
			padding: 6px 6px 6px 30pt;
			background: #343434;
			}
			td{
			font-family: Calibri, serif;
			font-size:0.6in;
			text-align: center;
			}	
			.ui-btn {
			font-size: 0.6in !important; 
			}
		</style>	
		<img src="http://cs-server.usc.edu:9046/CSCI571HW/header.png" width="100%">
		<div id="customerDetails" name="customerDetails" class="reportDiv" style="width:90%;background-color: rgba(255, 255, 255, 0);margin:0 auto;">
		
			<table width="100%">
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/logout.php"><input type="submit" name="logout" value="Logout" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c" method="post"><input type="submit" name="backToMainPage" value="Continue Shopping" data-theme="b"></form></td>
				</tr>
			</table>
			<table width = 100%>
				<tr>
					<th>Personal Details</th>
				</tr>
			</table>
			<table width = 100%>
				<tr><th width="30%"> Name </th><td> '.$row['customerFname'].' '.$row['customerLname'].'</td></tr>
				<tr><th width="30%"> Email </th><td> '.$row['customerEmail'].'</td></tr>
				<tr><th width="30%"> Date Of Birth </th><td> '.$row['customerDob'].'</td></tr>
				<tr><th width="30%"> Age </th><td> '.$row['customerAge'].'</td></tr>';
				$phoneNo = $row['customerPhone'];
				if($phoneNo!='')
				{
					echo'<tr><th width="30%"> Phone Number </th><td> '.$phoneNo.'</td></tr>';
				}
				echo'	
				<tr><th width="30%"> Address </th><td> '.$row['customerAddress'].'</td></tr>
			</table>
			<table width = 100%>
				<tr>
					<th style="text-align: center">Credit Card Details</th>
				</tr>
			</table>	
			<table width = 100%>	
				<tr><th width="30%"> Name On Credit Card </th><td> '.$row['customerCCName'].'</td></tr>
				<tr><th width="30%"> Billing Address </th><td> '.$row['customerBillingAddress'].'</td></tr>
				<tr><th width="30%"> Credit Card Number </th><td> '.$row['customerCCNumber'].'</td></tr>
				<tr><th width="30%"> CVV </th><td> '.$row['customerCCCVV'].'</td></tr>
				<tr><th width="30%"> Expiry Date </th><td> '.$row['customerCCExpDate'].'</td></tr>
			</table>
			<table width="100%">
				<tr>
					<td><form name="updateCustomer" action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerUpdate_c" method="post"><input type="submit" name="update" value="Update Details" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form name="updateCustomer" action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/showAllOrders_c" method="post"><input type="submit" name="update" value="Show All Orders" data-theme="b"></td>
				</tr>
				<tr>
					<td><button type="button" data-theme="b" onclick="history.go(-1);">Go Back</button></td>
				</tr>
			</table>
		</div>	
	</body>
</html>
';
?>