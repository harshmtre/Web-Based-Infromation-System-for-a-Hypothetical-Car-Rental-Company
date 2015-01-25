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
		<title>Add/Update Cars</title>
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
		<div id="addUpdateCars" name="addUpdateCars" style="width:80%;background:#ffffff;margin:0 auto;">
		<img src="productManagement.png" style="display:block;margin-left: auto;margin-right: auto;">';
		if(isset($_POST['updateCar']))
		{
			$carId = $_POST['carId'];
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('Connection to database could not be established');
			}	
			mysql_select_db('carRentalDB',$con);
			$sql="Select * from Cars Where carId = ". $carId ."";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res))
			{
				break;
			}
			$carCategoryId = $row['carCategoryId'];
			$sql2 = "Select productCatName from ProductCategories where productCatId = ". $carCategoryId .";";
			$res2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($res2))
			{
				break;
			}
		}

echo '
		<form id="addUpdateCars" action="storeCarsData.php" onsubmit="return compulsaryValidations()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
		<input type="hidden" name="carId" value="'. $row['carId'] .'">
		<input type="hidden" name="carCategoryId" value="'. $carCategoryId .'">
		<label>Manufacturer: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carManufacturer" name="carManufacturer" value="'. $row['carManufacturer'] .'" class="tb"><br/><br/>
		<label>Model: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carModel" name="carModel" value="'. $row['carModel'] .'" class="tb"><br/><br/>
		';
			$con2 = mysql_connect('localhost','root','909Cuppy');
			if(!$con2)
			{
				die('Could not establish connection to database...');
			}	
			mysql_select_db('carRentalDB',$con2);
			$sql2="Select Distinct(productCatName), productCatId from ProductCategories;";
			$res2 = mysql_query($sql2);
			echo '
		<label>Car Category: <span style="font-family:Calibri ,serif; color: red">*</span></label><select id="prodCategory" name="prodCategory">
								<option value="NA">Select A Type</option>;';			 
								while($row2 = mysql_fetch_array($res2)) {
								echo 'here';
								echo '<option value="'.$row2['productCatId'].'">'.$row2['productCatName'].'</option>';
								}
								mysql_close($con2);
							echo '</select><br/><br/>
		<label>Manufactured In (YYYY): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carManufactureYear" name="carManufactureYear" value="'. $row['carManufactureYear'] .'" class="tb"><br/><br/>
		<label>Registration Number: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carRegistrationNumber" name="carRegistrationNumber" value="'. $row['carRegistrationNumber'] .'" class="tb"><br/><br/>
		<label>Car Insurance Policy Nuber: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carInsurancePolicyNumber" name="carInsurancePolicyNumber" value="'. $row['carInsurancePolicyNumber'] .'" class="tb"><br/><br/>
		<label>Car Description: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carDescription" name="carDescription" value="'. $row['carDescription'] .'" class="tb"><br/><br/>
		<label>Cost Of Car Per Hour: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carPrice" name="carPrice" value="'. $row['carPrice'] .'" class="tb"><br/><br/>
		<label>Scheduled Maintenence: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carScheduledMaintenance" name="carScheduledMaintenance" value="'. $row['carScheduledMaintenance'] .'" class="tb"><br/><br/>
		<label>Image Name: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="carImage" name="carImage" value="'. $row['carImage'] .'" class="tb"><br/><br/>		
		<table>
			<tr>
				<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>';
				if(isset($_POST['updateCar']))
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
		if(document.getElementById("carManufacturer").value=="")
			message = message + "Car Manufacturer"
		if(document.getElementById("carModel").value=="")
			message = message + "Model  "
		if(document.getElementById("carManufactureYear").value=="")
			message = message + "Year of Manufacture  "
		if(document.getElementById("carRegistrationNumber").value=="")
			message = message + "Registration Number  "
		if(document.getElementById("carInsurancePolicyNumber").value=="")
			message = message + "Insurance Policy Number  "
		if(document.getElementById("carDescription").value=="")
			message = message + "Car Description  "		
		if(document.getElementById("carPrice").value=="")
			message = message + "Price  "
		if(document.getElementById("carScheduledMaintenance").value=="")
			message = message + "Scheduled Maintenance  "	
		if(document.getElementById("carImage").value=="")
			message = message + "Image Name  "   
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