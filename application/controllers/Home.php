<?php 

defined('BASEPATH') OR exit('NÃO AUTORIZADO');

class Home extends CI_Controller{

    // Para renderizar muitos elementos na tela é necessário chamar aqui o nosso construtor

    public function __construct()
    { 
        // Chama o construtor da classe pai CI_Controller
        parent::__construct();

        if(!$this->ion_auth->logged_in()){
            
            $this->session->set_flashdata('warni', 'Deves iniciar a sessão Primeiro!');
            redirect('login');      
        }
        $this->load->model('home_model');
        $this->load->model('Boletim');
         // Carregar a biblioteca Ion Auth
         $this->load->library('ion_auth');
    
    }  

    public function index(){ 
      
       
        $data = array(
            'titulo' => 'Página Inicial',
            'boletins' => $this->Boletim->get_Boletim_registro('cadastro_info'),

        );

        // PARA RENDERIZAR A NOSSA HOMEM NESSE PASSO CRIAMOS A UMA PASTA E DEPOIS COLOCAMOS UMA INDEX
        // A CHAMADA DA VIEW FICA DA SEGUINTE FORMA view('Home/index')
        $this->load->view('layout/header' ,$data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');

    }

  public function docTable($boletim_id = NULL){

    if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))){

        $this->session->set_flashdata('error', 'Boletim não encontrado');
        redirect('home');

    }else{

        $data = array(
            'titulo' => 'Boletim diário',
            'boletins' => $this->Boletim->get_Boletim_registro('cadastro_info', array('idBoletim' => $boletim_id)),
        );
          
        $this->load->view('home/docTable',$data);
       

    }
    
  }

  public function perfil(){
    $data = array(
        'titulo' => 'Perfil de Usuário',
       
    );

    $this->load->view('layout/header');
    $this->load->view('home/perfil');
    $this->load->view('layout/footer');
  }
  

    public function edit($boletim_id = NULL) {
        // Verifica se o boletim_id foi passado e se o boletim existe
        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))) {
            $this->session->set_flashdata('error', 'Boletim não encontrado');
            redirect('home');
        } else {
            // Definir as regras de validação do formulário
            $this->form_validation->set_rules('numeroProvasVida', 'Número de Provas de Vida', 'trim|required');
            $this->form_validation->set_rules('numeroCadastrados', 'Número de Cadastrados', 'trim|required');
            $this->form_validation->set_rules('numeroAtendidos', 'Total Atendidos', 'trim|required');
            $this->form_validation->set_rules('masculino', 'Masculino', 'trim|required');
            $this->form_validation->set_rules('feminino', 'Feminino', 'trim|required');
            $this->form_validation->set_rules('numeroPasses', 'Passes entregues', 'trim|required');
            
            if ($this->form_validation->run()) {
                // Coleta os dados do formulário
                $data = array(
                    'numero_provas_vida' => $this->input->post('numeroProvasVida'),
                    'numero_cadastrados' => $this->input->post('numeroCadastrados'),
                    'total_atendidos' => $this->input->post('numeroAtendidos'),
                    'masculino' => $this->input->post('masculino'),
                    'feminino' => $this->input->post('feminino'),
                    'passes_entregues' => $this->input->post('numeroPasses'),
                );
    
                // Escape de HTML para segurança
                $data = html_escape($data);
    
                // Realiza a atualização
                $this->Boletim->update('cadastro_info', $data, array('idBoletim' => $boletim_id));
    
                // Set flash message e redireciona
                $this->session->set_flashdata('info', 'Boletim Atualizado');
                redirect('home');
            }
    
            // Caso o formulário não seja válido, carregue os dados para o formulário
            $data = array(
                'titulo' => 'Atualizar boletim',
                'boletins' => $this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id)),
            );
    
            // Carrega as views
            $this->load->view('layout/header', $data);
            $this->load->view('home/edit');
            $this->load->view('layout/footer');
        }
    }
    
     

    public function add() {
        $user =  $this->ion_auth->user()->row(); 
        $provincia = $user->idProvincia;
    
        // Regras de validação do formulário
        $this->form_validation->set_rules('numeroProvasVida', 'Nº Provas de vida', 'required');
        $this->form_validation->set_rules('numeroCadastrados', 'Nº Cadastrados', 'required');
        $this->form_validation->set_rules('numeroAtendidos', 'Nº Atendidos', 'required');
    
        // Verificar se os dados do formulário são válidos
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'titulo' => 'cadastrar boletim',
            );
    
            $this->load->view('layout/header');
            $this->load->view('home/add', $data);
            $this->load->view('layout/footer');
        } else {
            // Pega os dados do formulário
            $data = array(
                'numero_Provas_vida' => $this->input->post('numeroProvasVida'),
                'numero_cadastrados' => $this->input->post('numeroCadastrados'),
                'total_atendidos' => $this->input->post('numeroAtendidos'),
                'masculino' => $this->input->post('masculino'),
                'feminino' => $this->input->post('feminino'),
                'passes_entregues' => $this->input->post('numeroPasses'),
                'idProvincia' => $this->input->post('idProvincia'),
                'id' => $this->input->post('id')
            );
    
            $idProvincia = $this->input->post('idProvincia');
            
            // Verifica se já existe um cadastro para a mesma data e província
            $this->db->where('DATE(data_cadastro)', date('Y-m-d'));
            $this->db->where('idProvincia', $idProvincia);
            $query = $this->db->get('cadastro_info');
    
            // Se já existir um cadastro, não insira os dados e exiba uma mensagem de erro
            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Já existe um boletim diário para esta província com a mesma data, volta a cadastrar amanhã.');
                redirect('home/add');
            } else {
                // Se não existir, insere os dados no banco de dados
                $this->Boletim->insert('cadastro_info', $data);
                $this->session->set_flashdata('info', 'Boletim cadastrado com sucesso!');
                redirect('home');
            }
        }
    }
    


    public function del($boletim_id = NULL){

        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))){

          $this->session->set_flashdata('error', 'Boletim não encontrado');
          redirect('home');

        }else{
          $this->Boletim->delete('cadastro_info', array('idBoletim' => $boletim_id));
          redirect('home');
         
        }

      }//FUNÇÃO DELETE

    

}