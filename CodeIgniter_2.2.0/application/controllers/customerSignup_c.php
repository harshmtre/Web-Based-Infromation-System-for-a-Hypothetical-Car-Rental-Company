<?php
session_start();

class CustomerSignup_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('user_agent');
		
	}
	public function index()
	{
		if ($this->agent->is_mobile())
		{
			$this->load->view("customerSignup_v_m");
		}
		else
		{
			$this->load->view("customerSignup_v");
		}
		
	}
}

?>