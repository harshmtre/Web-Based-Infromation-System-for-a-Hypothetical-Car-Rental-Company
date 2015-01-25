<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/customerLogin.php");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/customerLogin.php");
	}
}
$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Could not connect to the database');
}	
mysql_select_db('carRentalDB',$con);
$sql = "Update Customers set password = '".$_POST['password']."', customerFname = '".$_POST['customerFname']."', customerLname = '".$_POST['customerLname']."', customerDob = '".$_POST['customerDob']."', customerAge = ".$_POST['customerAge'].", customerEmail = '".$_POST['customerEmail']."', customerPhone = '".$_POST['customerPhone']."', customerAddress = '".$_POST['customerAddress']."', customerCCNumber = '".$_POST['customerCCNumber']."', customerCCName = '".$_POST['customerCCName']."', customerBillingAddress='".$_POST['customerBillingAddress']."', customerCCCVV = ".$_POST['customerCCCVV'].", customerCCExpDate = '".$_POST['customerCCExpDate']."' WHERE username = '".$_POST['username']."';";
mysql_query($sql);
header('Location: http://cs-server.usc.edu:9046/CSCI571HW/customerMainPage.php');
?>