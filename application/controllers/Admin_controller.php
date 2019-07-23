<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends Core_Controller {
	public function __construct(){
		parent :: __construct();
        $this->view_folder = 'pages/admin/';
	}
	public function index()
	{
		$res = array();
		$res['content'] = 'dashboard';
		$this->render_template($res);
	}

}
