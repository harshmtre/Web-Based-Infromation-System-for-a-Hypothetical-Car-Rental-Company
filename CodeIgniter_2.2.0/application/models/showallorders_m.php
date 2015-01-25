<?php

class Showallorders_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$con = mysql_connect('localhost','root','909Cuppy'); 
		if(!$con)
		{
			die("Could not connect to the database...");
		}
		mysql_select_DB('carRentalDB',$con);	
	}
	
	public function showOrders($username)
	{
		$sql = "Select * from Orders where customerUsername = '".$username."';";
		$res = mysql_query($sql);
		return array("resultSet" => $res);
	}
}

?>