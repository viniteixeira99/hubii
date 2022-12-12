<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permissao extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('permissao_model');
	}

	public function index()
	{
		
	}
}
