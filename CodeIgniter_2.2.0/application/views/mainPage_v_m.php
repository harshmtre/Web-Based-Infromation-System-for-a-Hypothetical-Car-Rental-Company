<?php
echo'
<html>
	<head>
		<title>Main Page</title>
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
		<div id="mainPage" name="mainPage" class="reportDiv" style="width:90%;background-color: rgba(255, 255, 255, 0);margin:0 auto;">';
		if(isset($_SESSION['username']))
		{
			foreach($resultSet['resultSet']->result_array() as $row)
			{
				break;
			}
			echo'
			<table width=100%>
				<tr>
					<td>Welcome '.$row['customerFname'].'</td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/logout.php"><input type="submit" name="logout" value="Logout" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerMainPage_c"><input type="submit" name="signup" value="My Profile" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/cartMain_c"><input type="submit" name="signup" value="My Cart" data-theme="b"></form></td>
				</tr>
			</table>
			';
		}
		else
		{
			echo'
			<table width=100%>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/login.php"><input type="submit" name="login" value="Employee Login" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerLogin_c"><input type="submit" name="login" value="Customer Login" data-theme="b"></form></td>
				</tr>
				<tr>
					<td><form action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerSignup_c"><input type="submit" name="signup" value="Customer Signup" data-theme="b"></form></td>
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
			<form name = "itinerary" action = "http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/chooseAdditionalFeatures_c" onsubmit="return validateItinerary()" method="post" style="padding-top:2.5%;padding-bottom:2.5%;">
				<span style="font-family:Calibri ,serif; font-size=0.6in">Pickup And Return Location: <span style="font-family:Calibri ,serif; color: red">*</span></span><select id="location" name="location" value="'.$_SESSION["location"].'">
				<option value="">Select a location</option>';
				foreach($resultSet2['resultSet2']->result_array() as $row)
				{
					$location = $row['location'];
					echo'<option value="'.$location.'">'.$location.'</option>';
				}
				echo
				'</select>
				<span style="font-family:Calibri ,serif; font-size=0.6in">Pickup Date (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></span><input type="text" id="pickupDate" name="pickupDate" value="'.$_SESSION["pickupDate"].'" onChange="javascript:checkDate(\'pickupDate\')" class="tb datepicker">
				<span style="font-family:Calibri ,serif; font-size=0.6in">Return Date (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></span><input type="text" id="returnDate" name="returnDate" value="'.$_SESSION["returnDate"].'" onChange="javascript:checkDate(\'returnDate\')" class="tb datepicker">
				<span style="font-family:Calibri ,serif; font-size=0.6in">Select The Category Of Cars: <span style="font-family:Calibri ,serif; color: red">*</span><select id="carCategory" name="carCategory" value="'.$_SESSION["carCategory"].'">
				<option value="">Select A Category</option>';
				foreach($resultSet3['resultSet3']->result_array() as $row)
				{
					$productCatName = $row['productCatName'];
					echo'<option value="'.$productCatName.'">'.$productCatName.'</option>';
				}
				echo
				'</select><br/>
				<input type="hidden" name"selectedCar" id="selectedCar" value="'.$_SESSION["selectedCar"].'">
				<div id="carDisplay"></div>
					<table width="100%">
						<tr>
							<th>Current And Upcoming Special Sales</th>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td>For Special Sales to apply, your reservation must start on or after the Special Sales start date and must end on or before the Special Sales end date.</td>
						</tr>
					</table>	
					<table width="100%">
						<tr>
							<th width="35%">Special Sales On:</th>
							<th width="50%">Dates:</th>
							<th width="15%">Disc %:</th>
						<tr>';
				foreach($resultSet4['resultSet4']->result_array() as $row)
				{
				
						echo'
						<tr>
							<td width="40%">'.$row['productCatName'].'</td>
							<td width="50%">'.$row['specialSalesStartDate'].' to '.$row['specialSalesEndDate'].'</td>
							<td width="10%">'.$row['specialSalesDiscountPercent'].'</td>
						</tr>
						';
					
				}
				echo'	
					</table>
			<form>
		</div>
	<script>';
	if($overlap=="yes")
	{
		echo 'alert("The dates you have chosen overlap with a previous booking")';
	}
	echo'
  	$("#location").val("'.$_SESSION['location'].'");
  	$("#carCategory").change(function() {
  		$.post("http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/populateCars_c",
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
		if (!validformat.test($("#"+field).val()))
		{
			DATE = false;
			alert("Invalid Date Format. Please correct the date.");
		}	
		else
		{ 
			var yearfield=$("#"+field).val().split("-")[0];
			var monthfield=$("#"+field).val().split("-")[1];
			var dayfield=$("#"+field).val().split("-")[2];
			var dayobj = new Date(yearfield, monthfield-1, dayfield);
			if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
				alert("Invalid Day, Month, or Year range detected. Please correct the date.");
			else
			{
				if (!validformat.test($("#pickupDate").val())||!validformat.test($("#returnDate").val()))
				{
					DATE = false;
				}
				else
				{
					var yearfield1=$("#pickupDate").val().split("-")[0];
					var yearfield2=$("#returnDate").val().split("-")[0];
					var monthfield1=$("#pickupDate").val().split("-")[1];
					var monthfield2=$("#returnDate").val().split("-")[1];
					var dayfield1=$("#pickupDate").val().split("-")[2];
					var dayfield2=$("#returnDate").val().split("-")[2];
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
		if($("#pickupDate").val()=="")
			message = message + "Pickup Date  "
		if($("#returnDate").val()=="")
			message = message + "Return Date  "
		for(i=0; i<$("#location").length; i++) 
  		{
     		if ($("#location")[i].selected)
     		{
        		if(i==0)
        		{
        			message = message + "Location  "
        		}
     		}
  		}
  		for(i=0; i<$("#carCategory").length; i++) 
  		{
     		if ($("#carCategory")[i].selected)
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
			var yearfield1=$("#pickupDate").val().split("-")[0];
			var yearfield2=$("#returnDate").val().split("-")[0];
			var monthfield1=$("#pickupDate").val().split("-")[1];
			var monthfield2=$("#returnDate").val().split("-")[1];
			var dayfield1=$("#pickupDate").val().split("-")[2];
			var dayfield2=$("#returnDate").val().split("-")[2];
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
      url: "http://cs-server.usc.edu:9046/CSCI571HW/setItinerarySessionVariables.php?pickupDate="+$("#pickupDate").val()+"&returnDate="+$("#returnDate").val()+"&location="+$("#location").val()+"&carCategory="+$("#carCategory").val()+"&selectedCar="+$("#selectedCar").val(),
      success: function(data) {
			return true;
      }
    });
	$.post("http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/setItinerarySessionVariables_c",
  		{
    		category:$(this).val(),
    		pickupDate:$("#pickupDate").val(),
    		returnDate:$("#returnDate").val(),
    		location:$("#location").val(),
    		carCategory:$("#carCategory").val(),
    		selectedCar:$("#selectedCar").val()
  		},
  		function(data){
  			alert(data);
    		return true;
  		});
	}
  </script>
</body>
</html>	
';
?>