<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Site_model');
	}


	public function index()
	{
		$this->data['verPromocao'] = $this->Site_model->verPromocao();
		$this->data['getPromocaoSemana'] = $this->Site_model->getPromocaoSemana();
		$this->data['getPromocaoMes'] = $this->load->Site_model->getPromocaoMes();
		$this->data['getPromocaoDia'] = $this->Site_model->getPromocaoDia();
		$this->data['view'] = 'site/home'; //*Carregar nav menu do site
	}



	public function areaDoCliente()
	{
		$this->data['areaDoCliente'] = $this->Site_model->areaDoCliente($this->session->userdata('id'));
		$this->data['view'] = 'site/areaDoCliente';
		return $this->layout();
	}

	public function pesquisar()
	{
		$termo = $this->input->get('termo');

		$data['results'] = $this->Site_model->pesquisar($termo);
		$this->data['produtos'] = $data['results']['produtos'];
		$this->data['servicos'] = $data['results']['servicos'];
		$this->data['promocao'] = $data['results']['promocao'];
		$this->data['view'] = 'site/pesquisa';
		return $this->layout();
	}

	public function verPromocao()
	{
		if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
			$this->session->set_flashdata('error', 'Item não pode ser encontrado.');
			redirect('Site');
		}

		$this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

		if ($this->data['result'] == null) {
			$this->session->set_flashdata('error', 'Produto não encontrado.');
			redirect(site_url('site/verProdutos') . $this->input->post('idProdutos'));
		}

		$this->data['view'] = 'produtos/verProduto';
		return $this->layout();
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

	public function verServicos()
	{
		$this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('servicos/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->servicos_model->count('servicos');

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->servicos_model->get('servicos', '*', '', $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'servicos/servicos';
        return $this->layout();
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
		$this->data['areaDoCliente'] = $this->areaDoCliente_model->cadastroCliente();
		$this->data['areaDoCliente'] = 'areaDoCliente'; //*Carregar nav menu do site
	}


	public function paginaLoja()
	{
        
        $this->data['view'] = 'servicos/servicos';
        return $this->layout();
	}
}
