<?php

	class Customermainpage_m extends CI_model {
	
		public function __construct()
		{
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die("Could not connect to the database...");
			}
			mysql_select_DB('carRentalDB',$con);
		}
		
		public function getCustomer($activeUser)
		{
			$sql = 'Select * from Customers where username = "'.$activeUser.'";'; 
			$res = mysql_query($sql);
			return array("resultSet" => $res);
		}
	
	}

?>