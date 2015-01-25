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
		<th style="text-align: center">Orders</th>
	</tr>
</table>';
		$sql = "Select * from Orders where 1";
		if($_POST['startDate']!="")
		{
			$sql = $sql." AND orderDate>= '".$_POST['startDate']."'";
		}
		if($_POST['endDate']!="")
		{
			$sql = $sql." AND orderDate<= '".$_POST['endDate']."'";
		}
		if($_POST['startCost']!="")
		{
			$sql = $sql." AND totalCost>= '".$_POST['startCost']."'";
		}
		if($_POST['endCost']!="")
		{
			$sql = $sql." AND totalCost<= '".$_POST['endCost']."'";
		}
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
					<th width = "25%">Order Date:'.$row['orderDate'].'</th>
					<th width = "20%">Total Cost:'.$row['totalCost'].'</th>	
					<th width = "40%">Shipping Adress:'.$row['shippingAddress'].'</th>
					<td width = "15%"><button type="button" class="button" style="display: inline; margin: 0 auto;" onclick="showOrderDetails('.$orderId.');">Show Details</button></td>
				</tr>	
			</table>
			';	
			$sql2 = "Select * from ProductsOrdered where orderId = ".$orderId.";";
			$res2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($res2))
			{
				$productId = $row2['productId'];
				$productType = $row2['productType'];
				if($productType == "Car")
				{
					$sql3 = "Select * from Cars where carId = ".$productId.";";
					$res3 = mysql_query($sql3);
					while($row3 = mysql_fetch_array($res3))
					{
						echo'
						<table width="100%"  name='.$orderId.' class="details">
							<tr>
								<td width = "25%">'.$row3['carManufacturer'].' '.$row3['carModel'].'</td>
								<td width = "25%">Cost:'.$row2['productPrice'].'</td>	
								<td width = "25%">From:'.$row2['fromDate'].'</td>
								<td width = "25%">To:'.$row2['toDate'].'</td>
							</tr>	
						</table>
						';
					}
				}
				else
				{
					$sql3 = "Select * from AddOnProducts where productId = ".$productId.";";
					$res3 = mysql_query($sql3);
					while($row3 = mysql_fetch_array($res3))
					{
						echo'
						<table width="100%" name='.$orderId.' class="details">
							<tr>
								<td width = "25%">'.$row3['productName'].' '.$row3['carModel'].'</td>
								<td width = "25%">Cost:'.$row2['productPrice'].'</td>	
								<td width = "25%">From:'.$row2['fromDate'].'</td>
								<td width = "25%">To:'.$row2['toDate'].'</td>
							</tr>	
						</table>
						';
					}
				}
			}
		}
		echo'
		<script>
		$(".details").hide();
		function showOrderDetails(orderId)
		{
			$(".details").hide();
			$("[name="+orderId+"]").show();
		}
		</script>';
?>