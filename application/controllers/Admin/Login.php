<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Painel_model');
	}

	public function index()
    {
        $this->load->view('admin/login');
    }

	public function sair()
    {
        $this->session->sess_destroy();
        return redirect($_SERVER['HTTP_REFERER']);
    }

	public function verificarLogin()
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
            $this->load->model('Painel_model');
            $user = $this->Painel_model->check_credentials($email);

            if ($user) {

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

}
