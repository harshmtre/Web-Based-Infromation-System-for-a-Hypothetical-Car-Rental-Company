<?php
session_start();

class MainPage_c extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }
	public function index()
	{
		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
			$this->load->model("mainpage_m");
			$res = $this->mainpage_m->getCustomer($username);
		}
		$this->load->model("mainpage_m");
		$res2 = $this->mainpage_m->getRentalLocations();
		$res3 = $this->mainpage_m->getProductCategories();
		$res4 = $this->mainpage_m->getSpecialSales();
		$data = array("resultSet" => $res, "resultSet2" => $res2, "resultSet3" => $res3, "resultSet4" => $res4);
		if ($this->agent->is_mobile())
		{
			$this->load->view('mainPage_v_m.php', $data);
		}
		else
		{
			$this->load->view('mainPage_v.php', $data);
		}
	}
	public function overlap()
	{
		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
			$this->load->model(mainpage_m);
			$res = $this->mainpage_m->getCustomer($username);
		}
		$res2 = $this->mainpage_m->getRentalLocations();
		$res3 = $this->mainpage_m->getProductCategories();
		$res4 = $this->mainpage_m->getSpecialSales();
		$data = array("overlap" => "yes", "resultSet" => $res, "resultSet2" => $res2, "resultSet3" => $res3, "resultSet4" => $res4);
		if ($this->agent->is_mobile())
		{
			$this->load->view('mainPage_v_m.php', $data);
		}
		else
		{
			$this->load->view('mainPage_v.php', $data);
		}
	}
}
?>