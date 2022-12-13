<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxAdmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Funcoes_Model');
        $this->load->model('ajaxAdmin_model');

    }

    public function loginAdmin()
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

    public function Adicionar()
    {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = [
                'descricao' => set_value('descricao'),
            ];

            if ($this->produtos_model->add('produtos', $data) == true) {
                $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
                redirect(site_url('produtos/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'produtos/adicionarProduto';
        return $this->layout();
    }

    public function visualizar()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('home');
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto não encontrado.');
            redirect(site_url('produtos/editar/') . $this->input->post('idProdutos'));
        }

        $this->data['view'] = 'produtos/visualizarProduto';
        return $this->layout();
    }

    public function editar()
    {

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
            redirect(base_url() . 'index.php/produtos/gerenciar/');
        }

        $this->produtos_model->delete('produtos_voucher', 'produtos_id', $id);
        $this->produtos_model->delete('itens_de_vendas', 'produtos_id', $id);
        $this->produtos_model->delete('produtos', 'idProdutos', $id);

        $this->session->set_flashdata('success', 'Produto excluido com sucesso!');
        redirect(site_url('produtos/gerenciar/'));
    }

    public function delete()
    {

        $id = $this->input->post('id');
        $item = $this->item_model->getByIdPromocao($id);
        if ($item == null) {
            $item = $this->item_model->getById($id);
            if ($item == null) {
                $this->session->set_flashdata('error', 'Erro ao tentar excluir item.');
                redirect(base_url() . 'index.php/item/gerenciar/');
            }
        }

        $this->ajaxAdmin_model->delete('servicos_item', 'item_id', $id);
        $this->ajaxAdmin_model->delete('produtos_item', 'item_id', $id);
        $this->ajaxAdmin_model->delete('item', 'idItem', $id);

        $this->session->set_flashdata('success', 'Item excluído com sucesso!');
        redirect(site_url('admin/item/gerenciar')); //TODO criar view de itens
    }

    public function ValidarCompras()
    {
        $validado =  0;

        if (isset($_POST['vouchers']) and !empty($_POST['vouchers']) or isset($_POST['vouchers']) and count($_POST['vouchers']) > 0):
            foreach ($_POST['vouchers'] as $key => $value) {

                $this->db->from('pedidos');
                $this->db->where('id', $value);
                $get = $this->db->get();
                $count = $get->num_rows();
                $resp = $get->result_array();
                if ($count > 0 and $resp[0]['pago'] == 0):
                    $validado = 'Esse voucher ainda não foi pago!';

                else:

                    $dd['data_validado'] = date('d/m/Y');
                    $dd['utilizado'] = 1;
                    $this->db->where('id', $value);
                    $this->db->where('pago', 1);
                    if ($this->db->update('pedidos', $dd)):

                        $dv['empresas'] = $resp[0]['id'];
                        $dv['data'] = date('d/m/Y');
                        $dv['ip'] = $_SERVER["REMOTE_ADDR"];
                        $dv['status'] = 1;
                        $this->db->insert('validados', $dv);

                        if($resp[0]['pago'] == 1):
                            $validado =  11;

                        else:
                            $validado = 'Erro ao validar o voucher, verifique se ele foi pago!';
                         endif;
                    else:
                        $validado = 'Erro ao validar o voucher, verifique se ele foi pago!';
                        echo 'Erro ao validar o voucher, verifique se ele foi pago!';

                    endif;

                endif;

            }

        else:
            $validado = 'Selecione os Vouchers para validação.';
        endif;

        echo $validado;
    }

    public function editarVoucher()
    {
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Voucher não pode ser encontrado');
            redirect('admin/home');
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->data['editavel'] = $this->ajaxAdmin_model->isEditable($this->input->post('idOs'));
        if (!$this->data['editavel']) {
            $this->session->set_flashdata('error', 'Este voucher já está .');

            redirect(site_url('vouchers'));
        }

        if ($this->form_validation->run('voucher') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $dataInicial = $this->input->post('dataInicial');
            $dataFinal = $this->input->post('dataFinal');

            try {
                $dataInicial = explode('/', $dataInicial);
                $dataInicial = $dataInicial[2] . '-' . $dataInicial[1] . '-' . $dataInicial[0];

                $dataFinal = explode('/', $dataFinal);
                $dataFinal = $dataFinal[2] . '-' . $dataFinal[1] . '-' . $dataFinal[0];
            } catch (Exception $e) {
                $dataInicial = date('Y/m/d');
            }

            $data = [
                'dataInicial' => $dataInicial,
                'dataFinal' => $dataFinal,
                'descricaoProduto' => $this->input->post('descricaoProduto'),
                'status' => $this->input->post('status'),
                'observacoes' => $this->input->post('observacoes'),
            ];
            $voucher = $this->ajaxAdmin_model->getById($this->input->post('idVoucher'));

            if (strtolower($this->input->post('status')) == "cancelado" && strtolower($voucher->status) != "cancelado") {
                $this->desativaVoucher($this->input->post('idVoucher'));
            }

            if ($this->ajaxAdmin_model->edit('voucher', $data, 'idvoucher', $this->input->post('idvoucher')) == true) {
                $this->load->model('ajaxAdmin_model');

                $idvoucher = $this->input->post('idvoucher');

                $idvoucher = $this->ajaxAdmin_model->getById($idvoucher);


                $this->session->set_flashdata('success', 'Os editada com sucesso!');
                redirect(site_url('voucher/editar/') . $this->input->post('idVoucher'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao editar voucher</p></div>';
            }
        }

        $this->data['result'] = $this->ajaxAdmin_model->getById($this->uri->segment(3));

        $this->load->model('ajaxAdmin_model');

        $this->data['view'] = 'voucher/editarVoucher';
        return $this->layout();
    }

    public function ValidarDesconto()
    {
        $validado =  0;

        if (isset($_POST['vouchers']) and !empty($_POST['vouchers']) or isset($_POST['vouchers']) and count($_POST['vouchers']) > 0):
            foreach ($_POST['vouchers'] as $key => $value) {



                    $dd['data_validado'] = date('d/m/Y');
                    $dd['utilizado'] = 1;
                    $this->db->where('id', $value);
                    if ($this->db->update('pedidos', $dd)):

                        $dv['data'] = date('d/m/Y');
                        $dv['ip'] = $_SERVER["REMOTE_ADDR"];
                        $dv['status'] = 1;
                        $this->db->insert('validados', $dv);
                        $validado =  11;

                    else:
                        $validado = 'Erro ao validar o voucher, tente novamente!';

                    endif;

            }

        else:
            $validado = 'Selecione os Vouchers para validação.';
        endif;

        echo $validado;
    }
    
}