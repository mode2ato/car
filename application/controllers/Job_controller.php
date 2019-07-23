<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_controller extends Core_Controller {
	public function __construct(){
		parent :: __construct();
        $this->view_folder = 'pages/job/';
		$this->load->model(['Job_model','Job_detail_model','Employee_model','Work_model']);
	}
	public function add()
	{
		$res = array();
		$con = 'status=1';
		$res['employees'] = $this->Employee_model->get_select($con);
		$res['works'] = $this->Work_model->get_select($con);
		$res['content'] = 'add';
		$this->render_template($res);
	}

}
