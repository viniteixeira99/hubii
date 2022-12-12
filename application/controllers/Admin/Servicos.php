<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Servicos extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Servico');
	}

	public function index()
	{

	}
}
