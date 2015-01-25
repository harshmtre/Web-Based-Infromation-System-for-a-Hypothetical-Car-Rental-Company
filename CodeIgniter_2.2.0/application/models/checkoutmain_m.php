<?php

class Checkoutmain_m extends CI_Model
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
	public function getCustomer($username)
	{
		$sql1 = "Select * from Customers WHERE username = '".$username."';";
		$res1 = mysql_query($sql1);
		return array("resultSet1" => $res1);
	}
	public function getCustomerCart($username)
	{
		$sql2 = "Select * from CustomerCarts WHERE customerUsername = '".$username."';";
		$res2 = mysql_query($sql2);
		return array("resultSet2" => $res2);
	}
	public function getTotalCost($username)
	{
		$sql = "Select totalCost from CustomerCarts where customerUsername = '".$username."';";
		$res = mysql_query($sql);
		return array("resultSet" => $res);
	}
}

?>