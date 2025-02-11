<?php

defined('BASEPATH') OR exit('Não tem acesso');

class Cadastrar extends CI_Controller{
     
    // FUNÇÃO PARA RENDERIZAR A VIEW PRINCIPAL DESTE CONTROLADOR

    public function index(){

        $this->load->view('cadastrar/add'); // AQUI RENDERIZA A VIEW PRODUTO
    }

}