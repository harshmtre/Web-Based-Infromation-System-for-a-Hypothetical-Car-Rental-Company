<?php

class Mainpage_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getCustomer($username)
	{
		$sql = "Select * from Customers WHERE username = ? ;";
		$data = array($username);
		$res = $this->db->query($sql, $data);
		return array("resultSet" => $res);
		
	}
	public function getRentalLocations()
	{	
		$sql2 = "Select location from RentalLocations;";
		$res2 = $this->db->query($sql2);
		return array("resultSet2" => $res2);
	}	
	public function getProductCategories()
	{	
		$sql3 = "Select productCatName from ProductCategories;";
		$res3 = $this->db->query($sql3);
		return array("resultSet3" => $res3);
	}	
	public function getSpecialSales()
	{
		$sql4 = "Select s.*, p.productCatName from SpecialSales s, ProductCategories p where p.productCatId = s.specialSalesProductCatId ;";
		$res4 = $this->db->query($sql4);
		return array("resultSet4" => $res4);
	}
}

?>