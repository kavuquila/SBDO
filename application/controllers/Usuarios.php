<?php 

defined('BASEPATH') OR exit('NÃO AUTORIZADO');

class Usuarios extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!$this->ion_auth->logged_in()){
         
         $this->session->set_flashdata('info', 'Sua sessão expirou!');
         redirect('login');
         
       }

      }
    
       public function index(){

         if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('error',' Usuário não autorizado');
           redirect('home/perfil');
         }

         $data = array(
            'styles' => array(
               'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
               'vendor/datatables/jquery.dataTables.min.js',
               'vendor/datatables/dataTables.bootstrap4.min.js',
               'vendor/datatables/app.js'
            ),

            'usuarios' => $this->ion_auth->users()->result(), 
         );
         

         $this->load->view('layout/header', $data); // renderiza a views header 
         $this->load->view('usuarios/index'); // Rederiza a views principal index da pasta usuarios
         $this->load->view('layout/footer'); // Renderiza a views footer
       }

       public function edit($usuario_id = NULL) {

         if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('error',' Usuário não autorizado');
           redirect('home/perfil');
         }

         if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {

            $this->session->set_flashdata('error','Usuario não encontrado');
            redirect('usuarios');

         }else{
            
            //FORMAS PARA VALIDAÇÃO

            $this->form_validation->set_rules('first_name','','trim|required');
            $this->form_validation->set_rules('last_name','','trim|required');
            $this->form_validation->set_rules('email','','trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username','','trim|required|callback_username_check');
            $this->form_validation->set_rules('password','Senha','min_length[5]|max_length[255]');
            $this->form_validation->set_rules('comfirm_password','Confirme','matches[password]');

            if($this->form_validation->run()){

               $data = elements(
                  array(
                     'first_name',
                     'last_name',
                     'email',
                     'username',
                     'active',
                     'password',
                     'idProvincia'
                  ), $this->input->post()
               );

               $data = $this->security->xss_clean($data);

               $password = $this->input->post('password');
               
               //VERIFICA SE FOI PASSADA A PASSWORD
               if (!$password) {
                  unset($data['password']);
              }
              
               if($this->ion_auth->update($usuario_id, $data)){

                    // PROCEDIMENTO PARA RECUPERAR O PERFIL DO USUARIO
                    $perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();
                    
                    $perfil_usuario_post = $this->input->post('perfil_usuario');
                     
                     //se for diferente atualiza o grupo
                     if($perfil_usuario_post != $perfil_usuario_db->id){

                         $this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
                         $this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);

                     }
                     $this->session->set_flashdata('sucesso', 'Dados Salvos com sucesso');
               }else{
                  $this->session->set_flashdata('error', 'Erro ao salvar os dados');
               }

             // essa função vai redirecionar para usuarios
             redirect('usuarios');

            }else{

               $data = array(
                  'titulo' => 'Editar usuário',
                  'usuarios' => $this->ion_auth->user($usuario_id)->row(),
                  'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
               );
   
             
               $this->load->view('layout/header',$data);
               $this->load->view('usuarios/editar');
               $this->load->view('layout/footer');

            }

          }
          
       } //FIM FUNÇÃO EDITAR

       // INICIO DA FUNÇÃO ADD PARA CADASTRAR USUARIOS
       
       public function add(){

         if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('error',' Usuário não autorizado');
           redirect('home/perfil');
         }
         $this->form_validation->set_rules('first_name','','trim|required');
         $this->form_validation->set_rules('last_name','','trim|required');
         $this->form_validation->set_rules('email','','trim|required|valid_email|is_unique[users.email]');
         $this->form_validation->set_rules('username','','trim|required|is_unique[users.username]');
         $this->form_validation->set_rules('password','Senha','required|min_length[5]|max_length[255]');
         $this->form_validation->set_rules('comfirm_password','Confirme','matches[password]');
         $this->form_validation->set_rules('idProvincia','','trim|required');
         $this->form_validation->set_rules('genero','','trim|required');

        
         //ESSE IF , CASO OS DADOS FOREM PASSADOS COM SUCESSO , ENTÃO ELE EXECUTA O CADASTRAMENTO
         if($this->form_validation->run()){
            
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $idProvincia = $this->security->xss_clean($this->input->post('idProvincia'));
           

            $additional_data = array(
                              'first_name' => $this->input->post('first_name'),
                              'last_name' => $this->input->post('last_name'),
                              'username' => $this->input->post('username'),
                              'active' => $this->input->post('active'),
                              'idProvincia' => $this->input->post('idProvincia'),
                              'genero' => $this->input->post('genero'),
                              );

            $group = array($this->input->post('perfil_usuario')); // Sets user to admin.

            $additional_data = $this->security->xss_clean($additional_data);

            $group = $this->security->xss_clean($group);
   

             //FAZ UMA VERIFICA SE OS DADOS FORAM SALVOS

             if( $this->ion_auth->register($username, $password, $email, $additional_data, $group, $idProvincia,$genero)){
               //ESSA LINHA ABAIXO VAI GUARDA A MENSAGEM DE SUCESSO
                $this->session->set_flashdata('sucesso','Dados Salvos com sucess');
             }else{
               //ESSA LINHA ABAIXO VAI GUARDA A MENSAGEM DE SUCESSO
               $this->session->set_flashdata('erro','Erro ao cadastrar usuario');
             }

             redirect('usuarios');

         }else{

            $data = array(
               'titulo' => 'Cadastrar usuário', // ESSE TITULO VAI SER RENDERIZADO NA VIEW VAI SER O TITULO
            );
   

            //RENDERIZA AS VIEWS 
            $this->load->view('layout/header',$data);
            $this->load->view('usuarios/add');
            $this->load->view('layout/footer');

         }

        

       } //FIM FUNÇÃO CADASTRAR ////////////////////////////////////////
         //FIM FUNÇÃO CADASTRAR////////////////////////////////////////
         //FIM FUNÇÃO CADASTRAR////////////////////////////////////////
         //FIM FUNÇÃO CADASTRAR////////////////////////////////////////

       public function del($usuario_id = NULL){ // FUNÇÃO DE DELETAR
         if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('error',' Usuário não autorizado');
           redirect('home/perfil');
         }
          
          //fazer primeiro uma verificação para saeber se não foi passado um usuario
          
          if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){
             $this->session->set_flashdata('error', 'Usuário Não encontrado');

             redirect('usuarios');

          }

          if($this->ion_auth->is_admin($usuario_id)){
             $this->session->set_flashdata('error','O administrador não pode ser excluido');
             redirect('usuarios');
          }

          if($this->ion_auth->delete_user($usuario_id)){
            $this->session->set_flashdata('sucesso','Usuário excluido com sucesso');
            redirect('usuarios');
          }else{
            $this->session->set_flashdata('error','Erro ao excluir usuario');
            redirect('usuarios');
          }
       }//FIM DA FUNÇÃO DEL
       
       public function email_check($email){

         $usuario_id = $this->input->post('usuario_id');

         if($this->core_model->get_by_Id('users', array('email' => $email, 'id !=' => $usuario_id))){

            $this->form_validation->set_message('email_check','Esse email já existe');

            return FALSE;

         }else{
            return TRUE;
         }
       }

       public function username_check($username){

         $usuario_id = $this->input->post('usuario_id');

         if($this->core_model->get_by_Id('users', array('username' => $username, 'id !=' => $usuario_id))){

            $this->form_validation->set_message('username_check','Esse usuario já existe');

            return FALSE;

         }else{
            return TRUE;
         }
       }

    }
