<?php
ob_start();
session_start();
$activeUser = $_SESSION['username'];
if(!$activeUser)
{
	header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerLogin_c");
}
$inactiveTime = 600;
if(isset($_SESSION['timeout']))
{
	$session_life_time = time() - $_SESSION['timeout'];
	if($session_life_time > $inactiveTime)
	{
		session_destroy();
		header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerLogin_c");
	}
}

class UpdateCartTotalPrice_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$username = $_SESSION['username'];
		$this->load->model("updatecarttotalprice_m");
		$res = $this->updatecarttotalprice_m->updatePrice($username);
		$data = array("resultSet" => $res);
		$this->load->view("updateCartTotalPrice_v", $data);
	}
}

?>