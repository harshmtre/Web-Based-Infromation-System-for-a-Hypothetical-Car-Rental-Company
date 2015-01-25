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

class CustomerStoreAfterUpdate_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$customerFname = htmlspecialchars($_POST['customerFname']);
		$customerLname = htmlspecialchars($_POST['customerLname']);
		$customerDob = htmlspecialchars($_POST['customerDob']);
		$customerAge = htmlspecialchars($_POST['customerAge']);
		$customerEmail = htmlspecialchars($_POST['customerEmail']);
		$customerPhone = htmlspecialchars($_POST['customerPhone']);
		$customerAddress = htmlspecialchars($_POST['customerAddress']);
		$customerCCNumber = htmlspecialchars($_POST['customerCCNumber']);
		$customerCCName = htmlspecialchars($_POST['customerCCName']);
		$customerBillingAddress = htmlspecialchars($_POST['customerBillingAddress']);
		$customerCCCVV = htmlspecialchars($_POST['customerCCCVV']);
		$customerCCExpDate = htmlspecialchars($_POST['customerCCExpDate']);
		$this->load->model("customerstoreafterupdate_m");
		$this->customerstoreafterupdate_m->updateCustomer($username, $password, $customerFname, $customerLname, $customerDob, $customerAge, $customerEmail, $customerPhone, $customerAddress, $customerCCNumber, $customerCCName, $customerBillingAddress, $customerCCCVV, $customerCCExpDate);
		header("Location: http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerMainPage_c");
	}
}
?>