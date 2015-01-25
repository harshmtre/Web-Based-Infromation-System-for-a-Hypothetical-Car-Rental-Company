<?php
echo'
<html>
	<head>
		<title>Main Page</title>
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
		';
			if($addOns['addOn']!="")	
			{
				echo 'The Customers who reserved this car also usually purchased these add ons:'.$addOns['addOn'];
			}
		
		echo'
		<form name = "addOnProductForm" action = "http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/cartMain_c" onsubmit="return validateAddOnProductForm()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%;padding-right:10%">
		<table width="100%">
			<tr>
				<th width="40%">Product</th>
				<th width="20%">Cost Per Day</th>
				<th width="20%"></th>
				<th width="20%"></th>
			</tr>';
		while($row3 = mysql_fetch_array($resultSet['resultSet']))
		{
			echo'
				<tr>
					<td>'.$row3['productName'].'</td>
					<td>$'.$row3['productPrice'].'</td>
					<td><img ><img src="http://cs-server.usc.edu:9046/CSCI571HW/'.$row3['productImage'].'"></td>
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