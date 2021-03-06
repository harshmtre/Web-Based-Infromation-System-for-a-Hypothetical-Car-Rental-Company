<?php
echo'
<html>
	<head>
		<title>Customer Profile</title>
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
			</table>
			<table width = 100%>
				<tr>
					<th>Orders</th>
				</tr>
			</table>';
		if(!$resultSet["resultSet"])
		{
			echo'
			<table width = 100%>
				<tr>
					<td>You have no orders till date.</td>
				</tr>
			</table>';
		}
		while($row = mysql_fetch_array($resultSet["resultSet"]))
		{
			$orderId = $row['orderId'];
			echo'
			<table width="100%">
				<tr>
					<th width = "40%">Order Date:'.$row['orderDate'].'</th>
					<th width = "20%">'.$row['totalCost'].'$</th>
					<td width = "40%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="showOrderDetails('.$orderId.');">Details</button></td>
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
								<td width = "40%">'.$row3['carManufacturer'].' '.$row3['carModel'].'</td>
								<td width = "20%">'.$row2['productPrice'].'$</td>	
								<td width = "40%">'.$row2['fromDate'].' to '.$row2['toDate'].'</td>
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
								<td width = "40%">'.$row3['productName'].'</td>
								<td width = "20%">'.$row2['productPrice'].'$</td>	
								<td width = "40%">'.$row2['fromDate'].' to '.$row2['toDate'].'</td>
							</tr>	
						</table>
						';
					}
				}
			}
		}
		echo'	
			<table width="100%">
				<tr>
					<td><button type="button" data-theme="b" onclick="history.go(-1);">Go Back</button></td>
				</tr>
			</table>
		</div>
	<script>
		$(".details").hide();
		function showOrderDetails(orderId)
		{
			$(".details").hide();
			$("[name="+orderId+"]").show();
		}
	</script>
	</body>
</html>';
?>