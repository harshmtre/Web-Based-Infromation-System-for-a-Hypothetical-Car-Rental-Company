<?php

echo'
<html>
	<head>
		<title>Cart Main Page</title>
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
		<div id="addOnProducts" name="addOnProducts" class="reportDiv" style="width:90%;background-color: rgba(255, 255, 255, 0);margin:0 auto;">
			<table width="100%">
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/logout.php"><input type="submit" name="logout" value="Logout" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c" method="post"><input type="submit" name="backToMainPage" value="Continue Shopping" data-theme="b"></form></td>
				</tr>
			</table>
		<form name = "addOnProductForm" action = "http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/cartMain_c" onsubmit="return validateAddOnProductForm()" method="post" style="padding-top:2.5%;padding-bottom:2.5%;">
			<table width="100%" id="cart0">
				<tr>
					<th width="20%">Name</th>
					<th width="30%">Dates</th>
					<th width="20%">Total Cost</th>
					<th width="30%"></th>
				</tr>
			';
			$totalCost = 0;
			while($row3 = mysql_fetch_array($resultSet['resultSet']))
			{
				if($row3['productType'] == 'Car')
				{
					$sql4 = "Select * from Cars Where carId = ".$row3['productId'].";";
					$res4 = mysql_query($sql4);
					while($row4 = mysql_fetch_array($res4))
					{
						break;
					}
					$productName = "".$row4['carManufacturer']." ".$row4['carModel']."";
				}
				else
				{
					$sql4 = "Select * from AddOnProducts Where productId = ".$row3['productId'].";";
					$res4 = mysql_query($sql4);
					while($row4 = mysql_fetch_array($res4))
					{
						break;
					}
					$productName = "".$row4['productName']."";
				}
				$cartEntryId = $row3['cartEntryId'];
				$totalCostOfItem = $row3['totalCost'];
				echo'
				<tr id="cart'.$cartEntryId.'">
					<td width="30%">'.$productName.'</td>
					<td width="30%">'.$row3['fromDate'].' - '.$row3['toDate'].'</td>
					<td width="20%">'.$totalCostOfItem.'</td>
					<td width="20%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="deleteCartItem('. $cartEntryId .')">Delete</button><td>
				</tr>
				';
				$totalCost = $totalCost + $totalCostOfItem;
			} 
			echo'
			</table>	
			<table width="100%">
				<tr>
					<td>Total Cost Of All Items in the Cart: <span id="totalCostOfCart">$'.$totalCost.'</span></td>
				</tr>
				<tr>
					<td><button type="button" data-theme="b" onclick="deleteCartItem(0)">Delete All Items</button></td>
				</tr>
			</table>
		</form>
			<table width="100%">
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/checkoutMain_c" method="post" onsubmit="return checkIfCartEmpty()"><input type="submit" name="checkout" value="Proceed to Checkout" data-theme="b"></form></td>
				</tr>
			</table>
		</div>
	<script>
	function deleteCartItem(cartEntryId)
	{
		var confirmDelete = confirm("Are you sure you want to delete the desired record(s)?");
		
		if(confirmDelete == true)
		{
			
			$.post("http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/deleteCartItem_c",
  			{
    			theCartEntryId:cartEntryId
  			},
  			function(data,status){
    			var cartIdArray = data.split(",");
      			for(i=0;i<cartIdArray.length;i++)
      			{
					$("#cart"+cartIdArray[i]).hide();
					$.ajax({
      				url: "http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/updateCartTotalPrice_c",
      				success: function(data2) {
						$("#totalCostOfCart").html(data2);
						location.reload();	
      				}
   					});	
      			}
  			});
  			if(cartEntryId == 0)
  			{
  				$("#cart0").hide();
  			}
			
   			
  		}
	}
	function checkIfCartEmpty()
	{
		if('.$totalCost.' == 0)
		{
			alert("Your Cart is Empty!")
			return false;
		}
		else 
			return true;
	}
	</script>
	</body>
</html>		
';

?>