<?php
session_start();
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/mainPage.php");
	}
}
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
		<div id="mainPage" name="mainPage" class="reportDiv" style="width:80%;background:#ffffff;margin:0 auto;">';
		if(isset($_SESSION['username']))
		{
			$con = mysql_connect("localhost","root","909Cuppy");
			if(!$con)
			{
				die("Could not connect to the database...");
			}
			mysql_select_db("carRentalDB",$con);
			$sql = "Select * from Customers WHERE username = '".$_SESSION['username']."';";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res))
			{
				break;
			}
			echo'
			<table width=100%>
				<tr>
					<td width = "20%"></td>
					<td width = "40%"></td>
					<td width = "20%">Welcome '.$row['customerFname'].'</td>
					<td width = "20%"></td>
				</tr>
				<tr>
					<td width = "20%"><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width = "40%"></td>
					<td width = "20%"><form action="customerMainPage.php"><input type="submit" name="signup" value="My Profile" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width = "20%"><form action="cartMain.php"><input type="submit" name="signup" value="My Cart" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
			';
		}
		else
		{
			echo'
			<table width=100%>
				<tr>
					<td width = "20%"><form action="login.php"><input type="submit" name="login" value="Employee Login" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width = "40%"></td>
					<td width = "20%"><form action="customerSignup.php"><input type="submit" name="signup" value="Customer Signup" class="button" style="display: inline; margin: 0 auto;"></form></td>
					<td width = "20%"><form action="customerLogin.php"><input type="submit" name="login" value="Customer Login" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
			';
		}
		echo'
			<table width="100%">
				<tr>
					<th>My Itinerary</th>
				</tr>
			</table>
			<form name = "itinerary" action = "chooseAdditionalFeatures.php" onsubmit="return validateItinerary()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%;padding-right:10%">
				<label>Pickup And Return Location: <span style="font-family:Calibri ,serif; color: red">*</span></label><select id="location" name="location" value="'.$_SESSION["location"].'">
				<option value="">Select a location</option>';
				$con = mysql_connect("localhost","root","909Cuppy");
				if(!$con)
				{
					die("Could not connect to the database...");
				}
				mysql_select_db("carRentalDB",$con);
				$sql = "Select location from RentalLocations;";
				$res = mysql_query($sql);
				while($row = mysql_fetch_array($res))
				{
					$location = $row['location'];
					echo'<option value="'.$location.'">'.$location.'</option>';
				}
				echo
				'</select><br/><br/>
				<label>Pickup Date: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="pickupDate" name="pickupDate" value="'.$_SESSION["pickupDate"].'" onChange="javascript:checkDate(\'pickupDate\')" class="tb datepicker"><br/><br/>
				<label>Return Date: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="returnDate" name="returnDate" value="'.$_SESSION["returnDate"].'" onChange="javascript:checkDate(\'returnDate\')" class="tb datepicker"><br/><br/>	
				<label>Select The Category Of Cars: <span style="font-family:Calibri ,serif; color: red">*</span></label><select id="carCategory" name="carCategory" value="'.$_SESSION["carCategory"].'">
				<option value="">Select A Category</option>';
				$con = mysql_connect("localhost","root","909Cuppy");
				if(!$con)
				{
					die("Could not connect to the database...");
				}
				mysql_select_db("carRentalDB",$con);
				$sql = "Select productCatName from ProductCategories;";
				$res = mysql_query($sql);
				while($row = mysql_fetch_array($res))
				{
					$productCatName = $row['productCatName'];
					echo'<option value="'.$productCatName.'">'.$productCatName.'</option>';
				}
				echo
				'</select><br/><br/>
				<input type="hidden" name"selectedCar" id="selectedCar" value="'.$_SESSION["selectedCar"].'">
				<div id="carDisplay"></div>
				<div id="specialSalesDiv">
					<table width="100%" align="center">
						<tr>
							<th align="center">Current And Upcoming Special Sales</th>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td>For Special Sales to apply, your reservation must start on or after the Special Sales start date and must end on or before the Special Sales end date.</td>
						</tr>
					</table>	
					<table width="100%">
						<tr>
							<th width="40%">Special Sales On:</th>
							<th width="20%">From Date:</th>
							<th width="20%">To Date:</th>
							<th width="20%">Discount Percent:</th>
						<tr>';
				$sql1 = "Select * from SpecialSales";
				$res1 = mysql_query($sql1);
				while($row1 = mysql_fetch_array($res1))
				{
					$sql2 = "Select * from ProductCategories where productCatId = ".$row1['specialSalesProductCatId'].";";
					$res2 = mysql_query($sql2);
					while($row2 = mysql_fetch_array($res2))
					{
						echo'
						<tr>
							<td width="40%">'.$row2['productCatName'].'</td>
							<td width="20%">'.$row1['specialSalesStartDate'].'</td>
							<td width="20%">'.$row1['specialSalesEndDate'].'</td>
							<td width="20%">'.$row1['specialSalesDiscountPercent'].'</td>
						</tr>
						';
					}
				}
				echo'	
					</table>
				</div>
			<form>
		</div>
	</body>
	<script>';
	if($_GET['overlap']=="true")
	{
		echo 'alert("The dates you have chosen overlap with a previous booking")';
	}
	echo'
  	$(function() {
    	$( ".datepicker" ).datepicker({minDate: 0, dateFormat: "yy-mm-dd"});
  	});
  	$("#location").val("'.$_SESSION['location'].'");
  	$("#carCategory").change(function() {
  		$.post("populateCars.php",
  		{
    		category:$(this).val()
  		},
  		function(data,status){
    		$("#carDisplay").html(data);
  		});
  	});
  	$("#carCategory").val("'.$_SESSION['carCategory'].'").trigger("change");
  	var DATE = true;
  	function setSelectedCar(carId)
  	{
  		$("#selectedCar").val(carId);
  	}
  	function checkDate(field) //source: http://www.javascriptkit.com/script/script2/validatedate.shtml
	{
		var validformat=/^\d{4}\-\d{2}\-\d{2}$/; //Basic check for format validity
		var returnval=false;
		if (!validformat.test(document.getElementById(field).value))
		{
			DATE = false;
			alert("Invalid Date Format. Please correct the date.");
		}	
		else
		{ 
			var yearfield=document.getElementById(field).value.split("-")[0];
			var monthfield=document.getElementById(field).value.split("-")[1];
			var dayfield=document.getElementById(field).value.split("-")[2];
			var dayobj = new Date(yearfield, monthfield-1, dayfield);
			if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
				alert("Invalid Day, Month, or Year range detected. Please correct the date.");
			else
			{
				if (!validformat.test(document.getElementById("pickupDate").value)||!validformat.test(document.getElementById("returnDate").value))
				{
					DATE = false;
				}
				else
				{
					var yearfield1=document.getElementById("pickupDate").value.split("-")[0];
					var yearfield2=document.getElementById("returnDate").value.split("-")[0];
					var monthfield1=document.getElementById("pickupDate").value.split("-")[1];
					var monthfield2=document.getElementById("returnDate").value.split("-")[1];
					var dayfield1=document.getElementById("pickupDate").value.split("-")[2];
					var dayfield2=document.getElementById("returnDate").value.split("-")[2];
					var dayobj1 = new Date(yearfield1, monthfield1-1, dayfield1);
					var dayobj2 = new Date(yearfield2, monthfield2-1, dayfield2);
					if ((dayobj1.getMonth()+1!=monthfield1)||(dayobj1.getDate()!=dayfield1)||(dayobj1.getFullYear()!=yearfield1)||(dayobj2.getMonth()+1!=monthfield2)||(dayobj2.getDate()!=dayfield2)||(dayobj2.getFullYear()!=yearfield2))
					{
						DATE = false;
					}
					else
					{
						DATE = true;
					}	
				returnval=true;
			    }			
		    }
			if (returnval==false) 
			{
				DATE = false;
			}	
		}
		return returnval
	}
	function validateItinerary()
	{	
		message = "Please fill in the following details before proceeding: "
		if(document.getElementById("pickupDate").value=="")
			message = message + "Pickup Date  "
		if(document.getElementById("returnDate").value=="")
			message = message + "Return Date  "
		for(i=0; i<document.getElementById("location").length; i++) 
  		{
     		if (document.getElementById("location")[i].selected)
     		{
        		if(i==0)
        		{
        			message = message + "Location  "
        		}
     		}
  		}
  		for(i=0; i<document.getElementById("carCategory").length; i++) 
  		{
     		if (document.getElementById("carCategory")[i].selected)
     		{
        		if(i==0)
        		{
        			message = message + "Car Category  "
        		}
     		}
  		}
  		if(message != "Please fill in the following details before proceeding: ")
  		{
  			alert(message);
  			return false;
  		}
  		if(DATE == false)
  		{
  			correctionMessage = "Please correct the following details before proceeding: ";
  			if(DATE == false)
  				correctionMessage = correctionMessage + "Dates  "
  			alert(correctionMessage);	
  			return false;
  		}
  		else
		{ 
			var yearfield1=document.getElementById("pickupDate").value.split("-")[0];
			var yearfield2=document.getElementById("returnDate").value.split("-")[0];
			var monthfield1=document.getElementById("pickupDate").value.split("-")[1];
			var monthfield2=document.getElementById("returnDate").value.split("-")[1];
			var dayfield1=document.getElementById("pickupDate").value.split("-")[2];
			var dayfield2=document.getElementById("returnDate").value.split("-")[2];
			var dayobj1 = new Date(yearfield1, monthfield1-1, dayfield1);
			var dayobj2 = new Date(yearfield2, monthfield2-1, dayfield2);
			if (dayobj1 >= dayobj2)
			{
				alert("Return date must be later than pickup date.");
				return false;	
			}		
		}
	';
	if(!(isset($_SESSION['username'])))
	{
		echo
		'alert("You need to signup/login before reserving a car.");
		return false;';
	}
	echo	
	'
	$.ajax({
      url: "setItinerarySessionVariables.php?pickupDate="+$("#pickupDate").val()+"&returnDate="+$("#returnDate").val()+"&location="+$("#location").val()+"&carCategory="+$("#carCategory").val()+"&selectedCar="+$("#selectedCar").val(),
      success: function(data) {
			return true;
      }
    });
	}
  </script>
</html>	
';
?>