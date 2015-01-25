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
	$sql = "select username from Customers where username='$username' and password='$password'";
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
	require 'customerPreLogin.html';
	echo "<p>$errmsg</p>";
	require 'customerPostLogin.html';
}
else
{
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['timeout'] = time();
	$sql = "select username from Customers where username='$username' and password='$password'";
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
	if($row['username'] != '')
	{
		header('Location: http://cs-server.usc.edu:9046/CSCI571HW/mainPage.php');
	}
	else
	{
	require 'customerPreLogin.html';
	require 'customerPostLogin.html';
	}
	
	mysql_close($con);
}

?>