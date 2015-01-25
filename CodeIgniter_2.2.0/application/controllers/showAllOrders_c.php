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

class ShowAllOrders_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
	}
	
	public function index()
	{
		$username = $_SESSION['username'];
		$this->load->model(showallorders_m);
		$res = $this->showallorders_m->showOrders($username);
		$data = array("resultSet" => $res);
		if ($this->agent->is_mobile())
		{
			$this->load->view("showAllOrders_v_m", $data);
		}
		else
		{
			$this->load->view("showAllOrders_v", $data);
		}
	}
}

?>