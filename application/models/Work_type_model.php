<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_type_model extends MY_Model {

	public function __construct(){
		parent :: __construct();
		$this->table = 'work_type';
	}

}
