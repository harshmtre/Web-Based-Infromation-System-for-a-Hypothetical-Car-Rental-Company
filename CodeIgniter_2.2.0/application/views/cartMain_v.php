<?php

echo'
<html>
	<head>
		<title>Cart Main Page</title>
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
			<table width="100%">
				<tr>
					<td width="15%"><form action="http://cs-server.usc.edu:9046/CSCI571HW/logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width="20%"></td>
					<td width="20%">Continue Shopping:</td>
					<td width="45%"><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c" method="post"><input type="submit" name="backToMainPage" value="Continue Shopping" class="button" style="align:center; display: block; margin: 0 auto;"></form></td>
				</tr>
			</table>
		<form name = "addOnProductForm" action = "http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/cartMain_c" onsubmit="return validateAddOnProductForm()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%;padding-right:10%">
		<div id="cart0" name ="cart0">
			<table width="100%">
				<tr>
					<th width="25%">Product</th>
					<th width="15%">Dates</th>
					<th width="15%">Number Of Days</th>
					<th width="15%">Cost Per Day</th>
					<th width="15%">Total Cost</th>
					<th width="15%"><th>
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
					<td width="25%">'.$productName.'</td>
					<td width="15%">'.$row3['fromDate'].' - '.$row3['toDate'].'</td>
					<td width="15%">'.$row3['numberOfDays'].'</td>
					<td width="15%">'.$row3['productPrice'].'</td>
					<td width="15%">'.$totalCostOfItem.'</td>
					<td width="15%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="deleteCartItem('. $cartEntryId .')">Delete</button><td>
				</tr>
				';
				$totalCost = $totalCost + $totalCostOfItem;
			} 
			echo'
			</table>	
		</div>	
			<table width="100%">
				<tr>
					<td width="15%">Delete All items from the Cart:</td>
					<td width="15%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="deleteCartItem(0)">Delete</button></td>
					<td width="40%"></td>
					<td width="20%">Total Cost Of All Items in the Cart:</td>
					<td width="10%" id="totalCostOfCart">$'.$totalCost.'</td>
				</tr>
			</table>
		</form>
			<table width="100%">
				<tr>
					<td width="15%"></td>
					<td width="20%">Proceed to Checkout:</td>
					<td width="20%"><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/checkoutMain_c" method="post" onsubmit="return checkIfCartEmpty()"><input type="submit" name="checkout" value="Checkout" class="button" style="align:center; display: block; margin: 0 auto;"></form></td>
					<td width="45%"></td>
				</tr>
			</table>
		</div>
	</body>
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
      				}
   					});	
      			}
  			});
			
   			
  		}
	}
	function checkIfCartEmpty()
	{
		if($("#totalCostOfCart").html() == "$0")
		{
			alert("Your Cart is Empty!")
			return false;
		}
		else 
			return true;
	}
	</script>
</html>		
';

?>