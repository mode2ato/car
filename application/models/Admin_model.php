<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends MY_Model {

	public function __construct(){
		parent :: __construct();
		$this->table = 'admin';
	}

	function auth($us,$ps){
		$con = array();
		$con['where'] = 'username = "'.$us.'" and status = 1';
		$admin = $this->Admin_model->get_select($con);
		if(!empty($admin) and $this->password->decrypt($admin[0]['password']) == $ps):
			$this->set_session($admin[0]);
			return 1;
		else:
			return 0;
		endif;
	}

	function set_session($obj){
		$admin_session = array();
		$admin_session['id'] = $obj['id'];
		$admin_session['name'] = $obj['name'];
		$this->session->set_userdata('admin',$admin_session);
	}

}
