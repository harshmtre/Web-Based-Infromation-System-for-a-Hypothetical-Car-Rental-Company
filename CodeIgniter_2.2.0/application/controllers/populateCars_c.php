<?php

class PopulateCars_c extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }
	public function index()
	{
		$category = $_POST['category'];
		$this->load->model('populatecars_m');
		$res2 = $this->populatecars_m->getCars($category);
		$data = array("resultSet" => $res2['resultSet']);
		if ($this->agent->is_mobile())
		{
			$this->load->view("populateCars_v_m.php", $data);
		}
		else
		{
			$this->load->view("populateCars_v.php", $data);
		}
		
		mysql_close($con);
	}
}
?>