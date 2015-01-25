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
		<div id="addUpdateSpecialSales" name="addUpdateSpecialSales" style="width:80%;background:#ffffff;margin:0 auto;">
		<img src="productManagement.png" style="display:block;margin-left: auto;margin-right: auto;">';
		if(isset($_POST['updateSpecialSales']))
		{
			$specialSalesId = $_POST['specialSalesID'];
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('Connection to database could not be established');
			}	
			mysql_select_db('carRentalDB',$con);
			$sql="Select * from SpecialSales Where specialSalesId = ". $specialSalesId .";";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res))
			{
				break;
			}
			$specialSalesProductCatId = $row['specialSalesProductCatId'];
			$sql2 = "Select productCatName from ProductCategories where productCatId = ". $specialSalesProductCatId .";";
			$res2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($res2))
			{
				break;
			}
		}

echo '
		<form id="addUpdateCarCategories" action="storeSpecialSalesData.php" onsubmit="return compulsaryValidations()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
		<input type="hidden" name="specialSalesId" value="'. $row['specialSalesId'] .'">
		<label>Car Category: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carCategory" name="carCategory" value="'. $row2['productCatName'] .'" class="tb"><br/><br/>
		<label>Special Sales Start Date (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="specialSalesStartDate" name="specialSalesStartDate" value="'. $row['specialSalesStartDate'] .'" class="tb"><br/><br/>
		<label>Special Sales End Date (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="specialSalesEndDate" name="specialSalesEndDate" value="'. $row['specialSalesEndDate'] .'" class="tb" onChange="javascript:checkDate()"><br/><br/>	
		<label>Special Sales Discount Percentage: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="specialSalesDiscountPercent" name="specialSalesDiscountPercent" value="'. $row['specialSalesDiscountPercent'] .'" class="tb" onChange="javascript:checkDate()"><br/><br/>	
		<table>
			<tr>
				<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>';
				if(isset($_POST['updateSpecialSales']))
				{
					echo '<td><input type="submit" name="update" value="Update" class="button" style="display: inline; margin: 0 auto;"></td>';
				}
				else
				{
					echo '<td><input type="submit" name="add" value="Add" class="button" style="display: inline; margin: 0 auto;"></td>';
				}
			echo '</tr>
		</table>
		</form>
	</body>
	<script type="text/javascript">
	function checkDate() //source: http://www.javascriptkit.com/script/script2/validatedate.shtml
	{
		var validformat=/^\d{4}\-\d{2}\-\d{2}$/; //Basic check for format validity
		var returnval=false;
		if (!validformat.test(document.getElementById("dob").value))
			alert("Invalid Date Format. Please correct the date.");
		else
		{ 
			var yearfield=document.getElementById("dob").value.split("-")[0];
			var monthfield=document.getElementById("dob").value.split("-")[1];
			var dayfield=document.getElementById("dob").value.split("-")[2];
			var dayobj = new Date(yearfield, monthfield-1, dayfield);
			if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
				alert("Invalid Day, Month, or Year range detected. Please correct the date.");
			else
			{
				returnval=true;
				getAgeFromDate();
			}			
		}
		if (returnval==false) input.select()
			return returnval
	}
	function compulsaryValidations()
	{
		message = "Please fill in the following details before proceeding: "
		if(document.getElementById("carCategory").value=="")
			message = message + "carCategory  "
		if(document.getElementById("specialSalesStartDate").value=="")
			message = message + "Special Sales Start Date  "
		if(document.getElementById("specialSalesEndDate").value=="")
			message = message + "Special Sales End Date  "
		if(document.getElementById("specialSalesDiscountPercent").value=="")
			message = message + "Special Sales Discount Percentage  "
		 
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