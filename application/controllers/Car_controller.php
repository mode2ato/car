<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car_controller extends Core_Controller {
	public function __construct(){
		parent :: __construct();
        $this->view_folder = 'pages/car/';
		$this->load->model(['Car_model','Car_type_model']);
	}
	public function index()
	{
		$res = array();
		$con['where'] = 'status =1';
		$res['cars'] = $this->Car_model->get_select($con);
		$con['array_key'] = true;
		$res['car_type'] = $this->Car_type_model->get_select($con);
		$res['content'] = 'index';
		$this->render_template($res);
	}

	public function add()
	{
		$res = array();
		$res['content'] = 'add';
		$res['car_type'] = $this->Car_type_model->get_select(array('where'=>'status=1'));
		$this->render_template($res);
	}

	public function json_add()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'add'):
			$con['data']['plate'] = $post['plate'];
			$con['data']['brand'] = $post['brand'];
			$con['data']['model'] = $post['model'];
			$con['data']['body_number'] = $post['body_number'];
			$con['data']['year'] = $post['year'];
			$con['data']['cc'] = $post['cc'];
			$con['data']['color'] = $post['color'];
			$con['data']['create_date'] = date('Y-m-d H:i:s');
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['data']['status'] = 1;

			if($this->Car_model->get_insert($con)):
				$res['code'] = 0;
			else:
				$res['msg'] = 'เกิดความผิดพลาดในการบันทึก';
			endif;
		else:
			$res['msg'] = 'not access';
		endif;
		$this->render_json($res);
	}

	public function edit($id = 0)
	{
		if($id == 0):
			redirect('jobs');
		endif;
		$res = array();
		$res['content'] = 'edit';
		$con['where'] = 'status = 1 and id ='.$id;
		$data = $this->Car_model->get_select($con);
		if(!empty($data)):
			$res['car'] = $data[0];
			$this->render_template($res);
		else:
			redirect('jobs');
		endif;
	}

	public function json_edit()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'edit'):
			$con['data']['plate'] = $post['plate'];
			$con['data']['brand'] = $post['brand'];
			$con['data']['model'] = $post['model'];
			$con['data']['body_number'] = $post['body_number'];
			$con['data']['year'] = $post['year'];
			$con['data']['cc'] = $post['cc'];
			$con['data']['color'] = $post['color'];			
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['where'] = 'id = '.$post['id'];
			if($this->Car_model->get_update($con)):
				$res['code'] = 0;
			else:
				$res['msg'] = 'เกิดความผิดพลาดในการบันทึก';
			endif;
		else:
			$res['msg'] = 'not access';
		endif;
		$this->render_json($res);
	}

	public function json_del()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'del'):
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['data']['status'] = -1;
			$con['where'] = 'id = '.$post['id'];
			if($this->Car_model->get_update($con)):
				$res['code'] = 0;
			else:
				$res['msg'] = 'เกิดความผิดพลาดในการลบ';
			endif;
		else:
			$res['msg'] = 'not access';
		endif;
		$this->render_json($res);
	}

	public function json_search()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'search'):
			$con['where'] = 'plate ="'.$post['plate'].'"';
			$car = $this->Car_model->get_select($con);
			if(!empty($car)):
				$res['code'] = 0;
				$res['data'] = $car[0];
			endif;
		else:
			$res['msg'] = 'not access';
		endif;
		$this->render_json($res);
	}

}
