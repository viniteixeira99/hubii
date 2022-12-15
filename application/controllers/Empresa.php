<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empresa extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Empresa_model');
        $this->data['areaEmpresa'] = 'empresa';
    }

    public function gerenciarEmpresa()
    {

        $this->load->library('pagination');

        $this->data['configuration']['base_url'] = site_url('empresa/gerenciar/');
        $this->data['configuration']['total_rows'] = $this->empresa_model->count('empresa');

        $this->pagination->initialize($this->data['configuration']);

        $this->data['results'] = $this->empresa_model->get('empresa', '*', '', $this->data['configuration']['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'empresa/empresa';
        return $this->layout();

    }

    public function AdicionarEmpresa()
    {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empresa') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'nomeEmpresa' => set_value('nomeEmpresa'),
                'CNPJ' => set_value('CNPJ'),
                'telefone' => set_value('telefone'),
                'celular' => set_value('celular'),
                'email' => set_value('email'),
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'complemento' => set_value('complemento'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
                'dataCadastro' => date('Y-m-d'),
                'servicos' => (set_value('servicos') == true ? 1 : 0),
            ];

            if ($this->empresa_model->addEmpresa('empresa', $data) == true) {
                $this->session->set_flashdata('success', 'Empresa adicionada com sucesso!');
                redirect(site_url('empresa/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao adicionar esta empresa.</p></div>';
            }
        }

        $this->data['view'] = 'empresa/adicionarEmpresa';
        return $this->layout();
    }

    public function VisualizarEmpresa()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('empresa');
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->empresa_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->empresa_model->getPromocaoByEmpresa($this->uri->segment(3));
        $this->data['view'] = 'empresa/visualizar';
        return $this->layout();
    }

    public function editarEmpresa()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('admin');
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empresa') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $nomeEmpresa = $this->input->post('nomeEmpresa');
            if ($nomeEmpresa != null) {
                $nomeEmpresa = get('nomeEmpresa'); //! Gambiarra

                $data = [
                    'nomeEmpresa' => $this->input->post('nomeEmpresa'),
                    'CNPJ' => $this->input->post('CNPJ'),
                    'telefone' => $this->input->post('telefone'),
                    'celular' => $this->input->post('celular'),
                    'email' => $this->input->post('email'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                    'servico' => (set_value('servico') == true ? 1 : 0),
                ];
            } else {
                $data = [
                    'nomeEmpresa' => $this->input->post('nomeEmpresa'),
                    'CNPJ' => $this->input->post('CNPJ'),
                    'telefone' => $this->input->post('telefone'),
                    'celular' => $this->input->post('celular'),
                    'email' => $this->input->post('email'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                    'servico' => (set_value('servico') == true ? 1 : 0),
                ];
            }

            if ($this->empresa_model->editEmpresa('empresa', $data, 'idempresa', $this->input->post('idempresa')) == true) {
                $this->session->set_flashdata('success', 'Empresa editada com sucesso!');
                redirect(site_url('empresa/editar/') . $this->input->post('idempresa'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao editar a empresa.</p></div>';
            }
        }

        $this->data['result'] = $this->empresa_model->getById($this->uri->segment(3));
        $this->data['view'] = 'empresa/editarEmpresa';
        return $this->layout();
    }

    public function deletarEmpresa()
    {

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir empresa, verifique as promoções vinculadas.');
            redirect(site_url('empresa/gerenciar/'));
        }

        $promocao = $this->empresa_model->getAllPromocoesByEmpresa($id);
        if ($promocao != null) {
            $this->empresa_model->removePromocaoEmpresa($promocao);
        }

        $this->empresa_model->delete('empresa', 'idempresa', $id);

        $this->session->set_flashdata('success', 'empresa excluida com sucesso!');
        redirect(site_url('empresa/gerenciar/'));
    }

}