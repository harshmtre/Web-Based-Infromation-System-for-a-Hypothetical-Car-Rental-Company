<?php
session_start();

	class CustomerLogin_c extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->library('user_agent');
		}
		
		public function index()
		{
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
			$errmsg = "";
			if(strlen($username)==0)
			{
				$errmsg = "Invalid Login. Please try again.";
			}
			if(strlen($password)==0)
			{
				$errmsg = "Invalid Login. Please try again.";	
			}
			if(strlen($username)==0 && strlen($password)==0)
			{
				$errmsg = "";
			}
			if(strlen($username)>0 && strlen($password)>0)
			{
				$this->load->model('customerlogin_m');
				$res = $this->customerlogin_m->getCustomerUsername($username, $password);
				if($res['resultSet']->num_rows() == 0)
				{
					$errmsg = "Invalid Login. Please try again.";
				}
			}
			if(strlen($errmsg)>0)
			{
				$this->load->library('user_agent');
				if ($this->agent->is_mobile())
				{
				    $this->load->view('customerLogin_vHead_m');
					$data = array('errmsg' => $errmsg);
					$this->load->view('customerLogin_vError', $data);
					$this->load->view('customerLogin_vMain_m');
				}
				else
				{
					$this->load->view('customerLogin_vHead');
					$data = array('errmsg' => $errmsg);
					$this->load->view('customerLogin_vError', $data);
					$this->load->view('customerLogin_vMain');
				}
			}
			else
			{
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['password'] = $_POST['password'];
				$_SESSION['timeout'] = time();
				$this->load->model('customerlogin_m');
				$res = $this->customerlogin_m->getCustomerUsername($username, $password);
				foreach ($res['resultSet']->result_array() as $row)
				{
					break;
				}
				if($row['username'] != '')
				{
					header('Location: http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/mainPage_c');
				}
				else
				{
					$this->load->library('user_agent');
					if ($this->agent->is_mobile())
					{
					    $this->load->view('customerLogin_vHead_m');
						$this->load->view('customerLogin_vMain_m');
					}
					else
					{
					    $this->load->view('customerLogin_vHead');
						$this->load->view('customerLogin_vMain');
					}
				}
			}

		}
		
	}

?>