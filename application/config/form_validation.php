<?php defined('BASEPATH') or exit('No direct script access allowed');

$config = [
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
    'tiposUsuario' => [
        [
            'field' => 'nomeTipo',
            'label' => 'NomeTipo',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'situacao',
            'label' => 'Situacao',
            'rules' => 'required|trim',
        ]
    ]
];
