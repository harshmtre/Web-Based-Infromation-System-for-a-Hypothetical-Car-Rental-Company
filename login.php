<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$errmsg = "";
if(strlen($username)==0)
{
	$errmsg = "Invalid Login. Please try again.";
}
if(strlen($password)==0)
{
	$errmsg = "Invalid Login. Please try again.";	
}
if(strlen($username)==0 && strlen($password)==0)
{
	$errmsg = "";
}
if(strlen($username)>0 && strlen($password)>0)
{
	$sql = "select userType from Users where username='$username' and password='$password'";
	$con = mysql_connect('localhost','root','909Cuppy');
	if(!$con)
	{
		die('dead');
	}	
	mysql_select_db('carRentalDB',$con);
	$res = mysql_query($sql);
	if(!($row = mysql_fetch_array($res)))
	{
		$errmsg = "Invalid Login. Please try again.";
	}
	mysql_close($con);
}
if(strlen($errmsg)>0)
{
	require 'prelogin.html';
	echo "<p>$errmsg</p>";
	require 'postlogin.html';
}
else
{
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['timeout'] = time();
	$sql = "select userType from Users where username='$username' and password='$password'";
	$con = mysql_connect('localhost','root','909Cuppy');
	if(!$con)
	{
		die('dead');
	}	
	mysql_select_db('carRentalDB',$con);
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res))
	{
		break;
	}
	if($row['userType'] == 'Employee')
	{
		header('Location: http://cs-server.usc.edu:9046/CSCI571HW/employeeMainPage.php');
	}
	elseif($row['userType'] == 'Manager')
	{
		header('Location: http://cs-server.usc.edu:9046/CSCI571HW/managerMainPage.php');
	}
	elseif($row['userType'] == 'Administrator')
	{
		header('Location: http://cs-server.usc.edu:9046/CSCI571HW/adminMainPage.php');
	}
	else
	{
	require 'prelogin.html';
	require 'postlogin.html';
	}
	
	mysql_close($con);
}

?>