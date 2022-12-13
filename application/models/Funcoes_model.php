<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Funcoes_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
        @session_start();
    }

    public function index()
    {
    $this->db->from('banners');
    $this->db->where('status', 1);
    $this->db->where('posicao', 1);
    $this->db->order_by('rand()');
    $get = $this->db->get(); //!Finalizar IF
    
    // if ($get->num_rows() > 0):
    // endif;
    }
}