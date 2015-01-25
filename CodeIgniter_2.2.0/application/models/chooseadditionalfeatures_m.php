<?php

class Chooseadditionalfeatures_m extends CI_Model
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
	
	public function insertInCart()
	{
		$sql1 = "Select * from Cars WHERE carId=".$_SESSION['selectedCar'].";";
		$res1 = mysql_query($sql1);
		while($row1 = mysql_fetch_array($res1))
		{
			break;
		}
		$pickupDate = strtotime($_POST['pickupDate']);
		$returnDate = strtotime($_POST['returnDate']);
		$dateDiff = $returnDate - $pickupDate;
		$noOfDays = floor($dateDiff/(60*60*24));
		$productPrice = $row1['carPrice'];
		$totalCost = $noOfDays * $productPrice;
		$sql="Select * from CustomerCarts WHERE customerUsername='".$_SESSION['username']."' AND productType='Car' AND (fromDate<='".$_POST['pickupDate']."' AND toDate>='".$_POST['pickupDate']."') OR (fromDate<='".$_POST['returnDate']."' AND toDate>='".$_POST['returnDate']."');";
		$res = mysql_query($sql);
		if(!$row = mysql_fetch_array($res))
		{
			$sql3="Select orderId from Orders WHERE customerUsername='".$_SESSION['username']."';";
			$res3 = mysql_query($sql3);
			if(!$row3 = mysql_fetch_array($res3))
			{
				$sql5 = "Select carCategoryId from Cars where carId=".$_SESSION['selectedCar'].";";
				$res5 = mysql_query($sql5);
				while($row5 = mysql_fetch_array($res5))
				{
					$sql6 = "Select * from SpecialSales where specialSalesProductCatId=".$row5['carCategoryId']." AND specialSalesStartDate<='".$_SESSION['pickupDate']."' AND specialSalesEndDate>='".$_SESSION['returnDate']."';";
					$res6 = mysql_query($sql6);
					if(!$row6 = mysql_fetch_array($res6))
					{
						$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";
					}
					else
					{
							$totalCost = $totalCost - (($row6['specialSalesDiscountPercent']/100) * $totalCost);
							$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";
		
					}	
				}
				mysql_query($sql2);
			}
			else
			{
					$sql4="Select * from ProductsOrdered WHERE orderId IN (Select orderId from Orders WHERE customerUsername='".$_SESSION['username']."') AND productType='Car' AND ((fromDate<='".$_POST['pickupDate']."' AND toDate>='".$_POST['pickupDate']."') OR (fromDate<='".$_POST['returnDate']."' AND toDate>='".$_POST['returnDate']."'));";
					$res4= mysql_query($sql4);
					if(!$row4 = mysql_fetch_array($res4))
					{
						$sql5 = "Select carCategoryId from Cars where carId=".$_SESSION['selectedCar'].";";
						$res5 = mysql_query($sql5);
						while($row5 = mysql_fetch_array($res5))
						{
							$sql6 = "Select * from SpecialSales where specialSalesProductCatId=".$row5['carCategoryId']." AND specialSalesStartDate<='".$_SESSION['pickupDate']."' AND specialSalesEndDate>='".$_SESSION['returnDate']."';";
							$res6 = mysql_query($sql6);
							if(!$row6 = mysql_fetch_array($res6))
							{
								$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";
							}
							else
							{
									$totalCost = $totalCost - (($row6['specialSalesDiscountPercent']/100) * $totalCost);
									$sql2 = "Insert into CustomerCarts values (NULL, '".$_SESSION['username']."', '".$_SESSION['location']."', ".$_SESSION['selectedCar'].", ".$productPrice .", '".$_SESSION['pickupDate']."', '".$_SESSION['returnDate']."', ".$noOfDays.", ".$totalCost.", 'Car');";
		
							}	
						}
						mysql_query($sql2);
					}
					else
					{
						header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c/overlap");
					}
			}	
		}
		else
		{
			header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c/overlap");
		}
	}
	
	public function getAddOns()
	{
		$sql3 = "Select * from AddOnProducts;";
		$res3 = mysql_query($sql3);
		return array("resultSet" => $res3);
	}
	
	public function getSimilarPurchases()
	{
		$count = 0;
		$sql7 = "Select addOnId from CarsAddOns WHERE carId = ".$_SESSION['selectedCar']." ORDER BY count DESC";
		$res7 = mysql_query($sql7);
		if(!$res7)
		{
			return array("addOn" => "");
		}
		else
		{
			$addOns = "";
			while($row7 = mysql_fetch_array($res7))
			{
				if($count == 2)
				{
					break;
				}
				$count = $count + 1;
				$sql8 = "Select productName from AddOnProducts where productId = ".$row7['addOnId'].";";
				$res8 = mysql_query($sql8);
				while($row8 = mysql_fetch_array($res8))
				{
					$addOns = $addOns."     ".$row8['productName'];
				}
			}
			if($addOns!="")	
			{
				return array("addOn" => $addOns);
			}
		}
	}
	
}

?>