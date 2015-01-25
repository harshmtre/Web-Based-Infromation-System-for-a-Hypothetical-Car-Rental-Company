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
	if($_POST['prodCategory']!= "NA")
	{
		$sqlUpdate="Update Cars Set carCategoryId=". $_POST['prodCategory'] .", carManufacturer='". $_POST['carManufacturer'] ."', carModel='". $_POST['carModel'] ."', carManufactureYear=". $_POST['carManufactureYear'] .", carRegistrationNumber='". $_POST['carRegistrationNumber'] ."', carInsurancePolicyNumber='". $_POST['carInsurancePolicyNumber'] ."', carDescription='". $_POST['carDescription'] ."', carPrice=". $_POST['carPrice'] .", carScheduledMaintenance='". $_POST['carScheduledMaintenance'] ."' Where carId = ". $_POST['carId'] .";";
	}
	else
	{
		$sqlUpdate="Update Cars Set carManufacturer='". $_POST['carManufacturer'] ."', carModel='". $_POST['carModel'] ."', carManufactureYear=". $_POST['carManufactureYear'] .", carRegistrationNumber='". $_POST['carRegistrationNumber'] ."', carInsurancePolicyNumber='". $_POST['carInsurancePolicyNumber'] ."', carDescription='". $_POST['carDescription'] ."', carPrice=". $_POST['carPrice'] .", carScheduledMaintenance='". $_POST['carScheduledMaintenance'] ."' Where carId = ". $_POST['carId'] .";";
	}

	mysql_query($sqlUpdate);
}
if(isset($_POST['add']))
{
	if($_POST['prodCategory']!= "NA" || $_POST['prodCategory']!= "" || $_POST['prodCategory']!= NULL)
	{
		$sqlInsertCars= "INSERT INTO Cars VALUES (NULL ,". $_POST['prodCategory'] .", '". $_POST['carManufacturer'] ."', '". $_POST['carModel'] ."', ". $_POST['carManufactureYear'] .", '". $_POST['carRegistrationNumber'] ."', '". $_POST['carInsurancePolicyNumber'] ."', '". $_POST['carDescription'] ."', ". $_POST['carPrice'] .", '". $_POST['carScheduledMaintenance'] ."','". $_POST['carImage'] ."');";	
	}
	else
	{
		$sqlInsertCars= "INSERT INTO Cars VALUES (NULL , NULL, '". $_POST['carManufacturer'] ."', '". $_POST['carModel'] ."', ". $_POST['carManufactureYear'] .", '". $_POST['carRegistrationNumber'] ."', '". $_POST['carInsurancePolicyNumber'] ."', '". $_POST['carDescription'] ."', ". $_POST['carPrice'] .", '". $_POST['carScheduledMaintenance'] ."','". $_POST['carImage'] ."');";
	}
	mysql_query($sqlInsertCars);
}
mysql_close($con);
header('Location: http://cs-server.usc.edu:9046/CSCI571HW/employeeMainPage.php');
?>
