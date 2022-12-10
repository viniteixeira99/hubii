<?php
class Site_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
	//Aqui verifica o login do cliente, valida se existe e mostra cupons da região que ele mora como preferencis
	}

	public function areaDoCliente()
	{
	//Aqui o cliente acessa a area do mesmo
	}

	public function promocao()
	{
	//Lista as promocoes
	}

	public function verPromocao()
	{
	//Aqui direciona o cliente para a página da promoção especifica
	}

	public function pegarPromocao()
	{
	//Aqui o cliente deve selecionar a promoção e ser redirecionado para o site do anunciante
	//Deve ser subtraido conforme cupom é pego
	}

	public function produtos()
	{
	//lista ps produtos com desconto
	}

	public function verProdutos()
	{
	//Aqui direciona o cliente para a página da promoção especifica
	}

	public function pegarProdutos()
	{
	//Aqui o cliente deve selecionar a promoção e ser redirecionado para o site do anunciante
	//Deve ser subtraido conforme cupom é pego
	}

	public function servicos()
	{
	//lista os servicos com desconto
	}

	public function verServicos()
	{
	//Aqui direciona o cliente para a página da promoção especifica
	}

	public function pegarServicos()
	{
	//Aqui o cliente deve selecionar a promoção e ser redirecionado para o site do anunciante
	//Deve ser subtraido conforme cupom é pego
	}

	public function contato()
	{
	// deve ser um set para mostrar os dados de cadastro inseridos pelo cliente
	}

	public function getDestaques()
	{
	//listar promoções em destaque
	}

	public function getPromocaoPorData()
	{
	//listar promoções por data de adição
	}

	public function getPromocaoPorRegiao()
	{
	//lista promoções por região (cidade, estado)
	}


	/**
	 * AQUI DEVEM SER REGISTRADOS OS DADOS QUE APARECERÃO NO SITE
	 * PROMOÇÕES
	 * 
	 */
}
