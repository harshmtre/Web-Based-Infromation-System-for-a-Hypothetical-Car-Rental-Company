<?php
session_start();

class CustomerStoreAfterSignup_c extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['timeout'] = time();
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
		$this->load->model("customerstoreaftersignup_m");
		$this->customerstoreaftersignup_m->storeCustomer($username, $password, $customerFname, $customerLname, $customerDob, $customerAge, $customerEmail, $customerPhone, $customerAddress, $customerCCNumber, $customerCCName, $customerBillingAddress, $customerCCCVV, $customerCCExpDate);
		header("Location: http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c");
	}
}

?>