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
$q = $_GET['q'];
$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('dead');
}	
mysql_select_db('carRentalDB',$con);
$sql1="Delete from SpecialSales Where specialSalesId=" . $q . "";
mysql_query($sql1);
mysql_close($con);
?>