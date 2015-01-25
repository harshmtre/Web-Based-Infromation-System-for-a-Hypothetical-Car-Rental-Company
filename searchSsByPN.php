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
$sql="Select s.*, c.carManufacturer, c.carModel from SpecialSales s, Cars c Where c.carManufacturer LIKE '%".$q."%' OR c.carModel LIKE '%".$q."%' AND s.specialSalesProductCatId = c.carCategoryId;";
$res = mysql_query($sql); 

echo "<table border='1' width='100%'>
<tr>
<th>Sr. No.</th>
<th>Car</th>
<th>Start Date</th>
<th>End Date</th>
<th>Discount Percent</th>
</tr>";
$count=0;
while($row = mysql_fetch_array($res)) {
  $count=$count+1;
  echo "<tr id='specialSales" . $row['specialSalesId'] ."'>";
  echo "<td>" . $count . "</td>";
  echo "<td>" . $row['carManufacturer'] ." ". $row['carModel'] ."</td>";
  echo "<td>" . $row['specialSalesStartDate'] . "</td>";
  echo "<td>" . $row['specialSalesEndDate'] . "</td>";
  echo "<td>" . $row['specialSalesDiscountPercent'] . "</td>";
  echo "</tr>";
}
echo "</table><br/><br/>";
mysql_close($con);
?>