<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SessionsVerify_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function verificaLogin()
    {
        if(isset($_SESSION['Auth02']) and isset($_SESSION['NAME_ADMIN']) and isset($_SESSION['PASS_ADMIN']) and isset($_SESSION['ID_ADMIN'])):

            return true;
        else:

            return false;

        endif;
    }

    public function verificarLoginExistente()
    {
       
    }

    public function logVerEmpresa()
    { }
}
