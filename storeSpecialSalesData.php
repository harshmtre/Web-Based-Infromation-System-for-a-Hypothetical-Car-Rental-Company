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
$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Could not connect to the database');
}	
mysql_select_db('carRentalDB',$con);

if(isset($_POST['update']))
{
	$category="select productCatId from ProductCategories Where productCatName = '". $_POST['carCategory'] ."';"; 
	$res = mysql_query($category);
	while($row = mysql_fetch_array($res))
	{
		break;
	}
	if($row['productCatId']!= NULL || $row['productCatId']!= '')
	{
		$sqlUpdate="Update SpecialSales Set specialSalesProductCatId=". $row['productCatId'] .", specialSalesStartDate='". $_POST['specialSalesStartDate'] ."', specialSalesEndDate='". $_POST['specialSalesEndDate'] ."', 	specialSalesDiscountPercent=". $_POST['specialSalesDiscountPercent'] ." Where specialSalesId = ". $_POST['specialSalesId'] .";";
	}
	else
	{
		$sqlUpdate="Update SpecialSales Set specialSalesStartDate='". $_POST['specialSalesStartDate'] ."', specialSalesEndDate='". $_POST['specialSalesEndDate'] ."', specialSalesDiscountPercent=". $_POST['specialSalesDiscountPercent'] ." Where specialSalesId = ". $_POST['specialSalesId'] .";";
	}
	mysql_query($sqlUpdate);
}
if(isset($_POST['add']))
{
	$category="select productCatId from ProductCategories Where productCatName = '". $_POST['carCategory'] ."';"; 
	$res2 = mysql_query($category);
	while($row = mysql_fetch_array($res2))
	{
		break;
	}
	if($row['productCatId']!= NULL || $row['productCatId']!= '')
	{
		$sqlInsertSS= "INSERT INTO SpecialSales VALUES (NULL ,". $row['productCatId'] .", '". $_POST['specialSalesStartDate'] ."', '". $_POST['specialSalesEndDate'] ."', ". $_POST['specialSalesDiscountPercent'] .");";
		echo $sqlInsertSS;
	}
	else
	{
		$sqlInsertSS= "INSERT INTO SpecialSales VALUES (NULL , NULL, '". $_POST['specialSalesStartDate'] ."', '". $_POST['specialSalesEndDate'] ."', ". $_POST['specialSalesDiscountPercent'] .");";
		echo $sqlInsertSS;
	}
	mysql_query($sqlInsertSS);
}
mysql_close($con);
header('Location: http://cs-server.usc.edu:9046/CSCI571HW/employeeMainPage.php');
?>