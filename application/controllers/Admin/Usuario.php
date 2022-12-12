<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class usuario extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index()
	{
		
	}
}
