<?php defined('BASEPATH') or exit('No direct script access allowed');

$config = [
    'clientes' => [
        [
            'field' => 'nomeCliente',
            'label' => 'Nome',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'documento',
            'label' => 'CPF/CNPJ',
            'rules' => 'trim|verific_cpf_cnpj|unique[clientes.documento.' . $this->uri->segment(3) . '.idClientes]',
            'errors' => [
                'verific_cpf_cnpj' => "O campo %s não é um CPF ou CNPJ válido."
            ],
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'trim',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|valid_email',
        ],
        [
            'field' => 'rua',
            'label' => 'Rua',
            'rules' => 'trim',
        ],
        [
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'trim',
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'trim',
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'trim',
        ],
        [
            'field' => 'estado',
            'label' => 'Estado',
            'rules' => 'trim',
        ],
        [
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'trim',
        ]
    ],
    'servicos' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'descricao',
            'label' => '',
            'rules' => 'trim',
        ],
        [
            'field' => 'preco',
            'label' => '',
            'rules' => 'required|trim',
        ]
    ],
    'produtos' => [
        [
            'field' => 'descricao',
            'label' => '',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'unidade',
            'label' => 'Unidade',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'precoCompra',
            'label' => 'Preço de Compra',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'precoVenda',
            'label' => 'Preço de Venda',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'estoque',
            'label' => 'Estoque',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'estoqueMinimo',
            'label' => 'Estoque Minimo',
            'rules' => 'trim',
        ]
    ],
    'usuarios' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'rg',
            'label' => 'RG',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'cpf',
            'label' => 'CPF',
            'rules' => 'required|trim|verific_cpf_cnpj|is_unique[usuarios.cpf]',
            'errors' => [
                'verific_cpf_cnpj' => "O campo %s não é um CPF válido."
            ],
        ],
        [
            'field' => 'rua',
            'label' => 'Rua',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'numero',
            'label' => 'Numero',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'estado',
            'label' => 'Estado',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|is_unique[usuarios.email]',
        ],
        [
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'situacao',
            'label' => 'Situacao',
            'rules' => 'required|trim',
        ]
    ],
    'promocao' => [
        [
            'field' => 'dataInicial',
            'label' => 'DataInicial',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'dataFinal',
            'label' => 'DataFinal',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'garantia',
            'label' => 'Garantia',
            'rules' => 'trim|numeric',
            'errors' => [
                'numeric' => 'Por favor digite apenas número.'
            ],
        ],
        [
            'field' => 'termoGarantia',
            'label' => 'Termo Garantia',
            'rules' => 'trim',
        ],
        [
            'field' => 'descricaoProduto',
            'label' => 'DescricaoProduto',
            'rules' => 'trim',
        ],
        [
            'field' => 'defeito',
            'label' => 'Defeito',
            'rules' => 'trim',
        ],
        [
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'observacoes',
            'label' => 'Observacoes',
            'rules' => 'trim',
        ],
        [
            'field' => 'clientes_id',
            'label' => 'clientes',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'usuarios_id',
            'label' => 'usuarios_id',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'laudoTecnico',
            'label' => 'Laudo Tecnico',
            'rules' => 'trim',
        ]
    ],
];
