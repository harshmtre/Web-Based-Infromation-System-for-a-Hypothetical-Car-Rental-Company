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

class ChooseAdditionalFeatures_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
	}
	
	public function index()
	{
		if($_SESSION['selectedCar'] == "")
		{
			header("Location:http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c");
		}
		else
		{
			$this->load->model("chooseadditionalfeatures_m");
			$this->chooseadditionalfeatures_m->insertInCart();
			$res = $this->chooseadditionalfeatures_m->getAddOns();
			$addOns = $this->chooseadditionalfeatures_m->getSimilarPurchases();
			$data = array("resultSet" => $res, "addOns" => $addOns);
			if ($this->agent->is_mobile())
			{
				$this->load->view("chooseAdditionalFeatures_v_m", $data);
			}
			else
			{
				$this->load->view("chooseAdditionalFeatures_v", $data);
			}
			$_SESSION['selectedCar'] = "";
		}
		
	}
}

?>