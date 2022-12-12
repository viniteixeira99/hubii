<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class financeiro extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('financeiro_model');
	}

	public function index()
	{
	}
}
