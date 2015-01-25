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
if(isset($_POST['submitAddOns']))
{
	if(isset($_POST['addOnSelect']))
	{
		
		$addOns = $_POST['addOnSelect'];		
		foreach($addOns as $addOn)
		{
			$sql1 = "Select * from AddOnProducts where productId =".$addOn.";";
			$res1 = mysql_query($sql1);
			while($row1 = mysql_fetch_array($res1))
			{
				$productId =  $row1['productId'];
				$pickupDate = strtotime($_SESSION['pickupDate']);
				$returnDate = strtotime($_SESSION['returnDate']);
				$dateDiff = $returnDate - $pickupDate;
				$noOfDays = floor($dateDiff/(60*60*24));
				$productPrice = $row1['productPrice'];
				$totalCost = $noOfDays * $productPrice;
				$sql="Select * from CustomerCarts WHERE customerUsername='".$_SESSION['username']."' and productId=".$productId." and fromDate='".$_SESSION['pickupDate']."' and toDate='".$_SESSION['returnDate']."' and productType = 'AddOn';";
				$res = mysql_query($sql);
				if(!$row = mysql_fetch_array($res))
				{
					$sql2="Insert into CustomerCarts values(NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$productId.", ".$productPrice.", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'AddOn')";
					mysql_query($sql2);
				}
			}
		}
	}
}
echo'
<html>
	<head>
		<title>Cart Main Page</title>
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
		<div id="addOnProducts" name="addOnProducts" class="reportDiv" style="width:80%;background:#ffffff;margin:0 auto;">
			<table width="100%">
				<tr>
					<td width="15%"><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width="20%"></td>
					<td width="20%">Continue Shopping:</td>
					<td width="45%"><form action="mainPage.php" method="post"><input type="submit" name="backToMainPage" value="Continue Shopping" class="button" style="align:center; display: block; margin: 0 auto;"></form></td>
				</tr>
			</table>
		<form name = "addOnProductForm" action = "cartMain.php" onsubmit="return validateAddOnProductForm()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%;padding-right:10%">
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
					
			$sql3 = "Select * from CustomerCarts WHERE customerUsername='".$_SESSION['username']."';";
			$res3 = mysql_query($sql3);
			$totalCost = 0;
			while($row3 = mysql_fetch_array($res3))
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
					<td width="20%"><form action="checkoutMain.php" method="post" onsubmit="return checkIfCartEmpty()"><input type="submit" name="checkout" value="Checkout" class="button" style="align:center; display: block; margin: 0 auto;"></form></td>
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
			
   				
			$.ajax({
      		url: "deleteCartItem.php?cartEntryId="+cartEntryId,
      		success: function(data) {
      			var cartIdArray = data.split(",");
      			for(i=0;i<cartIdArray.length;i++)
      			{
					document.getElementById("cart"+cartIdArray[i]).style.display="none";
					$.ajax({
      				url: "updateCartTotalPrice.php",
      				success: function(data2) {
						$("#totalCostOfCart").html(data2);	
      				}
   					});	
      			}
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