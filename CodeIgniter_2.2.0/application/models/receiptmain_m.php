<?php

class Receiptmain_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function saveOrders($username, $totalCost, $customerBillingAddress, $customerAddress)
	{
		$date = date('Y-m-d');
		$sql1 = "Insert into Orders values (NULL, ?, ?, ?, ?, ?)";
		$data1=array($username, $date, (int) $totalCost, $customerBillingAddress, $customerAddress);
		$this->db->query($sql1, $data1);
		$sql2 = "Select MAX(orderId) as 'maxOrderId' from Orders";
		$res2 = $this->db->query($sql2);
		foreach ($res2->result_array() as $row2)
		{
			break;
		}
		
		$orderId = $row2['maxOrderId'];
		$sql3 = "Select * from CustomerCarts where customerUsername = ?";
		$data3 = array($username);
		$res3 = $this->db->query($sql3, $data3);
		foreach ($res3->result_array() as $row3)
		{
			$sql4 = "Insert into ProductsOrdered values (NULL, ?, ?, ?, ?, ?, ?)";
			$data4= array($orderId, $row3['productId'], $row3['totalCost'], $row3['productType'], $row3['fromDate'], $row3['toDate']);
			$this->db->query($sql4, $data4);
		}
		$sql5 = "Delete from CustomerCarts WHERE customerUsername= ?;";
		$data5 = array($username);
		$this->db->query($sql5, $data5);
		$sql6 = "Select * from ProductsOrdered Where orderId = ? AND productType = 'Car';";
		$data6 = array($orderId);
		$res6 = $this->db->query($sql6, $data6);
		if($res6->num_rows() == 0)
		{
			//Do Nothing
		}
		else
		{
			foreach ($res6->result_array() as $row6)
			{
				$sql7 = "Select * from ProductsOrdered Where orderId = ? AND productType = 'AddOn';";
				$data7 = array($orderId);
				$res7 = $this->db->query($sql7, $data7);
				if($res7->num_rows() == 0)
				{
					//do nothing
				}
				else
				{
					foreach ($res7->result_array() as $row7)
					{
						$carId = $row6['productId'];
						$addOnId = $row7['productId'];
						$sql8 = "Select * from CarsAddOns WHERE carId= ? AND addOnId= ? ;";
						$data8 = array($carId, $addOnId);
						$res8 = $this->db->query($sql8, $data8);
						if($res8->num_rows() == 0)
						{
							$sql9 = "Insert Into CarsAddOns values (NULL, ".$carId.", ".$addOnId.", 1)";
							$data9 = array($carId, $addOnId);
							$this->db->query($sql9, $data9);
						}
						else
						{
							foreach ($res8->result_array() as $row8)
							{
								break;
							}
							$sql9 = "Update CarsAddOns set count = ? WHERE carId= ? AND addOnId= ?;";
							$data9 = array(($row8['count']+1), $carId, $addOnId);
							$this->db->query($sql9, $data9);
						}
					}
				}
			}
		}
	}
	
}

?>