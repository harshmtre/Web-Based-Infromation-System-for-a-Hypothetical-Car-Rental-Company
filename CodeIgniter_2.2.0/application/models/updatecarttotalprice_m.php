<?php

class Updatecarttotalprice_m extends CI_Model
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
	
	public function updatePrice($username)
	{
		$sql = "Select totalCost from CustomerCarts where customerUsername = '".$username."';";
		$res = mysql_query($sql);
		return array("resultSet" => $res);
	}
}

?>