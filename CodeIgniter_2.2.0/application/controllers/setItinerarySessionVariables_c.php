<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c.php");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c.php");
	}
}

class SetItinerarySessionVariables_c extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
		$_SESSION["pickupDate"]=$_POST["pickupDate"];
		$_SESSION["returnDate"]=$_POST["returnDate"];
		$_SESSION["location"]=$_POST["location"];
		$_SESSION["carCategory"]=$_POST["carCategory"];
		$_SESSION["selectedCar"]=$_POST["selectedCar"];
		$this->load->view("setItinerarySessionVariables_v");
	}
}
?>