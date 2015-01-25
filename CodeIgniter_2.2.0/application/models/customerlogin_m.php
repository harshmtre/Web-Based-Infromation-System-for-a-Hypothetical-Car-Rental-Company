<?php
	class Customerlogin_m extends CI_Model {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function getCustomerUsername($username, $password)
		{
			$sql = "select username from Customers where username=? and password=?";
			$data = array($username, $password);
			$res = $this->db->query($sql, $data);
			return array("resultSet" => $res);
		}	
	
	}
?>