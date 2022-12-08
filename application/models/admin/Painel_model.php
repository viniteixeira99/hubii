<?php
class Painel_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        $result = !$one ? $query->result() : $query->row();
        return $result;
    }

    public function getById($id)
    {
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissao');
        $this->db->join('permissoes', 'permissoes.idPermissao = usuarios.permissoes_id', 'left');
        $this->db->where('idUsuarios', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function alterarSenha($senha)
    {
        $this->db->set('senha', password_hash($senha, PASSWORD_DEFAULT));
        $this->db->where('idUsuarios', $this->session->userdata('id'));
        $this->db->update('usuarios');

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        return false;
    }

    public function pesquisar($termo)
    {

        // buscando promoções
        $this->db->like('idPromocao', $termo);
        $this->db->or_like('descricaoProduto', $termo);
        $this->db->limit(15);
        $data['promocao'] = $this->db->get('promocao')->result();

        // buscando produtos
        $this->db->like('codDeBarra', $termo);
        $this->db->or_like('descricao', $termo);
        $this->db->limit(50);
        $data['produtos'] = $this->db->get('produtos')->result();

        return $data;
    }

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    public function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }

        return false;
    }

    public function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function getPromocaoAberta()
    {
        $this->db->select('promocao.*, promocao.nomePromocao');
        $this->db->from('promocao');
        $this->db->join('promocao', 'promocao.idPromocao = os.promocao_id');
        $this->db->where('promocao.status', 'Aberta');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

	public function getPromocaoEncerrada()
	{
		$this->db->select('promocao.*, promocao.nomePromocao');
        $this->db->from('promocao');
        $this->db->join('promocao', 'promocao.idPromocao = os.promocao_id');
        $this->db->where('promocao.status', 'Encerrada');
        $this->db->limit(10);
        return $this->db->get()->result();
	}


    public function getOsEstatisticas()
    {
        $sql = "SELECT status, COUNT(status) as total FROM os GROUP BY status ORDER BY status";
        return $this->db->query($sql)->result();
    }

    public function getEmitente()
    {
        return $this->db->get('emitente')->result();
    }

    public function addEmitente($nome, $site, $id, $logo)
    {
        $this->db->set('nome', $nome);
        $this->db->set('site', $site);
        $this->db->where('id', $id);
        $this->db->set('url_logo', $logo);
        return $this->db->insert('emitente');
    }

    public function editEmitente($nome, $id, $site)
    {
        $this->db->set('nome', $nome);
        $this->db->set('site', $site);
        $this->db->where('id', $id);
        return $this->db->update('emitente');
    }

    public function editLogo($id, $logo)
    {
        $this->db->set('url_logo', $logo);
        $this->db->where('id', $id);
        return $this->db->update('emitente');
    }

    public function editImageUser($id, $imageUserPath)
    {
        $this->db->set('url_image_user', $imageUserPath);
        $this->db->where('idUsuario', $id);
        return $this->db->update('usuario');
    }

    public function check_credentials($email)
    {
        $this->db->where('email', $email);
        $this->db->where('situacao', 1);
        $this->db->limit(1);
        return $this->db->get('usuarios')->row();
    }

    /**
     * Salvar configurações do sistema
     * @param array $data
     * @return boolean
     */
    public function saveConfiguracao($data)
    {
        try {
            foreach ($data as $key => $valor) {
                $this->db->set('valor', $valor);
                $this->db->where('config', $key);
                $this->db->update('configuracoes');
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
