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
		<table>
			<tr>
				<td><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
			</tr>
		</table>
		<img src="employeeManagement.png" style="display:block;margin-left: auto;margin-right: auto;">
		<form action = "addUpdateEmployee.php" method="post">
			<input type="submit" class="button" name="addEmployee" value="Add New Employee" style="align:center; display: block; margin: 0 auto;">
		</form>
		<table>
		<tr>
			<td width="70%"><label>Search for an employee: </label> <input type="text" id="searchBox" name="searchBox" class="sb"></td>
			<td width="5%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:searchEmployee();">Go</button></td>
			<td width="25%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showAllEmployees();">Show All Employees</button></td>
		</tr>
		</table>
		</div>
		<div id="searchResults" name="searchResults" style="width:80%;background:#ffffff;margin:0 auto;">
		</div>
	</body>
	<script>
	function searchEmployee() 
	{
    	sbInput = document.getElementById("searchBox").value;
    	if (sbInput == "")
    	{
    		//Do nothing
    	}
    	else
    	{
  			if (window.XMLHttpRequest) 
  			{
    			xmlhttp=new XMLHttpRequest();
  			} 
  			else 
  			{ 
    			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
  			xmlhttp.onreadystatechange=function() 
  			{
    			if (xmlhttp.readyState==4 && xmlhttp.status==200) 
    			{
      				document.getElementById("searchResults").innerHTML=xmlhttp.responseText;
    			}
  			}	
  			xmlhttp.open("GET","searchResults.php?q="+sbInput,true);
  			xmlhttp.send();
  		}	
	}
	function showAllEmployees()
	{
		input = ""
		if (window.XMLHttpRequest) 
  		{
    		xmlhttp=new XMLHttpRequest();
  		} 
  		else 
  		{ 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 		}
  		xmlhttp.onreadystatechange=function() 
  		{
    		if (xmlhttp.readyState==4 && xmlhttp.status==200) 
    		{
      			document.getElementById("searchResults").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchResults.php?q="+input,true);
  		xmlhttp.send();
	}
	function deleteEmployee(userId)
	{
		var confirmDelete = confirm("Are you sure you want to delete this employee record?");
		if(confirmDelete == true)
		{
			elementId = "user" + userId;
			document.getElementById(elementId).style.display="none";
    		if (window.XMLHttpRequest) 
  			{
    			xmlhttp=new XMLHttpRequest();
  			} 
  			else 
  			{ 
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 			}
  			xmlhttp.onreadystatechange=function() 
  			{
    			if (xmlhttp.readyState==4 && xmlhttp.staus==200) 
    			{
    				document.getElementById("searchResults").innerHTML=xmlhttp.responseText
    			}
  			}	
  			xmlhttp.open("GET","deleteEmployee.php?q="+userId,true);
  			xmlhttp.send();
  		}	
	}
</script>
</html>
'
?>