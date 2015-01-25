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
$_SESSION['timeout']=time();
echo '
<html>
	<head>
		<title>Employee Main Page</title>
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
		<div id="employeeMainDiv" name="employeeMainDiv" style="width:80%;background:#ffffff;margin:0 auto;">
			<table width="100%">
				<tr>
					<td><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
			<img src="productManagement.png" style="display:block;margin-left: auto;margin-right: auto;">
			<table id="employeeMain" width="100%" style="text-align:center">
				<tr>
					<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showAddUpdateProducts();">Add/Update Car Details</button></td>
					<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showAddUpdateProductCategories();">Add/Update Car Category Details</button></td>
					<td><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showAddUpdateSpecials();">Add/Update Special Sales</button></td>
				</tr>
			</table>
			<br/><br/>
			<div id="carCategories" name="carCategories" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%">
				<form action = "addUpdateCarCategories.php" method="post">
					<input type="submit" class="button" name="addCarCategory" value="Add New Car Category" style="align:center; display: block; margin: 0 auto;">
				</form>';

$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Connection could not be established.');
}	
mysql_select_db('carRentalDB',$con);
$sql="Select productCatId, productCatName, productCatDesc from ProductCategories";
$res = mysql_query($sql);

echo "<table border='1' width='100%'>
<tr>
<th>Sr. No.</th>
<th>Car Category</th>
<th>Category Description</th>
<th>Update</th>
<th>Delete</th>
</tr>";
$count=0;
while($row = mysql_fetch_array($res)) {
  $count=$count+1;
  echo "<tr id='carCategory" . $row['productCatId'] ."'>";
  echo "<td>" . $count . "</td>";
  echo "<td>" . $row['productCatName'] . "</td>";
  echo "<td>" . $row['productCatDesc'] . "</td>";
  echo "<td><form action='addUpdateCarCategories.php' method='post'><input type='hidden' name='carCatID' value=" . $row['productCatId'] ."><input type='submit' name='updateCarCategory' value='Update Car Category' class='button' style='align:center; display: block; margin: 0 auto;'></form> </td>";
  echo "<td><button type='button' class='button' style='align:center; display: block; margin: 0 auto;' onclick='javascript:deleteCarCategory(" . $row['productCatId'] . ")'>Delete</button> </td>";
  echo "</tr>";
}
echo "</table>";
mysql_close($con);
				
		echo '		
			</div>
			<br/><br/>
			<div id="car" name="car" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%">
				<form action = "addUpdateCars.php" method="post">
					<input type="submit" class="button" name="addCar" value="Add New Car" style="align:center; display: block; margin: 0 auto;">
				</form>';

$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Connection could not be established.');
}	
mysql_select_db('carRentalDB',$con);
$sql="Select c.carId, c.carManufacturer, c.carModel, c.carRegistrationNumber, c.carManufactureYear, pc.productCatName from Cars c, ProductCategories pc where pc.productCatId = c.carCategoryId";
$res = mysql_query($sql);

echo "<table border='1' width='100%'>
<tr>
<th>Sr. No.</th>
<th>Car</th>
<th>Category</th>
<th>Registration Number</th>
<th>Manufactured In</th>
<th>Image</th>
<th>Update</th>
<th>Delete</th>
</tr>";
$count=0;
while($row = mysql_fetch_array($res)) {
  $count=$count+1;
  echo "<tr id='car" . $row['carId'] ."'>";
  echo "<td>" . $count . "</td>";
  echo "<td>" . $row['carManufacturer'] . " " . $row['carModel'] ."</td>";
  echo "<td>" . $row['productCatName'] . "</td>";
  echo "<td>" . $row['carRegistrationNumber'] . "</td>";
  echo "<td>" . $row['carManufactureYear'] . "</td>";
  echo "<td><img src='".$row['carImage']."'></td>";
  echo "<td><form action='addUpdateCars.php' method='post'><input type='hidden' name='carId' value=" . $row['carId'] ."><input type='submit' name='updateCar' value='Update Car' class='button' style='align:center; display: block; margin: 0 auto;'></form> </td>";
  echo "<td><button type='button' class='button' style='align:center; display: block; margin: 0 auto;' onclick='javascript:deleteCar(" . $row['carId'] . ")'>Delete</button> </td>";
  echo "</tr>";
}
echo "</table>";
mysql_close($con);

		echo '		
			</div>
			<br/><br/>
			<div id="specialSales" name="specialSales" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%;">
				<form action = "addUpdateSpecialSales.php" method="post">
					<input type="submit" class="button" name="addSpecialSales" value="Add New Special Sales Offer" style="align:center; display: block; margin: 0 auto;">
				</form>';
				
