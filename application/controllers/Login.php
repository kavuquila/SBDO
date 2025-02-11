<?php
defined('BASEPATH') OR exit ('Acção não permitida');

class Login extends CI_Controller{

    public function index(){

        if ($this->ion_auth->logged_in()) {
            // Se o usuário já estiver logado, redireciona para o painel ou página inicial
            redirect('home');
        }

        $data = array(
            'titulo' => 'Login',
        );

        $this->load->view('layout/header', $data);
        $this->load->view('login/index');
        $this->load->view('layout/footer');

    }

    public function auth(){


        $identity = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = FALSE;

        $verify = $this->ion_auth_model->login($identity, $password, $remember);

        if($verify){  

            redirect('home');
        
        }else{

            $this->session->set_flashdata('error', 'Verifique o seu email e a sua senha');
            redirect('login');
        }

    }

    public function logout(){
        $this->ion_auth->logout();
        redirect('login');
    }

}