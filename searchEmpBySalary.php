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
$r = $_GET['r'];

$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('Could not establish connection to database...');
}	
mysql_select_db('carRentalDB',$con);
$sql="Select * from Employees Where empSalary >=".$q." AND empSalary <=".$r.";";
$res = mysql_query($sql);

echo "<table border='1' width='100%'>
<tr>
<th>Sr. No.</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Department</th>
<th>Job Title</th>
<th>Salary</th>
<th>Email</th>
<th>Phone Number</th>
</tr>";
$count=0;
while($row = mysql_fetch_array($res)) {
  $count=$count+1;
  echo "<tr id='user" . $row['empUserId'] ."'>";
  echo "<td>" . $count . "</td>";
  echo "<td>" . $row['empfname'] . "</td>";
  echo "<td>" . $row['emplname'] . "</td>";
  echo "<td>" . $row['empDepartment'] . "</td>";
  echo "<td>" . $row['empJobTitle'] . "</td>";
  echo "<td>" . $row['empSalary'] . "</td>";
  echo "<td>" . $row['empEmail'] . "</td>";
  echo "<td>" . $row['empPhone'] . "</td>";
  echo "</tr>";
}
echo "</table><br/><br/>";
mysql_close($con);
?>