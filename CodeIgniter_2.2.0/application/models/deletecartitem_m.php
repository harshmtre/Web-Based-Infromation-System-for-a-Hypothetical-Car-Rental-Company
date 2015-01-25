<?php

class Deletecartitem_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$con = mysql_connect('localhost','root','909Cuppy');
		if(!$con)
		{
			die('dead');
		}	
		mysql_select_db('carRentalDB',$con);
	}
	public function deleteItem($cartEntryId)
	{
		$sql1="Select * from CustomerCarts where cartEntryId=".$cartEntryId.";";
		$res1 = mysql_query($sql1);
		while($row1 = mysql_fetch_array($res1))
		{
			break;
		}
		$customerUsername = $row1['customerUsername'];
		$fromDate=$row1['fromDate'];
		$toDate=$row1['toDate'];
		$productType = $row1['productType'];
		if($cartEntryId == 0)
		{
			$sql = "Delete from CustomerCarts WHERE customerUsername='".$_SESSION['username']."';";
			mysql_query($sql);
			$cartItemsDeleted = "0,";
			return array("cartItemsDeleted" => $cartItemsDeleted);
		}
		if($productType == "Car")
		{
			$sql2 = "Select * from CustomerCarts WHERE customerUsername='".$customerUsername."' AND toDate='".$toDate."' AND fromDate='".$fromDate."';";
			$res2 = mysql_query($sql2);
			$cartItemsDeleted = "";
			while($row2 = mysql_fetch_array($res2))
			{
				$cartItemsDeleted = "".$cartItemsDeleted."".$row2['cartEntryId'].",";
			}
			$sql3="Delete from CustomerCarts Where customerUsername='".$_SESSION['username']."' AND toDate='".$toDate."' AND fromDate='".$fromDate."';";
			mysql_query($sql3);
			return array("cartItemsDeleted" => $cartItemsDeleted);
		}
		else
		{
			$sql2="Select * from CustomerCarts WHERE cartEntryId=".$cartEntryId.";";
			$res2=mysql_query($sql2);
			$cartItemsDeleted = "";
			while($row2 = mysql_fetch_array($res2))
			{
				$cartItemsDeleted = "".$cartItemsDeleted."".$row2['cartEntryId'].",";
			}
			$sql3="Delete from CustomerCarts Where cartEntryId=".$cartEntryId.";";
			mysql_query($sql3);
			return array("cartItemsDeleted" => $cartItemsDeleted);
		}
	}
}

?>