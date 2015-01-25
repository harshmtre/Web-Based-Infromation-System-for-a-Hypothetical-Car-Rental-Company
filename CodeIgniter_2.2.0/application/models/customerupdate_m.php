<?php
class Customerupdate_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$con = mysql_connect("localhost","root","909Cuppy");
		if(!$con)
		{
			die("Could not establish connection to Database");
		}
		mysql_selectDB('carRentalDB',$con);
	}
	
	public function getCustomer()
	{
		$sql = "Select * from Customers Where username='". $_SESSION['username'] ."'";
		$res = mysql_query($sql);
		return array("resultSet" => $res);
	}
}
?>