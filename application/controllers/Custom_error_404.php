<?php 

defined('BASEPATH') OR exit ('Não é permitido essa solicitação');

class Custom_error_404 extends CI_Controller {

public function __construt(){
    parent::__construct();
}

 public function index(){

    $data = array(
        'titulo' => 'Pagina não encontrada',
    );

    $this->load->view('custom_error_404', $data);


 }
}