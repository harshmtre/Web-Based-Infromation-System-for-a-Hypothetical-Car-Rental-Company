<?php
$totalCost = 0;
if(!$row = mysql_fetch_array($resultSet["resultSet"]))
{
	echo "$".$totalCost;
}
else
{
	$totalCost = $totalCost + $row['totalCost'];
	while($row = mysql_fetch_array($resultSet["resultSet"]))
	{
		$totalCost = $totalCost + $row['totalCost'];
	}
	echo "$".$totalCost;
}
?>