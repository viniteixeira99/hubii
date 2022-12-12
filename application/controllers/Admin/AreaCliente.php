<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class areaCliente extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('areaCliente_model');
    } 

    public function index()
    {
        $this->load->view('areaCliente/login');
    }

    public function sair()
    {
        $this->session->sess_destroy();
        redirect('areaCliente');
    }

    public function resetarSenha()
    {
        $this->load->view('areaCliente/resetar_senha');
    }

    public function senhaSalvar()
    {
        $this->load->library('form_validation');
        $data['custom_error'] = '';
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if ($this->input->post("token") == null || $this->input->post("token") == '') {
            return redirect('areaCliente');
        }
        if ($this->form_validation->run() == false) {
            echo json_encode(['result' => false, 'message' => "Por favor digite a senha"]);
        } else {
            $token = $this->check_token($this->input->post("token"));
            $cliente = $this->check_credentials($token->email);

            if ($token == null && $cliente == null) {
                $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                $this->session->set_userdata($session_data);
                echo json_encode(['result' => false, 'message' => 'Dados de acesso estão incorretos.']);
            } else {
                if ($token->email == $cliente->email) {
                    $data = [
                        'senha' => password_hash($this->input->post("senha"), PASSWORD_DEFAULT),
                    ];

                    $dataToken = [
                        'token_utilizado' => true,
                    ];
                    $this->load->model('resetSenhas_model', '', true);
                    if ($this->areaCliente_model->edit('clientes', $data, 'idClientes', $cliente->idClientes) == true) {
                        if ($this->resetSenhas_model->edit('resets_de_senha', $dataToken, 'id', $token->id) == true) {
                            $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                            $this->session->set_userdata($session_data);
                            echo json_encode(['result' => true]);
                        }
                    }
                } else {
                    $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                    $this->session->set_userdata($session_data);
                    echo json_encode(['result' => false, 'message' => 'Dados divergentes.']);
                }
            }
        }
    }

    public function tokenManual()
    {
        $this->load->library('form_validation');
        $data['custom_error'] = '';
        $this->form_validation->set_rules('token', 'Token', 'required');

        if ($this->form_validation->run('token') == false) {
            $this->session->set_flashdata(['error' => (validation_errors() ? "Por favor digite o token" : false)]);
            return $this->load->view('areaCliente/token_digita');
        } else {
            $token = $this->check_token($this->input->post("token"));

            if ($this->validateDate($token->data_expiracao)) {
                $this->session->set_flashdata(['error' => 'Token expirado']);
                $session_data = $token->email ? ['nome' => $token->email] : ['nome' => 'Inexistente'];
                $this->session->set_userdata($session_data);
                return redirect(base_url() . 'index.php/areaCliente');
            } else {
                if ($token) {
                    if (($cliente = $this->check_credentials($token->email)) == null) {
                        $this->session->set_flashdata(['error' => 'Os dados de acesso estão incorretos.']);
                        $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                        $this->session->set_userdata($session_data);
                        return $this->load->view('areaCliente/token_digita');
                    } else {
                        if ($token->email == $cliente->email && $token->token_utilizado == false) {
                            return $this->load->view('areaCliente/nova_senha', $token);
                        } else {
                            $this->session->set_flashdata('error', 'Dados divergentes ou Token invalido.');
                            $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                            $this->session->set_userdata($session_data);
                            return redirect(base_url() . 'index.php/areaCliente');
                        }
                    }
                } else {
                    $this->session->set_flashdata(['error' => 'Token Invalido']);
                    $session_data = $token->email ? ['nome' => $token->email] : ['nome' => 'Inexistente'];
                    $this->session->set_userdata($session_data);
                    return $this->load->view('areaCliente/token_digita');
                }
            }
        }
        $this->load->view('areaCliente/token_digita');
    }

    public function verifyTokenSenha()
    {
        $token = $this->uri->uri_to_assoc(3);
        $token = $this->check_token($token["token"]);

        if ($token == null || $token == "") {
            $this->session->set_flashdata(['error' => 'Token invalido']);
            $session_data = $token->email ? ['nome' => $token->email] : ['nome' => 'Inexistente'];
            $this->session->set_userdata($session_data);
            log_info('Acesso via link do email (Token). Porém, Token invalido.');
            return $this->load->view('conecte/token_digita');
        } else {
            if ($this->validateDate($token->data_expiracao)) {
                $this->session->set_flashdata(['error' => 'Token expirado']);
                $session_data = $token->email ? ['nome' => $token->email] : ['nome' => 'Inexistente'];
                $this->session->set_userdata($session_data);
                log_info('Acesso via link do email (Token). Porém, Token expirado');
                return redirect(base_url() . 'index.php/mine');
            } else {
                if ($token) {
                    if (($cliente = $this->check_credentials($token->email)) == null) {
                        $this->session->set_flashdata(['error' => 'Os dados de acesso estão incorretos.']);
                        $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                        $this->session->set_userdata($session_data);
                        log_info('Acesso via link do email (Token). Porém, dados de acesso estão incorretos.');
                        return $this->load->view('conecte/token_digita');
                    } else {
                        if ($token->email == $cliente->email && $token->token_utilizado == false) {
                            return $this->load->view('conecte/nova_senha', $token);
                        } else {
                            $this->session->set_flashdata('error', 'Dados divergentes ou Token invalido.');
                            $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                            $this->session->set_userdata($session_data);
                            log_info('Acesso via link do email (Token). Porém, dados divergentes ou Token invalido.');
                            return redirect(base_url() . 'index.php/mine');
                        }
                    }
                } else {
                    $this->session->set_flashdata(['error' => 'Token Invalido']);
                    $session_data = $token->email ? ['nome' => $token->email] : ['nome' => 'Inexistente'];
                    $this->session->set_userdata($session_data);
                    log_info('Acesso via link do email (Token). Porém, Token invalido.');
                    return $this->load->view('conecte/token_digita');
                }
                return $this->load->view('conecte/nova_senha', $token);
            }
        }
    }

    public function gerarTokenResetarSenha()
    {
        if (!$cliente = $this->check_credentials($this->input->post('email'))) {
            $this->session->set_flashdata(['error' => 'Os dados de acesso estão incorretos.']);
            $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
            $this->session->set_userdata($session_data);
            log_info('Cliente solicitou alteração de senha. Porém falhou ao realizar solicitação!');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->load->helper('string');
            $this->load->model('resetSenhas_model', '', true);
            $data = [
                'email' => $cliente->email,
                'token' => random_string('alnum', 32),
                'data_expiracao' => date("Y-m-d H:i:s"),
            ];
            if ($this->resetSenhas_model->add('resets_de_senha', $data) == true) {
                $this->enviarRecuperarSenha($cliente->idClientes, $cliente->email, "Recuperar Senha", json_encode($data));
                $session_data = ['nome' => $cliente->nomeCliente];
                $this->session->set_userdata($session_data);
                log_info('Cliente solicitou alteração de senha.');
                $this->session->set_flashdata('success', 'Solicitação realizada com sucesso! <br> Um e-mail com as instruções será enviado para ' . $cliente->email);
                redirect(base_url() . 'index.php/mine');
            } else {
                $this->session->set_flashdata('error', 'Falha ao realizar solicitação!');
                $session_data = $cliente->nomeCliente ? ['nome' => $cliente->nomeCliente] : ['nome' => 'Inexistente'];
                $this->session->set_userdata($session_data);
                log_info('Cliente solicitou alteração de senha. Porém falhou ao realizar solicitação!');
                redirect(current_url());
            }
        }
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
            echo json_encode(['result' => false, 'message' => validation_errors()]);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $cliente = $this->check_credentials($email);

            if ($cliente) {
                // Verificar credenciais do usuário
                if (password_verify($password, $cliente->senha)) {
                    $session_data = ['nome' => $cliente->nomeCliente, 'cliente_id' => $cliente->idClientes, 'email' => $cliente->email, 'conectado' => true, 'isCliente' => true];
                    $this->session->set_userdata($session_data);
                    log_info($_SERVER['HTTP_CLIENT_IP'] . 'Efetuou login no sistema');
                    echo json_encode(['result' => true]);
                } else {
                    echo json_encode(['result' => false, 'message' => 'Os dados de acesso estão incorretos.']);
                }
            } else {
                echo json_encode(['result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.']);
            }
        }
    }

    public function painel()
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('mine');
        }

        $data['menuPainel'] = 'painel';
        $data['compras'] = $this->Conecte_model->getLastCompras($this->session->userdata('cliente_id'));
        $data['promocao'] = $this->Conecte_model->getLastOs($this->session->userdata('cliente_id'));
        $data['output'] = 'conecte/painel';
        $this->load->view('conecte/template', $data);
    }

    public function conta()
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaCliente');
        }

        $data['menuConta'] = 'conta';
        $data['result'] = $this->Conecte_model->getDados();

        $data['output'] = 'conecte/conta';
        $this->load->view('conecte/template', $data);
    }

    public function editarDados()
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaCliente');
        }

        $data['menuConta'] = 'conta';

        $this->load->library('form_validation');
        $data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $senha = $this->input->post('senha');
            if ($senha != null) {
                $senha = password_hash($senha, PASSWORD_DEFAULT);
                $data = [
                    'nomeCliente' => $this->input->post('nomeCliente'),
                    'documento' => $this->input->post('documento'),
                    'telefone' => $this->input->post('telefone'),
                    'celular' => $this->input->post('celular'),
                    'email' => $this->input->post('email'),
                    'senha' => $senha,
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                ];
            } else {
                $data = [
                    'nomeCliente' => $this->input->post('nomeCliente'),
                    'documento' => $this->input->post('documento'),
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
                ];
            }

            if ($this->Conecte_model->edit('clientes', $data, 'idClientes', $this->input->post('idClientes')) == true) {
                $this->session->set_flashdata('success', 'Dados editados com sucesso!');
                redirect(base_url() . 'index.php/mine/conta');
            } else {
            }
        }

        $data['result'] = $this->Conecte_model->getDados();

        $data['output'] = 'conecte/editar_dados';
        $this->load->view('conecte/template', $data);
    }

    public function compras()
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaClientes');
        }

        $data['menuVendas'] = 'vendas';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/areaCliente/compras/';
        $config['total_rows'] = $this->Conecte_model->count('vendas', $this->session->userdata('cliente_id'));
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['results'] = $this->Conecte_model->getCompras('vendas', '*', '', $config['per_page'], $this->uri->segment(3), '', '', $this->session->userdata('cliente_id'));

        $data['output'] = 'conecte/compras';
        $this->load->view('conecte/template', $data);
    }


    public function promocao()
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('promocao');
        }

        $data['menuPromocao'] = 'promocao';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/mine/os/';
        $config['total_rows'] = $this->Conecte_model->count('os', $this->session->userdata('cliente_id'));
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['results'] = $this->Conecte_model->getPromocao('promocao', '*', '', $config['per_page'], $this->uri->segment(3), '', '', $this->session->userdata('cliente_id'));

        $data['output'] = 'conecte/promocao';
        $this->load->view('conecte/template', $data);
    }

    public function visualizarPromocao($id = null)
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaCliente');
        }

        $data['menuPromocao'] = 'promocao';
        $this->data['custom_error'] = '';
        $this->load->model('Painel_model'); //Para pegar emitente na impressao
        $this->load->model('Promocao_model');

        $data['result'] = $this->Promocao_model->getById($this->uri->segment(3));
        $data['produtos'] = $this->Promocao_model->getProdutos($this->uri->segment(3));
        $data['emitente'] = $this->Painel_model->getEmitente();

        if ($data['result']->idUsuario != $this->session->userdata('usuario_id')) {
            $this->session->set_flashdata('error', 'Esta Promocão não está disponivel verifique com o lojista');
            redirect('areaCliente/painel');
        }

        $data['output'] = 'conecte/visualizar_promocao';
        $this->load->view('conecte/template', $data);
    }


    public function imprimirPromocao($id = null)
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaCliente');
        }

        $data['menuPromocao'] = 'Promocao';
        $this->data['custom_error'] = '';
        $this->load->model('Painel_model');
        $this->load->model('Promocao_model');
        $data['result'] = $this->Promocao_model->getById($this->uri->segment(3));
        $data['produtos'] = $this->Promocao_model->getProdutos($this->uri->segment(3));
        $data['emitente'] = $this->Painel_model->getEmitente();

        if ($data['result']->idClientes != $this->session->userdata('usuario_id')) {
            $this->session->set_flashdata('error', 'Esta promoção não está disponivel, verifique com o lojista');
            redirect('areaCliente/painel');
        }

        $this->load->view('conecte/imprimirPromocao', $data);
    }

    public function visualizarCompra($id = null)
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaCliente');
        }

        $data['menuVendas'] = 'vendas';
        $data['custom_error'] = '';
        $this->load->model('Painel_model');
        $this->load->model('vendas_model');

        $data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $data['emitente'] = $this->painel_model->getEmitente();

        if ($data['result']->clientes_id != $this->session->userdata('cliente_id')) {
            $this->session->set_flashdata('error', 'Esta venda não pertence ao cliente logado.');
            redirect('areCliente/painel');
        }

        $data['output'] = 'conecte/visualizar_compra';

        $this->load->view('conecte/template', $data);
    }

    public function imprimirCompra($id = null)
    {
        if (!session_id() || !$this->session->userdata('conectado')) {
            redirect('areaCliente');
        }

        $data['menuVendas'] = 'vendas';
        $data['custom_error'] = '';
        $this->load->model('Painel_model');
        $this->load->model('vendas_model');
        $data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $data['emitente'] = $this->Painel_model->getEmitente();

        if ($data['result']->clientes_id != $this->session->userdata('cliente_id')) {
            $this->session->set_flashdata('error', 'Esta Compra não pertence ao cliente logado.');
            redirect('areaCliente/painel');
        }

        $this->load->view('conecte/imprimirVenda', $data);
    }


    // método para clientes se cadastratem
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
                'nomeCliente' => set_value('nomeCliente'),
                'documento' => set_value('documento'),
                'telefone' => set_value('telefone'),
                'celular' => $this->input->post('celular'),
                'email' => set_value('email'),
                'senha' => password_hash($this->input->post('senha'), PASSWORD_DEFAULT),
                'rua' => set_value('rua'),
                'complemento' => set_value('complemento'),
                'numero' => set_value('numero'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
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
        $this->load->view('conecte/cadastrar', $data);
    }

    public function downloadanexo($id = null)
    {
        if ($id != null && is_numeric($id)) {
            $this->db->where('idAnexos', $id);
            $file = $this->db->get('anexos', 1)->row();

            $this->load->library('zip');
            $path = $file->path;
            $this->zip->read_file($path . '/' . $file->anexo);
            $this->zip->download('file' . date('d-m-Y-H.i.s') . '.zip');
        }
    }

	//Apenas um email por cliente
    private function check_credentials($email)
    {
        $this->db->where('email', $email);
        $this->db->limit(1);
        return $this->db->get('clientes')->row();
    }

    private function check_token($token)
    {
        $this->db->where('token', $token);
        $this->db->limit(1);
        return $this->db->get('resets_de_senha')->row();
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $dateStart = new \DateTime($date);
        $dateNow   = new \DateTime(date($format));

        $dateDiff = $dateStart->diff($dateNow);

        if ($dateDiff->days >= 1) {
            return true;
        } else {
            return false;
        }
    }

    private function enviarRecuperarSenha($idClientes, $clienteEmail, $assunto, $token)
    {
        $dados = [];
        $this->load->model('Painel_model');
        $this->load->model('clientes_model', '', true);

        $dados['emitente'] = $this->Painel_model->getEmitente();
        $dados['cliente'] = $this->clientes_model->getById($idClientes);
        $dados['resets_de_senha'] = json_decode($token);

        $emitente = $dados['emitente'][0]->email;
        $emitenteNome = $dados['emitente'][0]->nome;
        $remetente = $clienteEmail;

        $html = $this->load->view('conecte/emails/clientenovasenha', $dados, true);

        $this->load->model('email_model');

        $headers = [
            'From' => "\"$emitenteNome\" <$emitente>",
            'Subject' => $assunto,
            'Return-Path' => ''
        ];
        $email = [
            'to' => $remetente,
            'message' => $html,
            'status' => 'pending',
            'date' => date('Y-m-d H:i:s'),
            'headers' => serialize($headers),
        ];

        return $this->email_model->add('email_queue', $email);
    }

    private function enviarPromocaoPorEmail($idPromocao, $remetentes, $assunto)
    {
        $dados = [];

        $this->load->model('Painel_model');
        $this->load->model('Promocao_model');
        $dados['result'] = $this->promocao_model->getById($idPromocao);
        if (!isset($dados['result']->email)) {
            return false;
        }

        $dados['produtos'] = $this->promocao_model->getProdutos($idPromocao);
        $dados['servicos'] = $this->promocao_model->getServicos($idPromocao);
        $dados['emitente'] = $this->painel_model->getEmitente();

        $emitente = $dados['emitente'][0]->email;
        if (!isset($emitente)) {
            return false;
        }

        $html = $this->load->view('promocao/emails/promocao', $dados, true);

        $this->load->model('email_model');

        $remetentes = array_unique($remetentes);
        foreach ($remetentes as $remetente) {
            $headers = [
                'From' => $emitente,
                'Subject' => $assunto,
                'Return-Path' => ''
            ];
            $email = [
                'to' => $remetente,
                'message' => $html,
                'status' => 'pending',
                'date' => date('Y-m-d H:i:s'),
                'headers' => serialize($headers),
            ];
            $this->email_model->add('email_queue', $email);
        }

        return true;
    }

    private function enviarEmailBoasVindas($id)
    {
        $dados = [];
        $this->load->model('Painel_model');
        $this->load->model('clientes_model', '', true);

        $dados['emitente'] = $this->Painel_model->getEmitente();
        $dados['cliente'] = $this->clientes_model->getById($id);

        $emitente = $dados['emitente'][0]->email;
        $emitenteNome = $dados['emitente'][0]->nome;
        $remetente = $dados['cliente']->email;
        $assunto = 'Bem-vindo!';

        $html = $this->load->view('os/emails/clientenovo', $dados, true);

        $this->load->model('email_model');

        $headers = [
            'From' => "\"$emitenteNome\" <$emitente>",
            'Subject' => $assunto,
            'Return-Path' => ''
        ];
        $email = [
            'to' => $remetente,
            'message' => $html,
            'status' => 'pending',
            'date' => date('Y-m-d H:i:s'),
            'headers' => serialize($headers),
        ];

        return $this->email_model->add('email_queue', $email);
    }

    private function enviarEmailTecnicoNotificaClienteNovo($id)
    {
        $dados = [];
        $this->load->model('Painel_model');
        $this->load->model('clientes_model', '', true);
        $this->load->model('usuarios_model');

        $dados['emitente'] = $this->Painel_model->getEmitente();
        $dados['cliente'] = $this->clientes_model->getById($id);

        $emitente = $dados['emitente'][0]->email;
        $emitenteNome = $dados['emitente'][0]->nome;
        $assunto = 'Novo Cliente Cadastrado no Site';

        $usuarios = [];
        $usuarios = $this->usuarios_model->getAll();

        foreach ($usuarios as $usuario) {
            $dados['usuario'] = $usuario;
            $html = $this->load->view('promocao/emails/clientenovonotifica', $dados, true);
            $headers = [
                'From' => "\"$emitenteNome\" <$emitente>",
                'Subject' => $assunto,
                'Return-Path' => ''
            ];
            $email = [
                'to' => $usuario->email,
                'message' => $html,
                'status' => 'pending',
                'date' => date('Y-m-d H:i:s'),
                'headers' => serialize($headers),
            ];
            $this->email_model->add('email_queue', $email);
        }
    }
}
