<?php

class CheckCustomerUsernameAvailability_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$username = htmlspecialchars($_POST['username']);
		$this->load->model("checkcustomerusernameavailability_m");
		$res = $this->checkcustomerusernameavailability_m->checkAvailability($username);
		$data = array("resultSet" => $res);
		$this->load->view("checkCustomerUsernameAvailability_v", $data);
	}
}

?>