<?php

class Populatecars_m extends CI_Model {
	
		public function __construct()
		{
			parent::__construct();
			$con = mysql_connect('localhost','root','909Cuppy');
			if(!$con)
			{
				die('Could not establish connection to database...');
			}	
			mysql_select_db('carRentalDB',$con);
			$this->getCars();
		}
	
		public function getCars($category)
		{
			$sql1="Select productCatId from ProductCategories Where productCatName='".$category."';";
			$res1 = mysql_query($sql1);
			while($row = mysql_fetch_array($res1)) 
			{
				break;
			}
			$sql2="Select * from Cars Where carCategoryId=".$row['productCatId'].";";
			$res2 = mysql_query($sql2);
			return array("resultSet" => $res2);			
		}
		
}

?>