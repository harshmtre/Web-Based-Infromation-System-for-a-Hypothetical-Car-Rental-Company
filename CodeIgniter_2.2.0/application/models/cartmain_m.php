<?php

class Cartmain_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$con = mysql_connect('localhost','root','909Cuppy');
		if(!$con)
		{
			die('Could not connect to the database');
		}	
		mysql_select_db('carRentalDB',$con);
	}
	
	public function insertInCart($addOn)
	{
		$sql1 = "Select * from AddOnProducts where productId =".$addOn.";";
		$res1 = mysql_query($sql1);
		while($row1 = mysql_fetch_array($res1))
		{
			$productId =  $row1['productId'];
			$pickupDate = strtotime($_SESSION['pickupDate']);
			$returnDate = strtotime($_SESSION['returnDate']);
			$dateDiff = $returnDate - $pickupDate;
			$noOfDays = floor($dateDiff/(60*60*24));
			$productPrice = $row1['productPrice'];
			$totalCost = $noOfDays * $productPrice;
			$sql="Select * from CustomerCarts WHERE customerUsername='".$_SESSION['username']."' and productId=".$productId." and fromDate='".$_SESSION['pickupDate']."' and toDate='".$_SESSION['returnDate']."' and productType = 'AddOn';";
			$res = mysql_query($sql);
			if(!$row = mysql_fetch_array($res))
			{
				$sql2="Insert into CustomerCarts values(NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$productId.", ".$productPrice.", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'AddOn')";
				mysql_query($sql2);
			}
		}
	}
	
	public function getCartItems($username)
	{
		$sql3 = "Select * from CustomerCarts WHERE customerUsername='".$username."';";
		$res3 = mysql_query($sql3);
		return array("resultSet" => $res3);
	}
	
}

?>