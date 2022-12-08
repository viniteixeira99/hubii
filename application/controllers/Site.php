<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Site_Model');
	}


	public function index()
	{
		$this->load->view('site/home');
	}



	public function areaDoCliente()
	{
	}

	public function verPromocao()
	{
	}

	public function pegaPromocao()
	{
	}

	/**
	 * Listar por filtro
	 */
	public function getPromocaoPorData()
	{
		//listar promoções por data de adição
	}

	public function getPromocaoPorRegiao()
	{
		//lista promoções por região (cidade, estado)
	}

	public function contato()
	{
	}
	public function oferta()
	{
	}

	public function login()
	{
	}

	public function cadastro()
	{
	}


	public function paginas()
	{
	}
}
