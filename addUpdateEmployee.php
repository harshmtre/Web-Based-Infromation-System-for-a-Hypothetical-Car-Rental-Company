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
		<title>Administrator Main Page</title>
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
		<div id="adminMainDiv" name="adminMainDiv" style="width:80%;background:#ffffff;margin:0 auto;">
		<img src="employeeManagement.png" style="display:block;margin-left: auto;margin-right: auto;">';
		if(isset($_POST['updateEmployee']))
		{
			$userId = $_POST['userID'];
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('dead');
			}	
			mysql_select_db('carRentalDB',$con);
			$sql="Select * from Employees Where empUserId = ". $userId ."";
			$sql2="Select * from Users where userId = ". $userId ."";
			$res = mysql_query($sql);
			$res2 = mysql_query($sql2);
			while($row = mysql_fetch_array($res))
			{
				break;
			}
			while($row2 = mysql_fetch_array($res))
			{
				break;
			}
		}
echo '
		<form id="addUpdateEmployees" action="storeEmployeeData.php" onsubmit="return compulsaryValidations()" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
		<input type="hidden" name="empId" value="'. $row['empId'] .'">
		<input type="hidden" name="empUserId" value="'. $row['empUserId'] .'">';
		if(isset($_POST['addEmployee']))
		{
			echo'
			<label>Username: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="username" name="username" class="tb"><br/><br/>
			<label>Password: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="password" id="password" name="password" class="tb"><br/><br/>';
		}
		echo'<label>First Name: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="fname" name="fname" value="'. $row['empfname'] .'" class="tb"><br/><br/>
		<label>Last Name: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="lname" name="lname" value="'. $row['emplname'] .'" class="tb"><br/><br/>	
		<label>Gender: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="radio" id="gender" name="gender" value="Male"'; if($row['empGender']=='Male'){ echo 'checked'; } echo '>Male<input type="radio" id="gender" name="gender" value="Female"'; if($row['empGender']=='Female'){ echo 'checked'; } echo '>Female<input type="radio" id="gender" name="gender" value="Not Disclosed"'; if($row['empGender']=='Not Disclosed'){ echo 'checked'; } echo '>Do not wish to disclose<br/><br/>
		<label>Date Of Birth (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="dob" name="dob" value="'. $row['empDOB'] .'" onChange="javascript:checkDate()" class="tb"><br/><br/>
		<label>SSN: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="ssn" name="ssn" value="'. $row['empSSN'] .'" class="tb" onChange="javascript:checkSSN()"><br/><br/>
		<label>Email: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="email" name="email" value="'. $row['empEmail'] .'" class="tb" onChange="javascript:checkEmail()"><br/><br/>	
		<label>Address: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="address" name="address" value="'. $row['empAddress'] .'" class="tb"><br/><br/>
		<label>Joining Date (yyyy-mm-dd): <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="joiningDate" name="joiningDate" value="'. $row['empJoiningDate'] .'" onChange="javascript:checkDate()" class="tb"><br/><br/>
		<label>Job Title: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="jobTitle" name="jobTitle" value="'. $row['empJobTitle'] .'" class="tb"><br/><br/>
		<label>Salary: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="salary" name="salary" value="'. $row['empSalary'] .'" class="tb"><br/><br/>
		<label>Department: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="department" name="department" value="'. $row['empDepartment'] .'" class="tb"><br/><br/>
		<label>Years of Experience: </label><input type="text" id="yoe" name="yoe" value="'. $row['empYearsOfExp'] .'" class="tb"><br/><br/>
		<label>Employee type: <span style="font-family:Calibri ,serif; color: red">*</span></label><select id="type" name="type">
			<option value="NA">Select A Type</option>
			<option value="Manager" '; if($row['empType'] == "Manager"){echo 'selected';} echo '>Manager</option>
			<option value="Administrator" '; if($row['empType'] == "Administrator"){echo 'selected';} echo '>Administrator</option>
			<option value="Employee" '; if($row['empType'] == "Employee"){echo 'selected';} echo '>Employee</option>
		</select><br></br>
		<label>Phone Number: </label><input type="text" id="empPhone" name="empPhone" value="'. $row['empPhone'] .'" class="tb" onChange="javascript:checkPhone()"><br/><br/>
		<table>
			<tr>
				<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="history.go(-1);">Go Back</button></td>';
				if(isset($_POST['updateEmployee']))
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
	function checkEmail()
    {
    	var x = document.getElementById("email").value;
    	var atpos = x.indexOf("@");
    	var dotpos = x.lastIndexOf(".");
    	if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) 
    	{
        	alert("Not a valid e-mail address");
    	}
    }
    function checkSSN()
	{
		var ssn = /^\d{3}-\d{2}-\d{4}$/;
		if (!ssn.test(document.getElementById("ssn").value))
  			alert("Please enter a Valid SSN");
	}
	function checkPhone()  //source:http://www.w3resource.com/javascript/form/phone-no-validation.php
	{  
  		var phoneNo = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
  		if(!phoneNo.test(document.getElementById("phone").value))  
        {  
        	alert("The phone number you have entered is invalid. Please enter a correct phone number.");  
        	return false;  
        }  
	}
	function compulsaryValidations()
	{
		message = "Please fill in the following details before proceeding: "';
		if(isset($_POST['addEmployee']))
		{
			echo'
		if(document.getElementById("username").value=="")
			message = message + "Username  "
		if(document.getElementById("password").value=="")
			message = message + "Password  "';
		}
		echo '
		if(document.getElementById("fname").value=="")
			message = message + "First Name  "
		if(document.getElementById("lname").value=="")
			message = message + "Last Name  "
		if(document.getElementById("dob").value=="")
			message = message + "Date of Birth  "
		var gender = document.getElementsByName("gender");
		var genderInput = "false"
		for (var i = 0; i < gender.length; i++) 
		{
   			if (gender[i].checked) 
   			{
        		genderInput = "true"
    		}
		}
		if(genderInput != "true")	
			message = message + "Gender  "
		if(document.getElementById("address").value=="")
			message = message + "Address  "
		if(document.getElementById("ssn").value=="")
			message = message + "SSN  "
		if(document.getElementById("email").value=="")
			message = message + "Email  "		
		if(document.getElementById("joiningDate").value=="")
			message = message + "Joining Date  "
		if(document.getElementById("jobTitle").value=="")
			message = message + "Job Title  "	
		if(document.getElementById("salary").value=="")
			message = message + "Salary  "  
		if(document.getElementById("department").value=="")
			message = message + "Department  "  
		if(document.getElementById("empPhone").value=="")
			message = message + "Phone Number  "  
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