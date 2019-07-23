<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_detail_model extends MY_Model {

	public function __construct(){
		parent :: __construct();
		$this->table = 'job_detail';
	}

}
