<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('funcoes_model');
    }

    public function index()
    {
        $this->db->from('config');
        $this->db->order_by('id','desc');
        $this->db->limit(1,0);

        $this->load->view('admin/home');

    }
    
}