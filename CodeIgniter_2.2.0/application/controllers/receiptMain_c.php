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

class receiptMain_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('user_agent');
	}
	
	public function index()
	{
		$username = $_SESSION['username'];
		$totalCost = $_POST['totalCost'];
		$customerBillingAddress = htmlspecialchars($_POST['customerBillingAddress']);
		$customerAddress = htmlspecialchars($_POST['customerAddress']);
		$this->load->model("receiptmain_m");
		$this->receiptmain_m->saveOrders($username, $totalCost, $customerBillingAddress, $customerAddress);
		if ($this->agent->is_mobile())
		{
			$this->load->view("receiptMain_v_m");
		}
		else
		{
			$this->load->view("receiptMain_v");
		}
		
	}
}
?>