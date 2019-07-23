<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_controller extends Core_Controller {
	public function __construct(){
		parent :: __construct();
        $this->view_folder = 'pages/employee/';
		$this->load->model(['Employee_model','Work_type_model']);
	}
	public function index()
	{
		$res = array();
		$con['where'] = 'status = 1';
		$res['employees'] = $this->Employee_model->get_select($con);
		$con['array_key'] = true;
		$res['work_type'] = $this->Work_type_model->get_select($con);
		$res['content'] = 'index';
		$this->render_template($res);
	}

	public function add()
	{
		$res = array();
		$res['work_type'] = $this->Work_type_model->get_select(array('where'=>'status=1'));
		$res['content'] = 'add';
		$this->render_template($res);
	}

	public function json_add()
	{
		$res = array('code'=>1,'msg'=>'');
		$post = $this->input->post();
		if(isset($post['act']) and $post['act'] == 'add'):
			$con['data']['id_card'] = $post['id_card'];
			$con['data']['name'] = $post['name'];
			$con['data']['nickname'] = $post['nickname'];
			$con['data']['address'] = $post['address'];
			$con['data']['phone'] = $post['phone'];
			$con['data']['work_type_id'] = $post['work_type_id'];
			$con['data']['social_insurance'] = $post['social_insurance'];
			$con['data']['salary_type'] = $post['salary_type'];
			$con['data']['payment'] = $post['payment'];
			$con['data']['create_date'] = date('Y-m-d H:i:s');
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['data']['status'] = 1;

			if($this->Employee_model->get_insert($con)):
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
		$con['where'] = 'status = 1 and id ='.$id;
		$data = $this->Employee_model->get_select($con);
		if(!empty($data)):
			$res['employee'] = $data[0];
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
			$con['data']['id_card'] = $post['id_card'];
			$con['data']['name'] = $post['name'];
			$con['data']['nickname'] = $post['nickname'];
			$con['data']['address'] = $post['address'];
			$con['data']['phone'] = $post['phone'];
			$con['data']['work_type_id'] = $post['work_type_id'];
			$con['data']['social_insurance'] = $post['social_insurance'];
			$con['data']['salary_type'] = $post['salary_type'];
			$con['data']['payment'] = $post['payment'];
			$con['data']['update_date'] = date('Y-m-d H:i:s');
			$con['where'] = 'id = '.$post['id'];
			if($this->Employee_model->get_update($con)):
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
			if($this->Employee_model->get_update($con)):
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
