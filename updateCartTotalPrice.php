<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CustomerLogin.php");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CustomerLogin.php");
	}
}
$q = $_GET['q'];
$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('dead');
}	
$totalCost = 0;
mysql_select_db('carRentalDB',$con);
$sql = "Select totalCost from CustomerCarts where customerUsername = '".$_SESSION['username']."';";
$res = mysql_query($sql);
if(!$row = mysql_fetch_array($res))
{
	echo "$".$totalCost;
}
else
{
	$totalCost = $totalCost + $row['totalCost'];
	while($row = mysql_fetch_array($res))
	{
		$totalCost = $totalCost + $row['totalCost'];
	}
	echo "$".$totalCost;
}
mysql_close($con);
?>