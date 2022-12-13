<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AjaxEmpresa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Funcoes_Model');
        $this->load->model('SessionsVerify_Model');
    }

    public function login()
    {
        header('Access-Control-Allow-Origin: ' . base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
        if ($this->form_validation->run() == false) {
            $json = ['result' => false, 'message' => validation_errors()];
            echo json_encode($json);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $this->load->model('Hubii_model');
            $user = $this->Hubii_model->check_credentials($email);

            if ($user) {
                // Verificar se acesso está expirado
                if ($this->chk_date($user->dataExpiracao)) {
                    $json = ['result' => false, 'message' => 'A conta do usuário está expirada, por favor entre em contato com o administrador do sistema.'];
                    echo json_encode($json);
                    die();
                }

                // Verificar credenciais do usuário
                if (password_verify($password, $user->senha)) {
                    $session_data = ['nome' => $user->nome, 'email' => $user->email, 'url_image_user' => $user->url_image_user, 'id' => $user->idUsuarios, 'permissao' => $user->permissoes_id, 'logado' => true];
                    $this->session->set_userdata($session_data);
                    log_info('Efetuou login no sistema');
                    $json = ['result' => true];
                    echo json_encode($json);
                } else {
                    $json = ['result' => false, 'message' => 'Os dados de acesso estão incorretos.'];
                    echo json_encode($json);
                }
            } else {
                $json = ['result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.'];
                echo json_encode($json);
            }
        }
        die();
    }

    public function sair(){
        $this->session->sess_destroy();
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function cadastrar()
    {
        $this->load->model('clientes_model', '', true);
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $id = 0;

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'nome' => set_value('nome'),
                'email' => set_value('email'),
                'senha' => password_hash($this->input->post('senha'), PASSWORD_DEFAULT),
                'dataCadastro' => date('Y-m-d'),
            ];

            $id = $this->clientes_model->add('clientes', $data);

            if ($id > 0) {
                $this->enviarEmailBoasVindas($id);
                $this->enviarEmailTecnicoNotificaClienteNovo($id);
                $this->session->set_flashdata('success', 'Cadastro realizado com sucesso! <br> Um e-mail de boas vindas será enviado para ' . $data['email']);
                redirect(base_url() . 'index.php/mine');
            } else {
                $this->session->set_flashdata('error', 'Falha ao realizar cadastro!');
            }
        }
        $data = '';
        $this->load->view('conecte/cadastrar', $data); //TODO criar view do novo cliente
    }

    private function chk_date($data_banco)
    {
        $data_banco = new DateTime($data_banco);
        $data_hoje = new DateTime("now");

        return $data_banco < $data_hoje;
    }
}
