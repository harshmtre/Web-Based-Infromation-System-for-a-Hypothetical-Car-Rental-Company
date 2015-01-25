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

class DeleteCartItem_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}	
	
	public function index()
	{
		$cartEntryId = $_POST['theCartEntryId'];
		$this->load->model("deletecartitem_m");
		$cartItemsDeleted = $this->deletecartitem_m->deleteItem($cartEntryId);
		$data = array("cartItemsDeleted" => $cartItemsDeleted);
		$this->load->view("deleteCartItem_v", $data);
	}
}
?>