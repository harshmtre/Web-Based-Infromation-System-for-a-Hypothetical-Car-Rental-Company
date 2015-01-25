<?php
$con = mysql_connect('localhost','root','909Cuppy'); 
if(!$con)
{
	die("Could not connect to the database...");
}
mysql_select_DB('carRentalDB',$con);
echo'
<table width = 100%>
	<tr>
		<th style="text-align: center">SALES</th>
	</tr>
</table>';
		$sql = "Select SUM(p.productPrice) as 'totalSales', c.carId, c.carModel, c.carManufacturer, c.carCategoryId, c.carImage from ProductsOrdered p, Cars c WHERE p.productType = 'Car' AND p.productId = c.carId";
		if($_POST['startDate']!="")
		{
			$sql = $sql." AND p.toDate>= '".$_POST['startDate']."'";
		}
		if($_POST['endDate']!="")
		{
			$sql = $sql." AND p.fromDate<= '".$_POST['endDate']."'";
		}
		if($_POST['productCategoryId']!= 0)
		{
			$sql = $sql." AND c.carCategoryId = ".$_POST['productCategoryId']."";
		}
		if($_POST['specialSales']!="no")
		{
			$sql2 = "Select * from SpecialSales WHERE 1";
			if($_POST['productCategoryId']!= 0)
			{
				$sql2 = $sql2 ." AND specialSalesProductCatId = ".$_POST['productCategoryId']."";
				if($_POST['startDate']!="")
				{
					$sql2 = $sql2 ." AND specialSalesEndDate >= ".$_POST['startDate']."";
				}
				if($_POST['endDate']!="")
				{
					$sql2 = $sql2 ." AND specialSalesStartDate <= ".$_POST['endDate']."";
				}
			}
			else
			{
				if($_POST['startDate']!="")
				{
					$sql2 = $sql2 ." AND specialSalesEndDate >= ".$_POST['startDate']."";
				}
				if($_POST['endDate']!="")
				{
					$sql2 = $sql2 ." AND specialSalesStartDate <= ".$_POST['endDate']."";
				}
			}
			$res2 = mysql_query($sql2);
			if(!$res2)
			{
				$sql = $sql." AND c.carId = 0";
			}
			else
			{
				while($row2 = mysql_fetch_array($res2))
				{
					$sql = $sql." AND p.fromDate>= '".$row2['specialSalesStartDate']."'";
					$sql = $sql." AND p.toDate<= '".$row2['specialSalesEndDate']."'";			
				}
			}
		}
		$sql = $sql." GROUP BY c.carId";
		$res = mysql_query($sql);
		if(!$res)
		{
			echo'
			<table width = 100%>
				<tr>
					<td style="text-align: center">No Results Found.</td>
				</tr>
			</table>';
		}
		while($row = mysql_fetch_array($res))
		{
			$orderId = $row['orderId'];
			echo'
			<table width="100%">
				<tr>
					<td width = "40%">Car:'.$row["carManufacturer"].' '.$row["carModel"].'</td>
					<td width = "30%"><img src="'.$row["carImage"].'"></td>
					<td width = "30%">Total Sales: $'.$row['totalSales'].'</td>
				</tr>	
			</table>
			';	
		}
?>