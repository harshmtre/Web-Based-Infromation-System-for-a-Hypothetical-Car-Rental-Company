<?php

echo '
<html>
	<head>
		<title>Customer Signup Page</title>
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
		<div id="custSignupDiv" name="custSignupDiv" style="width:80%;background:#ffffff;margin:0 auto;">
		<img src="http://cs-server.usc.edu:9046/CSCI571HW/signup.png" style="display:block;margin-left: auto;margin-right: auto;">
		<form name="customerSignup" action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerStoreAfterSignup_c" onsubmit="return validateCustomer()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
			<label>Username: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="username" name="username" class="tb"><br/><br/>
			<label>Password: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="password" id="password" name="password" class="tb"><br/><br/>
			<label>First Name: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerFname" name="customerFname" class="tb"><br/><br/>
			<label>Last Name: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerLname" name="customerLname" class="tb"><br/><br/>	
			<label>Date Of Birth (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerDob" name="customerDob" onChange="javascript:checkDate()" class="tb"><br/><br/>
			<label>Age: </label><input type="text" id="customerAge" name="customerAge" onChange="javascript:checkAge()" class="rotb" readonly><br/><br/>
			<label>Email: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerEmail" name="customerEmail" class="tb" onChange="javascript:checkEmail()"><br/><br/>	
			<label>Phone Number: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerPhone" name="customerPhone" class="tb" onChange="javascript:checkPhone()"><br/><br/>	
			<label>Address: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerAddress" name="customerAddress" class="tb"><br/><br/>
			<label>Name on Credit Card: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCName" name="customerCCName" class="tb"><br/><br/>
			<label>Billing Address: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerBillingAddress" name="customerBillingAddress" class="tb"><br/><br/>
			<label>Credit Card Number: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCNumber" name="customerCCNumber" maxLength="16" class="tb" onkeypress="return checkIfNumber(event)" onChange="javascript:CheckCCNumber()"><br/><br/>
			<label>CVV: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCCVV" name="customerCCCVV" maxLength="3" class="tb" onkeypress="return checkIfNumber(event)" onChange="javascript:CheckCCCVV()"><br/><br/>
			<label>Credit Card Expiry Date (mm/yyyy): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="customerCCExpDate" name="customerCCExpDate" class="tb" onChange="javascript:checkCCExpDate()"><br/><br/>
			<table>
				<tr>
					<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>
					<td><input type="submit" name="signup" value="Submit" class="button" style="display: inline; margin: 0 auto;"></td>
				</tr>
			</table>
		</form>
		</div>		
	</body>
	<script type="text/javascript">
	var DOB = true;
	var AGE = true;
	var PHONE = true;
	var EMAIL = true;
	var CCEXP = true;
	var USERNAME = true;
	$("#username").change(function(){
  		$.post("http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/checkCustomerUsernameAvailability_c",
  		{
    		username:$(this).val()
  		},
  		function(data,status){
    		if(data == "unavailable")
    		{
    			alert("The username you chose is unavailable... Please chose a new one")
    			USERNAME = false;
    		}
    		else
    		{
    			USERNAME = true;
    		}
  		});
	});
	
	var CCNUM = true;
	function CheckCCNumber()
	{
		if($("#customerCCNumber").val().length < 16)
		{
			alert("Invalid Credit Card Number. Please enter a valid Credit Card Number.");
			CCNUM = false;
		}
		else
		{
			CCNUM = true;
		}
	}
	
	var CCCVV = true;
	function CheckCCCVV()
	{
		if($("#customerCCCVV").val().length < 3)
		{
			alert("Invalid Credit Card CVV. Please enter a valid Credit Card CVV.");
			CCCVV = false;
		} 
		else
		{
			CCCVV = true;
		}
	}
	
	function checkDate() //source: http://www.javascriptkit.com/script/script2/validatedate.shtml
	{
		var validformat=/^\d{4}\-\d{2}\-\d{2}$/; //Basic check for format validity
		var returnval=false;
		if (!validformat.test($("#customerDob").val()))
		{
			DOB = false;
			alert("Invalid Date Format. Please correct the date.");
		}	
		else
		{ 
			var yearfield=$("#customerDob").val().split("-")[0];
			var monthfield=$("#customerDob").val().split("-")[1];
			var dayfield=$("#customerDob").val().split("-")[2];
			var dayobj = new Date(yearfield, monthfield-1, dayfield);
			if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
				alert("Invalid Day, Month, or Year range detected. Please correct the date.");
			else
			{
				DOB = true;
				returnval=true;
				getAgeFromDate();
			}			
		}
		if (returnval==false) 
		{
			DOB = false;
		}	
		return returnval
	}
	function getAgeFromDate() //source:http://stackoverflow.com/questions/16850946/javascript-age-validation-from-dob-for-drop-down-selection
	{
		var currentDate = new Date();
		var dob = $("#customerDob").val();
		dob = dob.split("-");
        dob = new Date(dob[0], dob[1]-1, dob[2]);
		var birthday = new Date(currentDate.getFullYear(), dob.getMonth(), dob.getDate());
      	if (currentDate >= dob) 
      	{
        	$("#customerAge").val(currentDate.getFullYear() - dob.getFullYear() - 1);
        }
      	else
        	$("#customerAge").val(currentDate.getFullYear() - dob.getFullYear() - 1);
        checkAge();	
    }
    function checkAge()
    {
    	if($("#customerAge").val() < 18)
    	{
    		AGE = false;
    		alert("You have to be at least 18 years of age to register for the car rental program.");
    	}
    	else
    	{
    		AGE = true;
    	}
    }
	function checkEmail()
    {
    	var x = $("#customerEmail").val();
    	var atpos = x.indexOf("@");
    	var dotpos = x.lastIndexOf(".");
    	if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) 
    	{
    		EMAIL = false;
        	alert("Not a valid e-mail address");
    	}
    	else
    	{
    		EMAIL = true;
    	}
    }
	function checkPhone()  //source:http://www.w3resource.com/javascript/form/phone-no-validation.php
	{  
  		var phoneNo = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
  		if(!phoneNo.test($("#customerPhone").val()))  
        {  
        	PHONE = false;
        	alert("The phone number you have entered is invalid. Please enter a correct phone number.");  
        	return false;  
        }  
        else
        {
        	PHONE = true;
        	return true;
        }
	}
	function checkIfNumber(keyPressed) {
    	keyPressed = (keyPressed) ? keyPressed : window.event;
	    var charCode = (keyPressed.which) ? keyPressed.which : keyPressed.keyCode;
    	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        	return false;
    	}
    	return true;
	}
	function checkCCExpDate()
	{
		var validformat=/^\d{2}\/\d{4}$/; //Basic check for format validity
		var returnval=false;
		if (!validformat.test($("#customerCCExpDate").val()))
		{
			CCEXP = false;
			alert("Invalid Date Format. Please correct the date.");
			return false;
		}	
		else
		{ 
			var monthfield=$("#customerCCExpDate").val().split("/")[0];
			var yearfield=$("#customerCCExpDate").val().split("/")[1];
			var dayobj = new Date(yearfield, monthfield-1);
			if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getFullYear()!=yearfield))
			{
				CCEXP = false;
				alert("InvalidMonth, or Year range detected. Please correct the date.");
				return false;
			}
			else
			{
				CCEXP = true;
			}	
			if(new Date().getFullYear()>dayobj.getFullYear())
			{
				CCEXP = false;
				alert("Your Card Is No Longer Valid");
				return false;
			}
			else
			{
				CCEXP = true;
			}	
			if(new Date().getFullYear()==dayobj.getFullYear())
			{
				if(new Date().getMonth()>dayobj.getMonth())	
				{
					CCEXP = false;
					alert("Your Card Is No Longer Valid");
					return false;
				}	
				else
				{
					CCEXP = true;
				}	
			}	
		}		
	}
	function validateCustomer()
	{
		message = "Please fill in the following details before proceeding: "
		if($("#username").val()=="")
			message = message + "Username  "
		if($("#password").val()=="")
			message = message + "Password  "
		if($("#customerFname").val()=="")
			message = message + "First Name  "
		if($("#customerLname").val()=="")
			message = message + "Last Name  "
		if($("#customerDob").val()=="")
			message = message + "Date of Birth  "
		if($("#customerAge").val()=="")
			message = message + "Age  "
		if($("#customerEmail").val()=="")
			message = message + "Email  "		
		if($("#customerPhone").val()=="")
			message = message + "Phone  "		
		if($("#customerAddress").val()=="")
			message = message + "Address  "
		if($("#customerCCName").val()=="")
			message = message + "Name on CC  "
		if($("#customerBillingAddress").val()=="")
			message = message + "Billing Address  "	
		if($("#customerCCNumber").val()=="")
			message = message + "CC Number  "
		if($("#customerCCCVV").val()=="")
			message = message + "CVV  "	
		if($("#customerCCExpDate").val()=="")
			message = message + "CC Expiry Date  " 
		if(message != "Please fill in the following details before proceeding: ")
  		{
  			alert(message);
  			return false;
  		}
  		else if(DOB == false || AGE == false || PHONE == false || EMAIL == false || CCEXP == false || USERNAME == false || CCNUM == false || CCCVV == false)
  		{
  			correctionMessage = "Please correct the following details before proceeding: ";
  			if(USERNAME == false)
  				correctionMessage = correctionMessage + "Username  "
  			if(DOB == false)
  				correctionMessage = correctionMessage + "Date of birth  "
  			if(AGE == false)
  				correctionMessage = correctionMessage + "Age  "
  			if(EMAIL == false)
  				correctionMessage = correctionMessage + "Email  "
  			if(PHONE == false)
  				correctionMessage = correctionMessage + "Phone  "
  			if(CCNUM == false)
  				correctionMessage = correctionMessage + "CC Number  "
  			if(CCCVV == false)
  				correctionMessage = correctionMessage + "CC CVV  "
  			if(CCEXP == false)
  				correctionMessage = correctionMessage + "CC Expiry Date  "
  			alert(correctionMessage);	
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