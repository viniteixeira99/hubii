<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Painel extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Painel_model');
	}

	public function index()
	{
		
	}
}
