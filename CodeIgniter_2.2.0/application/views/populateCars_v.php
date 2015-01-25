<?php
$res2 = $resultSet;
if($res2)
{
	echo "<table border='1' width='100%'>
	<tr>
	<th>Sr. No.</th>
	<th>Car</th>
	<th>Manufactured In</th>
	<th>Image</th>
	<th>Reserve</th>
	</tr>";
	$count=0;
	while($row = mysql_fetch_array($res2)) {
	  $count=$count+1;
	  $carId = $row['carId'];
	  echo "<tr id='car" . $carId ."'>";
	  echo "<td>" . $count . "</td>";
	  echo "<td>" . $row['carManufacturer'] . " " . $row['carModel'] ."</td>";
	  echo "<td>" . $row['carManufactureYear'] . "</td>";
	  echo "<td><img src='http://cs-server.usc.edu:9046/CSCI571HW/".$row['carImage']."'></td>";
	  echo "<td><input type='submit' name='submit' value='Reserve' class='button' style='display: inline; margin: 0 auto;' onClick='setSelectedCar(".$carId.")'></td>";
	  echo "</tr>";
	}
	echo "</table><br/><br/>";
}
?>