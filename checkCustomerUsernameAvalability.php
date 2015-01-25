<?php
$con = mysql_connect("localhost","root","909Cuppy");
if(!$con)
{
	die("Could not connect to the Database");
}
$sql = "Select * from Customers Where username='".$_POST['username']."';";
mysql_select_db('carRentalDB',$con);
$res = mysql_query($sql);
if(!($row = mysql_fetch_array($res)))
{
	echo'available';
}
else
{
	echo'unavailable';
}
?>