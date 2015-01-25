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
	$sqlUpdate="Update ProductCategories Set productCatName='". $_POST['productCatName'] ."', productCatDesc='". $_POST['productCatDesc'] ."' Where productCatId=". $_POST['productCatId'] .";";
	mysql_query($sqlUpdate);
}
if(isset($_POST['add']))
{

	$sqlInsertCarCat= "INSERT INTO ProductCategories VALUES (NULL , '". $_POST['productCatName'] ."', '". $_POST['productCatDesc'] ."');";
	mysql_query($sqlInsertCarCat);
}
mysql_close($con);
header('Location: http://cs-server.usc.edu:9046/CSCI571HW/employeeMainPage.php');
?>