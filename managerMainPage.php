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
		<title>Manager Main Page</title>
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
		<div id="managerMainDiv" name="adminMainDiv" style="width:80%;background:#ffffff;margin:0 auto;">
			<table width="100%">
				<tr>
					<td><form action="logout.php"><input type="submit" name="logout" value="Logout" class="button" style="display: inline; margin: 0 auto;"></form></td>
				</tr>
			</table>
			<img src="businessReports.png" style="display:block;margin-left: auto;margin-right: auto;">
			<table id="employeeMain" width="100%" style="text-align:center">
				<tr>
					<td width="25%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showEmployeeReports();">Employee Reports</button></td>
					<td width="25%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showProductReports();">Product Reports</button></td>
					<td width="25%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showSpecialSalesReports();">Special Sales Reports</button></td>
					<td width="25%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="javascript:showOrderReports();">Order Reports</button></td>
				</tr>
			</table>			
		</div>
		<div id="employeeReports" name="employeeReports" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%">
			<form name="empByType" action="" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Choose The Type of Employees: </label></td>
						<td align="center" width="50%"><select id="employeeType" name="employeeType">
								<option value="NA">Select A Type</option>
								<option value="Manager">Manager</option>
								<option value="Administrator">Administrator</option>
								<option value="Employee">Employee</option>
							</select></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showEmployeeByType()">Go</button></td>
					</tr>
				</table><br>	
			</form>
			<div id="empByTypeSolution">
			</div>
			<form name="empBySalaryRange" action="">
				<table width="100%">
					<tr>
						<td align="center" width="20%"><label>Choose The Salary Range: </label></td>
						<td align="center" width="30%"><input type="text" id="empFromSalary" name="empFromSalary" class="tb"></td>
						<td align="center" width="30%"><input type="text" id="empToSalary" name="empToSalary" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showEmployeeBySalary()">Go</button></td>
					</tr>
				</table>			
			</form>
			<div id="empBySalaryRangeSolutions">
			</div>
		</div>
		<div id="productReports" name="productReports" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%">
			<form name="prodByPrice" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Enter The Price For Product Search: </label></td>
						<td align="center" width="50%"><input type="text" id="prodPrice" name="prodPrice" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showProdByPrice()">Go</button></td>
					</tr>
				</table>			
			</form>
			<div id="prodByPriceSolution">
			</div>
			<form name="prodByName" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Enter Product Name For Search: </label></td>
						<td align="center" width="50%"><input type="text" id="prodName" name="prodName" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showProdByName()">Go</button></td>
					</tr>
				</table>			
			</form>
			<div id="prodByNameSolution">
			</div>';
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('Could not establish connection to database...');
			}	
			mysql_select_db('carRentalDB',$con);
			$sql="Select Distinct(productCatName), productCatId from ProductCategories;";
			$res = mysql_query($sql);
			echo'<form name="prodByCategory" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Select Product Category For Search: </label></td>
						<td align="center" width="50%"><select id="prodCat" name="prodCat">
								<option value="NA">Select A Type</option>';			 
								while($row = mysql_fetch_array($res)) {
								echo '<option value="'.$row['productCatId'].'">'.$row['productCatName'].'</option>';
								}
							echo '</select></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showProdByCategory()">Go</button></td>
					</tr>
				</table>			
			</form>';
			mysql_close($con);
		echo '
		
		<div id="prodByCatSolution">
		</div>
		</div>
		<div id="specialSalesReports" name="specialSalesReports" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%">
			<form name="ssByProdPrice" action="">
				<table width="100%">
					<tr>
						<td align="center" width="20%"><label>Choose The Price Range: </label></td>
						<td align="center" width="30%"><input type="text" id="prodFromPrice" name="prodFromPrice" class="tb"></td>
						<td align="center" width="30%"><input type="text" id="prodToPrice" name="productToPrice" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showSsByPrice()">Go</button></td>
					</tr>
				</table>				
			</form>
			<div id="ssByPriceSolution">
			</div>
			<form name="ssByProdName" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Enter Product Name For Search: </label></td>
						<td align="center" width="50%"><input type="text" id="ssProdName" name="ssProdName" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showSsByPN()">Go</button></td>
					</tr>
				</table>
			</form>
			<div id="ssByPNSolution">;
			</div>';
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('Could not establish connection to database...');
			}	
			mysql_select_db('carRentalDB',$con);
			$sql="Select Distinct(productCatName), productCatId from ProductCategories;";
			$res = mysql_query($sql);
			echo'<form name="ssByCategory" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Select Product Category For Search: </label></td>
						<td align="center" width="50%"><select id="ssProdCat" name="ssProdCat">
								<option value="NA">Select A Type</option>;';			 
								while($row = mysql_fetch_array($res)) {
								echo '<option value="'.$row['productCatId'].'">'.$row['productCatName'].'</option>';
								}
							echo '</select></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showSsByCat()">Go</button></td>
					</tr>
				</table>			
			</form>';
			mysql_close($con);
		echo '
			<div id="ssByCatSolution">
			</div>
			<form name="ssByStartDate" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Enter Start Date For Search: </label></td>
						<td align="center" width="50%"><input type="text" id="ssStartDate" name="ssStartDate" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showSsBySD()">Go</button></td>
					</tr>
				</table>
			</form>
			<div id="ssBySDSolution">
			</div>
			<form name="ssByEndDate" action="">
				<table width="100%">
					<tr>
						<td align="center" width="30%"><label>Enter End Date For Search: </label></td>
						<td align="center" width="50%"><input type="text" id="ssEndDate" name="ssEndDate" class="tb"></td>
						<td align="center" width="10%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showSsByED()">Go</button></td>
					</tr>
				</table>
			</form>
			<div id="ssByEDSolution">
			</div>
		</div>
		<div id="orderReports" name="orderReports" style="width:80%;background:#ffffff;margin:0 auto;padding-bottom:5%">	
			<table width= 100%>
				<tr>
					<th>Order Reports</th>
				</tr>
			</table>
			<form name="orderReportForm" action="">
				<table width="100%">
					<tr>
						<td> To see all Orders, leave the fields below blank <tr>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td align="center" width="25%"><label>Orders Starting From: </label></td>
						<td align="center" width="25%"><input type="text" id="orderStartDate" name="orderStartDate" onChange="javascript:checkDate(\'orderStartDate\')" class="tb datepicker"></td>
						<td align="center" width="25%"><label>Orders Till: </label></td>
						<td align="center" width="25%"><input type="text" id="orderEndDate" name="orderEndDate" onChange="javascript:checkDate(\'orderEndDate\')" class="tb datepicker"></td>
					</tr>
					<tr>
						<td align="center" width="25%"><label>Total Cost Starting From: </label></td>
						<td align="center" width="25%"><input type="text" id="orderStartCost" name="orderStartCost" onkeypress="return checkIfNumber(event)" class="tb"></td>
						<td align="center" width="25%"><label>Total Cost Till: </label></td>
						<td align="center" width="25%"><input type="text" id="orderEndCost" name="orderEndCost" onkeypress="return checkIfNumber(event)" class="tb"></td>
					</tr>
					<tr>
						<td align="center" width="25%"><label></label></td>
						<td align="center" width="25%"><label>Get Report: </label></td>
						<td align="center" width="25%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showOrderReportSolution()">Go</button></td>
						<td align="center" width="25%"></td>
					</tr>
				</table>
			</form>
			<div id="orderReportSolution">
			</div>
			<table width= 100%>
				<tr>
					<th>Sales Reports for Cars</th>
				</tr>
			</table>
			<form name="productSalesForm" action="">
				<table width="100%">
					<tr>
						<td> To see Total Sales Report for all Cars, leave the fields below blank <tr>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td align="center" width="25%"><label>Sales Starting From: </label></td>
						<td align="center" width="25%"><input type="text" id="salesStartDate" name="salesStartDate" onChange="javascript:checkDate(\'salesStartDate\')" class="tb datepicker"></td>
						<td align="center" width="25%"><label>Sales Till: </label></td>
						<td align="center" width="25%"><input type="text" id="salesEndDate" name="salesEndDate" onChange="javascript:checkDate(\'salesEndDate\')" class="tb datepicker"></td>
					</tr>
					<tr>
						<td align="center" width="25%"><label>Car Category: </label></td>
						<td align="center" width="25%"><select id="productCategoryId" name="productCategoryId">
				<option value="">Select A Category</option>';
				$con = mysql_connect("localhost","root","909Cuppy");
				if(!$con)
				{
					die("Could not connect to the database...");
				}
				mysql_select_db("carRentalDB",$con);
				$sql = "Select productCatName, productCatId from ProductCategories;";
				$res = mysql_query($sql);
				while($row = mysql_fetch_array($res))
				{
					$productCatName = $row['productCatName'];
					echo'<option value='.$row['productCatId'].'>'.$productCatName.'</option>';
				}
				echo
				'</select></td>
						<td align="center" width="25%"><label>Show Special Sales Only: </label></td>
						<td align="center" width="25%"><input type="radio" id="specialSales" name="specialSales" value="yes">Yes<input type="radio" id="specialSales" name="specialSales" value="no" checked>No</td>
					</tr>
					<tr>
						<td align="center" width="25%"><label></label></td>
						<td align="center" width="25%"><label>Get Report: </label></td>
						<td align="center" width="25%"><button type="button" class="button" style="align:center; display: block; margin: 0 auto;" onclick="javascript:showSalesReportSolution()">Go</button></td>
						<td align="center" width="25%"></td>
					</tr>
				</table>
			</form>
			<div id="salesReportSolution">	
			</div>
		</div>
		
	</body>
	<script>
	$(function() {
    	$( ".datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
  	});
  	var DATE= true;
  	function checkDate(field) //source: http://www.javascriptkit.com/script/script2/validatedate.shtml
	{
		if(document.getElementById(field).value == "")
		{
			DATE = true;
			return true;
		}
		var validformat=/^\d{4}\-\d{2}\-\d{2}$/; //Basic check for format validity
		var returnval=false;
		if (!validformat.test(document.getElementById(field).value))
		{
			DOB = false;
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
				DATE = true;
				returnval=true;
				getAgeFromDate();
			}			
		}
		if (returnval==false) 
		{
			DATE = false;
		}	
		return returnval
	}
	function checkIfNumber(keyPressed) {
    	keyPressed = (keyPressed) ? keyPressed : window.event;
	    var charCode = (keyPressed.which) ? keyPressed.which : keyPressed.keyCode;
    	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        	return false;
    	}
    	return true;
	}
	function showOrderReportSolution()
	{
		$.post("searchOrders.php",
  		{
    		startDate:$("#orderStartDate").val(),
    		endDate:$("#orderEndDate").val(),
    		startCost:$("#orderStartCost").val(),
    		endCost:$("#orderEndCost").val()
  		},
  		function(data,status){
    		$("#orderReportSolution").html(data);
 		 });
	}
	function showSalesReportSolution()
	{
		var selectedCategory = 0;
		for(i=0; i<document.getElementById("productCategoryId").length; i++) 
  		{
     		if (document.getElementById("productCategoryId")[i].selected)
     		{
        		selectedCategory = i;
     		}
  		}
  		var ss = "";
  		var specialSalesInput = document.getElementsByName("specialSales");
		for (var i = 0; i < specialSalesInput.length; i++) 
		{
   			if (specialSalesInput[i].checked) 
   			{
   				ss=specialSalesInput[i].value;
    		}
		}
		$.post("searchSales.php",
  		{
    		startDate:$("#salesStartDate").val(),
    		endDate:$("#salesEndDate").val(),
    		productCategoryId:selectedCategory,
    		specialSales:ss
  		},
  		function(data,status){
    		$("#salesReportSolution").html(data);
 		 });
	}
	</script>
	<script type="text/javascript">
	document.getElementById("employeeReports").style.display="none";
	document.getElementById("productReports").style.display="none";
	document.getElementById("specialSalesReports").style.display="none";
	document.getElementById("orderReports").style.display="none";
	
	function showEmployeeReports()
	{
		document.getElementById("employeeReports").style.display="block";
		document.getElementById("productReports").style.display="none";
		document.getElementById("specialSalesReports").style.display="none";
		document.getElementById("orderReports").style.display="none";
	}
	function showProductReports()
	{
		document.getElementById("employeeReports").style.display="none";
		document.getElementById("productReports").style.display="block";
		document.getElementById("specialSalesReports").style.display="none";
		document.getElementById("orderReports").style.display="none";
	}
	function showSpecialSalesReports()
	{
		document.getElementById("employeeReports").style.display="none";
		document.getElementById("productReports").style.display="none";
		document.getElementById("specialSalesReports").style.display="block";
		document.getElementById("orderReports").style.display="none";
	}
	function showOrderReports()
	{
		document.getElementById("employeeReports").style.display="none";
		document.getElementById("productReports").style.display="none";
		document.getElementById("specialSalesReports").style.display="none";
		document.getElementById("orderReports").style.display="block";
	}
	function showEmployeeByType()
	{
		var selected_index = document.getElementById("employeeType").selectedIndex;
		input = document.getElementById("employeeType").options[selected_index].value;
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
      			document.getElementById("empByTypeSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchEmpByType.php?q="+input,true);
  		xmlhttp.send();			
	} 
	function showEmployeeBySalary()
	{
		var input1 = document.getElementById("empFromSalary").value;
		var input2 = document.getElementById("empToSalary").value;
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
      			document.getElementById("empBySalaryRangeSolutions").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchEmpBySalary.php?q="+input1+"&r="+input2,true);
  		xmlhttp.send();			
	} 
	function showProdByPrice()
	{
		var input = document.getElementById("prodPrice").value;
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
      			document.getElementById("prodByPriceSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchProdByPrice.php?q="+input,true);
  		xmlhttp.send();			
	}
		function showProdByName()
	{
		var input = document.getElementById("prodName").value;
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
      			document.getElementById("prodByNameSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchProductByName.php?q="+input,true);
  		xmlhttp.send();			
	}
	 function showProdByCategory()
	 {
		var selected_index = document.getElementById("prodCat").selectedIndex;
		input = document.getElementById("prodCat").options[selected_index].value;
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
      			document.getElementById("prodByCatSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchProdByCat.php?q="+input,true);
  		xmlhttp.send();		 
	 }
	 function showSsBySD()
	 {
	 	var input = document.getElementById("ssStartDate").value;
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
      			document.getElementById("ssBySDSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchSsBySD.php?q="+input,true);
  		xmlhttp.send();	
	 }
	 function showSsByED()
	 {
	 	var input = document.getElementById("ssEndDate").value;
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
      			document.getElementById("ssByEDSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchSsByED.php?q="+input,true);
  		xmlhttp.send();		 
	 }	 
	 function showSsByPN()
	 {
	 	var input = document.getElementById("ssProdName").value;
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
      			document.getElementById("ssByPNSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchSsByPN.php?q="+input,true);
  		xmlhttp.send();		 	 	
	 }
	 function showSsByCat()
	 {
		var selected_index = document.getElementById("ssProdCat").selectedIndex;
		input = document.getElementById("ssProdCat").options[selected_index].value;
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
      			document.getElementById("ssByCatSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchSsByCat.php?q="+input,true);
  		xmlhttp.send();		 
	 }
	 function showSsByPrice()
	 {
		var input1 = document.getElementById("prodFromPrice").value;
		var input2 = document.getElementById("prodToPrice").value;
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
      			document.getElementById("ssByPriceSolution").innerHTML=xmlhttp.responseText;
    		}
  		}	
  		xmlhttp.open("GET","searchSsByPrice.php?q="+input1+"&r="+input2,true);
  		xmlhttp.send();			 	
	 }
	</script>
</html>	'
?>	