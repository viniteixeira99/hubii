<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Funcoes_Model');
    }


    public function index()
    {
        //?Carrega configurações por id
        $this->db->from('config');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1, 0);
        
        if ($this->uri->segment(1) == 'categoria') : //
            $this->db->from('categorias');
            $this->db->where('id', $this->uri->segment(2));
            $this->db->where('status', 1);
            $this->db->order_by('id', 'desc');
            $get = $this->db->get();
        
        if ($get->num_rows() <= 0) : //
            header("Location:/" . CAMINHO);
            else :
                $valor = $get->result_array()[0];
            endif;
            $array['pageAtual'] = $valor['nome'];
            $array['categoria'] =  $this->uri->segment(2);

        else :
            $array['pageAtual'] = 'destaques';

        endif;

        $this->data['view'] = 'site/home';
    }

    public function contato()
    {
        $this->db->from('config');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1, 0);

        $this->load->view('site/contato');
    }
    public function oferta()
    {

        $this->db->from('produtos');
        $this->db->where('id', $this->uri->segment(2));
        $this->db->where('status', 1);
        $this->db->order_by('id', 'desc');
        $get = $this->db->get();

        if ($get->num_rows() > 0) :


            $result = $get->result_array()[0];
            $arr['promobanner'] = $result['promobanner'];


        endif;

        $this->load->view('site/oferta', $arr);
    }

    public function sair()
    {
        $this->session->session_destroy();
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function cadastro()
    {

    }

    public function checkout()
    {
        
    }

    public function comprovante()
    {
        
    }


    public function paginas()
    {

        $this->db->from('paginas');
        $this->db->where('url', $this->uri->segment(2));
        $get = $this->db->get();

        if ($get->num_rows() > 0) :
            $result = $get->result_array();

            $array['meta_title'] = $result[0]['meta_title'];
            $array['meta_description'] = $result[0]['meta_description'];
            $array['meta_autor'] = $result[0]['meta_autor'];
            $array['meta_keywords'] = $result[0]['meta_keywords'];
            $array['conteudo'] = $result[0]['conteudo'];
            $this->load->view('site/paginas', $array);
        else :

            $this->index();

        endif;
    }
    
}
