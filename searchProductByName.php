<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/login.php");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/login.php");
	}
}
$q = $_GET['q'];

$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Could not establish connection to database...');
}	
mysql_select_db('carRentalDB',$con);
$sql="Select c.*, pc.productCatName from Cars c, ProductCategories pc Where pc.productCatId = c.carCategoryId AND (carModel LIKE '%".$q."%' OR carManufacturer LIKE '%".$q."%' );";
$res = mysql_query($sql); 

echo "<table border='1' width='100%'>
<tr>
<th>Sr. No.</th>
<th>Car</th>
<th>Category</th>
<th>Registration Number</th>
<th>Manufactured In</th>
<th>Image</th>
</tr>";
$count=0;
while($row = mysql_fetch_array($res)) {
  $count=$count+1;
  echo "<tr id='car" . $row['carId'] ."'>";
  echo "<td>" . $count . "</td>";
  echo "<td>" . $row['carManufacturer'] . " " . $row['carModel'] ."</td>";
  echo "<td>" . $row['productCatName'] . "</td>";
  echo "<td>" . $row['carRegistrationNumber'] . "</td>";
  echo "<td>" . $row['carManufactureYear'] . "</td>";
  echo "<td><img src='".$row['carImage']."'></td>";
  echo "</tr>";
}
echo "</table><br/><br/>";
mysql_close($con);
?>