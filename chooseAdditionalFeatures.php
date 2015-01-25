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
$sql1 = "Select * from Cars WHERE carId=".$_SESSION['selectedCar'].";";
$res1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($res1))
{
	break;
}
$pickupDate = strtotime($_POST['pickupDate']);
$returnDate = strtotime($_POST['returnDate']);
$dateDiff = $returnDate - $pickupDate;
$noOfDays = floor($dateDiff/(60*60*24));
$productPrice = $row1['carPrice'];
$totalCost = $noOfDays * $productPrice;
$sql="Select * from CustomerCarts WHERE customerUsername='".$_SESSION['username']."' AND productType='Car' AND (fromDate<='".$_POST['pickupDate']."' AND toDate>='".$_POST['pickupDate']."') OR (fromDate<='".$_POST['returnDate']."' AND toDate>='".$_POST['returnDate']."');";
$res = mysql_query($sql);
if(!$row = mysql_fetch_array($res))
{
	$sql3="Select orderId from Orders WHERE customerUsername='".$_SESSION['username']."';";
	$res3 = mysql_query($sql3);
	if(!$row3 = mysql_fetch_array($res3))
	{
		$sql5 = "Select carCategoryId from Cars where carId=".$_SESSION['selectedCar'].";";
		$res5 = mysql_query($sql5);
		while($row5 = mysql_fetch_array($res5))
		{
			$sql6 = "Select * from SpecialSales where specialSalesProductCatId=".$row5['carCategoryId']." AND specialSalesStartDate<='".$_SESSION['pickupDate']."' AND specialSalesEndDate>='".$_SESSION['returnDate']."';";
			$res6 = mysql_query($sql6);
			if(!$row6 = mysql_fetch_array($res6))
			{
				$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";
			}
			else
			{
					$totalCost = $totalCost - (($row6['specialSalesDiscountPercent']/100) * $totalCost);
					$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";

			}	
		}
		mysql_query($sql2);
	}
	else
	{
			$sql4="Select * from ProductsOrdered WHERE orderId=".$row3['orderId']." AND productType='Car' AND ((fromDate<='".$_POST['pickupDate']."' AND toDate>='".$_POST['pickupDate']."') OR (fromDate<='".$_POST['returnDate']."' AND toDate>='".$_POST['returnDate']."'));";
			$res4= mysql_query($sql4);
			if(!$row4 = mysql_fetch_array($res4))
			{
				$sql5 = "Select carCategoryId from Cars where carId=".$_SESSION['selectedCar'].";";
				$res5 = mysql_query($sql5);
				while($row5 = mysql_fetch_array($res5))
				{
					$sql6 = "Select * from SpecialSales where specialSalesProductCatId=".$row5['carCategoryId']." AND specialSalesStartDate<='".$_SESSION['pickupDate']."' AND specialSalesEndDate>='".$_SESSION['returnDate']."';";
					$res6 = mysql_query($sql6);
					if(!$row6 = mysql_fetch_array($res6))
					{
						$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";
					}
					else
					{
							$totalCost = $totalCost - (($row6['specialSalesDiscountPercent']/100) * $totalCost);
							$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";

					}	
				}
				mysql_query($sql2);
			}
			else
			{
				header("Location:http://cs-server.usc.edu:9046/CSCI571HW/mainPage.php?overlap=true");
			}
	}	
}
else
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/mainPage.php?overlap=true");
}	
/*$sql3 = "Select * from CustomerCarts WHERE customerUsername = '".$_SESSION['username']."';";
$res3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($res3))
{
	break;
}*/
echo'
<html>
	<head>
		<title>Main Page</title>
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
		';
		$count = 0;
		$sql7 = "Select addOnId from CarsAddOns WHERE carId = ".$_SESSION['selectedCar']." ORDER BY count DESC";
		$res7 = mysql_query($sql7);
		if(!$res7)
		{
			//Do Nothing
		}
		else
		{
			$addOns = "";
			while($row7 = mysql_fetch_array($res7))
			{
				if($count == 2)
				{
					break;
				}
				$count = $count + 1;
				$sql8 = "Select productName from AddOnProducts where productId = ".$row7['addOnId'].";";
				$res8 = mysql_query($sql8);
				while($row8 = mysql_fetch_array($res8))
				{
					$addOns = $addOns."     ".$row8['productName'];
				}
			}
			if($addOns!="")	
			{
				echo 'The Customers who reserved this car also usually purchased these add ons:'.$addOns;
			}
		}
		echo'
		<form name = "addOnProductForm" action = "cartMain.php" onsubmit="return validateAddOnProductForm()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%;padding-right:10%">
		<table width="100%">
			<tr>
				<th width="40%">Product</th>
				<th width="20%">Cost Per Day</th>
				<th width="20%"></th>
				<th width="20%"></th>
			</tr>';
		$sql3 = "Select * from AddOnProducts;";
		$res3 = mysql_query($sql3);
		while($row3 = mysql_fetch_array($res3))
		{
			echo'
				<tr>
					<td>'.$row3['productName'].'</td>
					<td>$'.$row3['productPrice'].'</td>
					<td><img ><img src="'.$row3['productImage'].'"></td>
					<td><input type="checkbox" id="addOnSelect" name="addOnSelect[]" value="'.$row3['productId'].'">Buy</td>
				</tr>
			';
		}
		echo'
			</table>
			<input type="submit" name="submitAddOns" value="Proceed to Cart" class="button" style="display: inline; margin: 0 auto;">
		</form>	
		</div>
	</body>
	<script>
	function validateAddOnProductForm()
	{
	}
	</script>
</html>		
		';
?> 