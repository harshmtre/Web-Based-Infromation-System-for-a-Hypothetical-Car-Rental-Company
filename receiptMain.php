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
if(!$con)
{
	die('Could not connect to the database');
}	
mysql_select_db('carRentalDB',$con);
$date = date('Y-m-d');
$sql1 = "Insert into Orders values (NULL, '".$_SESSION['username']."', '".$date."', ".$_POST['totalCost'].", '".$_POST['customerBillingAddress']."', '".$_POST['customerAddress']."')";
mysql_query($sql1);
$sql2 = "Select MAX(orderId) as 'maxOrderId' from Orders";
$res2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($res2))
{
	break;
}

$orderId = $row2['maxOrderId'];
$sql3 = "Select * from CustomerCarts where customerUsername = '".$_SESSION['username']."'";
$res3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($res3))
{
	$sql4 = "Insert into ProductsOrdered values (NULL, ".$orderId.", ".$row3['productId'].", ".$row3['totalCost'].", '".$row3['productType']."', '".$row3['fromDate']."', '".$row3['toDate']."')";
	mysql_query($sql4);
}
$sql5 = "Delete from CustomerCarts WHERE customerUsername='".$_SESSION['username']."';";
mysql_query($sql5);
$sql6 = "Select * from ProductsOrdered Where orderId = ".$orderId." AND productType = 'Car';";
$res6 = mysql_query($sql6);
if(!$res6)
{
	//Do Nothing
}
else
{
	while($row6 = mysql_fetch_array($res6))
	{
		$sql7 = "Select * from ProductsOrdered Where orderId = ".$orderId." AND productType = 'AddOn';";
		$res7 = mysql_query($sql7);
		if(!$res7)
		{
			//do nothing
		}
		else
		{
			while($row7 = mysql_fetch_array($res7))
			{
				$carId = $row6['productId'];
				$addOnId = $row7['productId'];
				$sql8 = "Select * from CarsAddOns WHERE carId= ".$carId." AND addOnId= ".$addOnId.";";
				$res8 = mysql_query($sql8);
				if(!($row8 = mysql_fetch_array($res8)))
				{
					$sql9 = "Insert Into CarsAddOns values (NULL, ".$carId.", ".$addOnId.", 1)";
					mysql_query($sql9);
				}
				else
				{
					$sql9 = "Update CarsAddOns set count = ".($row8['count']+1)." WHERE carId= ".$carId." AND addOnId= ".$addOnId.";";
					mysql_query($sql9);
				}
			}
		}
	}
}
echo'
<html>
	<head>
		<title>Receipt</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
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
		<div id="receiptDiv" name="receiptDiv" class="reportDiv" style="width:80%;background:#ffffff;margin:0 auto;">
			<table width = "100%">
				<tr>
					<td><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td>Thank You For Reserving With Rent A Car</td>
				</tr>
				<tr>
					<td>Your Reservation has been completed Successfully.</td>
				</tr>
				<tr>
					<td><form name="backToMainPage" action="mainPage.php" method="post"><input type="submit" name="backToMain" value="Go To Main Page" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
		</div>
	</body>
</html>';		
?>