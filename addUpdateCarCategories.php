<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/login.php");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/login.php");
	}
}
echo '
<html>
	<head>
		<title>Add/Update Car Categories</title>
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
		<div id="addUpdateCarCategories" name="addUpdateCarCategories" style="width:80%;background:#ffffff;margin:0 auto;">
		<img src="productManagement.png" style="display:block;margin-left: auto;margin-right: auto;">';
		if(isset($_POST['updateCarCategory']))
		{
			$carCatId = $_POST['carCatID'];
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('Connection to database could not be established');
			}	
			mysql_select_db('carRentalDB',$con);
			$sql="Select * from ProductCategories Where productCatId = ". $carCatId ."";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res))
			{
				break;
			}
		}
echo '
		<form id="addUpdateCarCategories" action="storeCarCategoriesData.php" onsubmit="return compulsaryValidations()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
		<input type="hidden" name="productCatId" value="'. $row['productCatId'] .'">
		<label>productCatName: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="productCatName" name="productCatName" value="'. $row['productCatName'] .'" class="tb"><br/><br/>
		<label>productCatDesc: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="productCatDesc" name="productCatDesc" value="'. $row['productCatDesc'] .'" class="tb"><br/><br/>	
		<table>
			<tr>
				<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>';
				if(isset($_POST['updateCarCategory']))
				{
					echo '<td><input type="submit" name="update" value="Update" class="button" style="display: inline; margin: 0 auto;"></td>';
				}
				else
				{
					echo '<td><input type="submit" name="add" value="Add" class="button" style="display: inline; margin: 0 auto;"></td>';
				}
			echo '</tr>
		</table>
	</body>
	<script type="text/javascript">
	function compulsaryValidations()
	{
		message = "Please fill in the following details before proceeding: "
		if(document.getElementById("productCatName").value=="")
			message = message + "Product Category Name  "
		if(document.getElementById("productCatDesc").value=="")
			message = message + "Product Category Description  "
			
		if(message != "Please fill in the following details before proceeding: ")
  		{
  			alert(message);
  			return false;
  		}			
  		else
  		{	
			return true;	
  		}	
	}
	</script>
</html>';		
?>