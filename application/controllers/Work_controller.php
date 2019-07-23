<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_controller extends Core_Controller {
	public function __construct(){
		parent :: __construct();
        $this->view_folder = 'pages/work/';
		$this->load->model(['Work_model','Work_type_model','Car_type_model']);
	}
	public function index()
	{
		$res = array();
		$con['where'] = 'status =1';
		$res['works'] = $this->Work_model->get_select($con);
		$con['array_key'] = true;
		$res['work_type'] = $this->Work_type_model->get_select($con);
		$res['car_type'] = $this->Car_type_model->get_select($con);
		$res['content'] = 'index';
		$this->render_template($res);
	}

	public function add()
	{
		$res = array();
		$res['content'] = 'add';
		$res['work_type'] = $this->Work_type_model->get_select(array('where'=>'status=1'));
		$res['car_type'] = $this->Car_type_model->get_select(array('where'=>'status=1'));
		$this->render_template($res);
	}

	public function json_add()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'add'):
			$con['data']['code'] = $post['code'];
			$con['data']['name'] = $post['name'];
			$con['data']['work_type_id'] = $post['work_type_id'];
			$con['data']['car_type_id'] = $post['car_type_id'];
			$con['data']['cost'] = $post['cost'];
			$con['data']['create_date'] = date('Y-m-d H:i:s');
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['data']['status'] = 1;

			if($this->Work_model->get_insert($con)):
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
			redirect('works');
		endif;
		$res = array();
		$res['content'] = 'edit';
		$res['work_type'] = $this->Work_type_model->get_select(array('where'=>'status=1'));
		$res['car_type'] = $this->Car_type_model->get_select(array('where'=>'status=1'));
		$con['where'] = 'status = 1 and id ='.$id;
		$data = $this->Work_model->get_select($con);
		if(!empty($data)):
			$res['work'] = $data[0];
			$this->render_template($res);
		else:
			redirect('works');
		endif;
	}

	public function json_edit()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'edit'):
			$con['data']['code'] = $post['code'];
			$con['data']['name'] = $post['name'];
			$con['data']['work_type_id'] = $post['work_type_id'];
			$con['data']['car_type_id'] = $post['car_type_id'];
			$con['data']['cost'] = $post['cost'];
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['where'] = 'id = '.$post['id'];
			if($this->Work_model->get_update($con)):
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
			if($this->Work_model->get_update($con)):
				$res['code'] = 0;
			else:
				$res['msg'] = 'เกิดความผิดพลาดในการลบ';
			endif;
		else:
			$res['msg'] = 'not access';
		endif;
		$this->render_json($res);
	}

}
