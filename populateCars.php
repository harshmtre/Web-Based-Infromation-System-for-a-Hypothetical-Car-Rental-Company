<?php
$category = $_POST['category'];

$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Could not establish connection to database...');
}	
mysql_select_db('carRentalDB',$con);
$sql1="Select productCatId from ProductCategories Where productCatName='".$category."';";
$res1 = mysql_query($sql1);
while($row = mysql_fetch_array($res1)) 
{
	break;
}
$sql2="Select * from Cars Where carCategoryId=".$row['productCatId'].";";
$res2 = mysql_query($sql2); 
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
	  echo "<td><img src='".$row['carImage']."'></td>";
	  echo "<td><input type='submit' name='submit' value='Reserve' class='button' style='display: inline; margin: 0 auto;' onClick='setSelectedCar(".$carId.")'></td>";
	  echo "</tr>";
	}
	echo "</table><br/><br/>";
}
mysql_close($con);
?>