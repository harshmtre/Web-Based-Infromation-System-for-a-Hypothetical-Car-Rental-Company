<?php
session_start();
$_SESSION["pickupDate"]=$_GET["pickupDate"];
$_SESSION["returnDate"]=$_GET["returnDate"];
$_SESSION["location"]=$_GET["location"];
$_SESSION["carCategory"]=$_GET["carCategory"];
$_SESSION["selectedCar"]=$_GET["selectedCar"];
echo $_SESSION["pickupDate"];
echo $_SESSION["returnDate"];
echo $_SESSION["location"];
echo $_SESSION["carCategory"];
echo $_SESSION["selectedCar"];
?>