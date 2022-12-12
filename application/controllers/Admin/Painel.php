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
		$this->data['servicos'] = $this->servicos_model->getServicos();
		$this->data['produto'] = $this->produto_model->getProduto();
		$this->data['promocao'] = $this->promocao_model->getPromocao();
		$this->data['usuario'] = $this->usuario_model->getUsuario();
	}
}
