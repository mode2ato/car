<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct(){
		parent :: __construct();
	}
	public function test()
	{
		echo $this->password->encrypt('1234');
	}
}
