<?php
session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['timeout'] = time();
$con = mysql_connect("localhost","root","909Cuppy");
if(!$con)
{
	die("Could not connect to the Database");
}
mysql_select_db('carRentalDB',$con);
$sql = "Insert into Customers values ('".$_POST['username']."', '".$_POST['password']."', '".$_POST['customerFname']."', '".$_POST['customerLname']."', '".$_POST['customerDob']."', ".$_POST['customerAge'].", '".$_POST['customerEmail']."', '".$_POST['customerPhone']."', '".$_POST['customerAddress']."', '".$_POST['customerCCNumber']."', '".$_POST['customerCCName']."', '".$_POST['customerBillingAddress']."', ".$_POST['customerCCCVV'].", '".$_POST['customerCCExpDate']."', NULL);";
mysql_query($sql);
header('Location: http://cs-server.usc.edu:9046/CSCI571HW/mainPage.php')
?>