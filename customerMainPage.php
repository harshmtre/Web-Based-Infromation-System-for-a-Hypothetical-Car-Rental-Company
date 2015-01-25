<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/customerLogin.php");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/customerLogin.php");
	}
}
$con = mysql_connect('localhost','root','909Cuppy');
$sql = 'Select * from Customers where username = "'.$activeUser.'";'; 
if(!$con)
{
	die("Could not connect to the database...");
}
mysql_select_DB('carRentalDB',$con);
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
{
	break;
}
echo'
<html>
	<head>
		<title>Customer Profile</title>
		<style>
			body {background-image: url("background.jpg"); 
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
		<img src="header.png">
		<div id="customerDetails" name="customerDetails" class="reportDiv" style="width:80%;background:#ffffff;margin:0 auto;">
		
			<table width="100%">
				<tr>
					<td width="15%"><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width="20%"></td>
					<td width="20%">Continue Shopping:</td>
					<td width="45%"><form action="mainPage.php" method="post"><input type="submit" name="backToMainPage" value="Continue Shopping" class="button" style="align:center; display: block; margin: 0 auto;"></form></td>
				</tr>
			</table>
			<table width = 100%>
				<tr>
					<th style="text-align: center">Personal Details</th>
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
			<table>
				<tr>
					<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>
					<td><form name="updateCustomer" action="customerUpdate.php" method="post"><input type="submit" name="update" value="Update Details" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td><form name="updateCustomer" action="showAllOrders.php" method="post"><input type="submit" name="update" value="Show All Orders" class="button" style="display: inline; margin: 0 auto;"></td>
				</tr>
			</table>
		</div>	
	</body>
</html>
';
?>