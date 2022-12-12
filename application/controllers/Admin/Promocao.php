<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class promocao extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('promocao_model');
	}

	public function index()
	{
		
	}
}
