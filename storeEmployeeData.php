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
$con = mysql_connect('localhost','root','909Cuppy');
if(!$con)
{
	die('dead');
}	
mysql_select_db('carRentalDB',$con);

if(isset($_POST['update']))
{
	$sqlUpdate="Update Employees Set empfname='". $_POST['fname'] ."', emplname='". $_POST['lname'] ."', empGender='". $_POST['gender'] ."', empDOB='". $_POST['dob'] ."', empSSN=". $_POST['ssn'] .", empAddress='". $_POST['address'] ."', empJoiningDate='". $_POST['joiningDate'] ."', empJobTitle='". $_POST['jobTitle'] ."', empSalary=". $_POST['salary'] .", empDepartment='". $_POST['department'] ."', empType='". $_POST['type'] ."', empYearsOfExp=". $_POST['yoe'] .", empEmail='". $_POST['email'] ."', empPhone=". $_POST['empPhone'] ." WHERE empUserId = ". $_POST['empUserId'] ." ;";
	mysql_query($sqlUpdate);
	$sqlUpdateUsers="Update Users Set userType='". $_POST['type'] ."' Where userId =  ". $_POST['empUserId'] ." ;";
	mysql_query($sqlUpdateUsers);
}
if(isset($_POST['add']))
{
	$sqlInsertUsers= "INSERT INTO Users VALUES (NULL ,  '". $_POST['username'] ."',  '". $_POST['password'] ."',  '". $_POST['type'] ."');";
	mysql_query($sqlInsertUsers);
	$getUserId="Select userId from Users where username ='". $_POST['username'] ."'";
	$res = mysql_query($getUserId);
	while($row = mysql_fetch_array($res))
	{
		break;
	}
	$sqlAddEmployees="INSERT INTO  Employees VALUES (NULL , ". $row['userId'] .", '". $_POST['fname'] ."', '". $_POST['lname'] ."', '". $_POST['gender'] ."', '". $_POST['dob'] ."', '". $_POST['ssn'] ."', '". $_POST['address'] ."', '". $_POST['joiningDate'] ."', '". $_POST['jobTitle'] ."', ". $_POST['salary'] .", '". $_POST['department'] ."', '". $_POST['type'] ."', ". $_POST['yoe'] .", '". $_POST['email'] ."', ". $_POST['empPhone'] .");";
	mysql_query($sqlAddEmployees);
}
mysql_close($con);
header('Location: http://cs-server.usc.edu:9046/CSCI571HW/adminMainPage.php');
?>
