<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends MY_Controller {

	public function __construct(){
		parent :: __construct();
		$this->load->library('password');
	}
	public function index()
	{
		$res = array();
		$res['content'] = 'index';
		$this->render_html($res);
	}
	public function login()
	{
		$res = array();
		$res['content'] = 'login';
		$this->render_html($res);
	}

	public function json_login()
	{
		$this->load->model('Admin_model');
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(!empty($post) and isset($post['us']) and isset($post['ps'])):
			if($this->Admin_model->auth($post['us'],$post['ps'])):
				$res['code'] = 0;
			else:
				$res['msg'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
			endif;
		else:
			$res['msg'] = 'กรุณากรอกข้อมูลให้ครบ';
		endif;
		$this->render_json($res);
	}

}
