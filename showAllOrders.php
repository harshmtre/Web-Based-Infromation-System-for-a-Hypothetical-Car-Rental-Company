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
	die("Could not connect to the database...");
}
mysql_select_DB('carRentalDB',$con);
echo'
<html>
	<head>
		<title>Customer Profile</title>
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
		<div id="customerDetails" name="customerDetails" class="reportDiv" style="width:80%;background:#ffffff;margin:0 auto;">
			<table width="100%">
				<tr>
					<td><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
			<table width = 100%>
				<tr>
					<th style="text-align: center">Orders</th>
				</tr>
			</table>';
		$sql = "Select * from Orders where customerUsername = '".$_SESSION['username']."';";
		$res = mysql_query($sql);
		if(!$res)
		{
			echo'
			<table width = 100%>
				<tr>
					<td style="text-align: center">You have no orders till date.</td>
				</tr>
			</table>';
		}
		while($row = mysql_fetch_array($res))
		{
			$orderId = $row['orderId'];
			echo'
			<table width="100%">
				<tr>
					<th width = "25%">Order Date:'.$row['orderDate'].'</th>
					<th width = "20%">Total Cost:'.$row['totalCost'].'</th>	
					<th width = "40%">Shipping Adress:'.$row['shippingAddress'].'</th>
					<td width = "15%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="showOrderDetails('.$orderId.');">Show Details</button></td>
				</tr>	
			</table>
			';	
			$sql2 = "Select * from ProductsOrdered where orderId = ".$orderId.";";
			$res2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($res2))
			{
				$productId = $row2['productId'];
				$productType = $row2['productType'];
				if($productType == "Car")
				{
					$sql3 = "Select * from Cars where carId = ".$productId.";";
					$res3 = mysql_query($sql3);
					while($row3 = mysql_fetch_array($res3))
					{
						echo'
						<table width="100%"  name='.$orderId.' class="details">
							<tr>
								<td width = "25%">'.$row3['carManufacturer'].' '.$row3['carModel'].'</td>
								<td width = "25%">Cost:'.$row2['productPrice'].'</td>	
								<td width = "25%">From:'.$row2['fromDate'].'</td>
								<td width = "25%">To:'.$row2['toDate'].'</td>
							</tr>	
						</table>
						';
					}
				}
				else
				{
					$sql3 = "Select * from AddOnProducts where productId = ".$productId.";";
					$res3 = mysql_query($sql3);
					while($row3 = mysql_fetch_array($res3))
					{
						echo'
						<table width="100%" name='.$orderId.' class="details">
							<tr>
								<td width = "25%">'.$row3['productName'].' '.$row3['carModel'].'</td>
								<td width = "25%">Cost:'.$row2['productPrice'].'</td>	
								<td width = "25%">From:'.$row2['fromDate'].'</td>
								<td width = "25%">To:'.$row2['toDate'].'</td>
							</tr>	
						</table>
						';
					}
				}
			}
		}
		echo'	
			<table>
				<tr>
					<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>
				</tr>
			</table>
		</div>
	</body>
	<script>
		$(".details").hide();
		function showOrderDetails(orderId)
		{
			$(".details").hide();
			$("[name="+orderId+"]").show();
		}
	</script>
</html>';
?>			