<?php

class Checkcustomerusernameavailability_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$con = mysql_connect("localhost","root","909Cuppy");
		if(!$con)
		{
			die("Could not connect to the Database");
		}
		mysql_select_db('carRentalDB',$con);
	}
	
	public function checkAvailability($username)
	{
		$sql = "Select * from Customers Where username='".$username."';";
		$res = mysql_query($sql);
		return array("resultSet" => $res);
	}
}

?>