$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Connection could not be established.');
}	
mysql_select_db('carRentalDB',$con);
$sql="Select ss.specialSalesId, ss.specialSalesProductCatId, ss.specialSalesStartDate, ss.specialSalesEndDate, pc.productCatName from SpecialSales ss, ProductCategories pc where ss.specialSalesProductCatId = pc.productCatId";
$res = mysql_query($sql);

echo "<table border='1' width='100%'>
<tr>
<th>Sr. No.</th>
<th>Car Category</th>
<th>Start Date</th>
<th>End Date</th>
<th>Update</th>
<th>Delete</th>
</tr>";
$count=0;
while($row = mysql_fetch_array($res)) {
  $count=$count+1;
  echo "<tr id='specialSales" . $row['specialSalesId'] ."'>";
  echo "<td>" . $count . "</td>";
  echo "<td>" . $row['productCatName'] . "</td>";
  echo "<td>" . $row['specialSalesStartDate'] . "</td>";
  echo "<td>" . $row['specialSalesEndDate'] . "</td>";
  echo "<td><form action='addUpdateSpecialSales.php' method='post'><input type='hidden' name='specialSalesID' value=" . $row['specialSalesId'] ."><input type='submit' name='updateSpecialSales' value='Update Special Sales' class='button' style='align:center; display: block; margin: 0 auto;'></form> </td>";
  echo "<td><button type='button' class='button' style='align:center; display: block; margin: 0 auto;' onclick='javascript:deleteSpecialSales(" . $row['specialSalesId'] . ")'>Delete</button> </td>";
  echo "</tr>";
}
echo "</table>";
mysql_close($con);

echo '	
				
			</div>
		<div>
	</body>
	<script type="text/javascript">
		document.getElementById("carCategories").style.display="none";
		document.getElementById("car").style.display="none";
		document.getElementById("specialSales").style.display="none";
		function showAddUpdateProducts()
		{
			document.getElementById("carCategories").style.display="none";
			document.getElementById("car").style.display="block";
			document.getElementById("specialSales").style.display="none";		
		}
		function showAddUpdateProductCategories()
		{
			document.getElementById("carCategories").style.display="block";
			document.getElementById("car").style.display="none";
			document.getElementById("specialSales").style.display="none";		
		}
		function showAddUpdateSpecials()
		{
			document.getElementById("carCategories").style.display="none";
			document.getElementById("car").style.display="none";
			document.getElementById("specialSales").style.display="block";		
		}
	function deleteCar(carId)
	{
		var confirmDelete = confirm("Are you sure you want to delete this Car record?");
		if(confirmDelete == true)
		{
			elementId = "car" + carId;
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
    			}
  			}	
  			xmlhttp.open("GET","deleteCar.php?q="+carId,true);
  			xmlhttp.send();
  		}	
	}
	function deleteCarCategory(carCatId)
	{
		var confirmDelete = confirm("Are you sure you want to delete this Car Category record?");
		if(confirmDelete == true)
		{
			elementId = "carCategory" + carCatId;
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
  			xmlhttp.open("GET","deleteCarCategory.php?q="+carCatId,true);
  			xmlhttp.send();
  		}	
	}
	function deleteSpecialSales(ssId)
	{
		var confirmDelete = confirm("Are you sure you want to delete this Special Sales record?");
		if(confirmDelete == true)
		{
			elementId = "specialSales" + ssId;
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
  			xmlhttp.open("GET","deleteSpecialSales.php?q="+ssId,true);
  			xmlhttp.send();
  		}	
	}
	</script>
</html>';		