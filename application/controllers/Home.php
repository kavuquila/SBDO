<?PHP

defined('BASEPATH') OR exit('NÃO AUTORIZADO');

class Home extends CI_Controller{

    // Construtor da classe
    public function __construct()
    { 
        parent::__construct();

        // Verifica se o usuário está logado
        if(!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('warni', 'Deves iniciar a sessão Primeiro!');
            redirect('login');      
        }

        // Carregar os modelos necessários
        $this->load->model('home_model');
        $this->load->model('Boletim');

        // Carregar a biblioteca Ion Auth
        $this->load->library('ion_auth');
    }

    // Página Inicial
    public function index(){ 

        if(!$this->ion_auth->is_admin()){
         redirect('home/boletins');
        }

        $data = array(
            'titulo' => 'Página Inicial',
            'boletins' => $this->Boletim->get_Boletim_registro('cadastro_info'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }

    public function boletins(){ 
        $user = $this->ion_auth->user()->row(); 
        $provincia = $user->idProvincia;

        $data = array(
            'titulo' => 'Página Inicial',
            'boletins' => $this->Boletim->get_all_provincia('cadastro_info', $provincia),
            'comentarios' => $this->Boletim->get_all_comentario('comentario'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/boletins');
        $this->load->view('layout/footer');
    }

    public function filtrar(){ 
        $data = array(
            'titulo' => 'Filtrar dados',
            'provincias' => $this->Boletim->get_all_p('provincia'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/filtrar');
        $this->load->view('layout/footer');
    }
    public function filtro(){ 

       $dataInicial = $this->input->post('dataInicial');
       $dataFinal = $this->input->post('dataFinal');
       $provincia = $this->input->post('provincia');

        if(empty(($dataInicial || $dataFinal || $provincia))){
            $this->session->set_flashdata('error', 'Deve selecionar os campos');
            redirect('filtrar');
        }else{

            $data = array(
                'titulo' => 'Filtrar dados',
                'boletins' => $this->Boletim->get_boletim_filtrar($dataInicial,$dataFinal,$provincia),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('home/docTable');
            $this->load->view('layout/footer');
           
        }

    }
    // Detalhes do Boletim
    public function docTable($boletim_id = NULL){
        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))){
            $this->session->set_flashdata('error', 'Boletim não encontrado');
            redirect('home');
        } else {
            $data = array(
                'titulo' => 'Boletim diário',
                'boletins' => $this->Boletim->get_Boletim_registro('cadastro_info', array('idBoletim' => $boletim_id)),
            );
            $this->load->view('home/docTable', $data);
        }
    }

    public function invalidar($boletim_id = NULL){
        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))){
            $this->session->set_flashdata('error', 'Boletim não encontrado');
            redirect('home');
        } else {
            $data = array(
                'titulo' => 'Boletim diário',
                'boletins' => $this->Boletim->get_Boletim_registro('cadastro_info', array('idBoletim' => $boletim_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('home/invalidar', $data);
            $this->load->view('layout/footer');
        }
    }

    // Editar Boletim
    public function edit($boletim_id = NULL) {
        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))) {
            $this->session->set_flashdata('error', 'Boletim não encontrado');
            redirect('home');
        } else {
            $data_cadastro = date('Y-m-d H:i:s');
            
            // Regras de validação
            $this->form_validation->set_rules('numeroProvasVida', 'Número de Provas de Vida', 'trim|required');
            $this->form_validation->set_rules('numeroCadastrados', 'Número de Cadastrados', 'trim|required');
            $this->form_validation->set_rules('masculino', 'Masculino', 'trim|required');
            $this->form_validation->set_rules('feminino', 'Feminino', 'trim|required');
            $this->form_validation->set_rules('numeroPasses', 'Passes entregues', 'trim|required');
            
            $masculino = intval($this->input->post('masculino'));
            $feminino = intval($this->input->post('feminino'));
            $totalsoma = $masculino + $feminino;
           
    
            if ($this->form_validation->run()) {
                $validacao = 'validado';
                // Dados para atualização do boletim
                $data = array(
                    'numero_provas_vida' => $this->input->post('numeroProvasVida'),
                    'numero_cadastrados' => $this->input->post('numeroCadastrados'),
                    'total_atendidos' => $totalsoma,
                    'masculino' => $this->input->post('masculino'),
                    'feminino' => $this->input->post('feminino'),
                    'passes_entregues' => $this->input->post('numeroPasses'),
                    'data_cadastro' => $data_cadastro,
                    'wait' => 'sim',

                );
    
                // Escape de HTML
                $data = html_escape($data);
    
                // Atualiza o boletim
                $this->Boletim->update('cadastro_info', $data, array('idBoletim' => $boletim_id));
    
                // Atualiza o status na tabela de comentários
                $comentario_data = array(
                    'responder' => 'validado', // Atualizando o status para 'validar'
                    'estado' => 'lido'
                );
    
                // Escape de HTML para os dados do comentário
                $comentario_data = html_escape($comentario_data);
    
                // Atualiza o comentário relacionado ao boletim
                $this->Boletim->update('comentario', $comentario_data, array('idBoletim' => $boletim_id));
    
                // Mensagem de sucesso
                $this->session->set_flashdata('info', 'Boletim e comentário atualizados');
                redirect('home');
            }
    
            // Carrega a view de edição
            $data = array(
                'titulo' => 'Atualizar boletim',
                'boletins' => $this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id)),
            );
    
            $this->load->view('layout/header', $data);
            $this->load->view('home/edit');
            $this->load->view('layout/footer');
        }
    }
    

    public function perfil(){
        $data = array(
            'titulo' => 'Perfil de Usuário',
           
        );
    
        $this->load->view('layout/header',$data);
        $this->load->view('home/perfil');
        $this->load->view('layout/footer');
      }

    // Adicionar Boletim
    public function add() {
        $user = $this->ion_auth->user()->row(); 
        $provincia = $user->idProvincia;

        // Regras de validação
        $this->form_validation->set_rules('numeroProvasVida', 'Nº Provas de vida', 'required');
        $this->form_validation->set_rules('numeroCadastrados', 'Nº Cadastrados', 'required');
       

        $masculino = intval($this->input->post('masculino'));
        $feminino = intval($this->input->post('feminino'));
        $totalsoma = $masculino + $feminino;

        // Verifica se a validação do formulário passou
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'titulo' => 'Cadastrar boletim',
                'provincia' => $this->Boletim->get_all_pro(),
            );
            $this->load->view('layout/header', $data);
            $this->load->view('home/add');
            $this->load->view('layout/footer');
        } else {

            $cadastrodata = date('Y-m-d');
            // Coleta os dados do formulário
            $data = array(
                'numero_Provas_vida' => $this->input->post('numeroProvasVida'),
                'numero_cadastrados' => $this->input->post('numeroCadastrados'),
                'total_atendidos' => $totalsoma,
                'masculino' => $this->input->post('masculino'),
                'feminino' => $this->input->post('feminino'),
                'passes_entregues' => $this->input->post('numeroPasses'),
                'idProvincia' => $this->input->post('idProvincia'),
                'id' => $this->input->post('id'),
                'cadastrodata' => $cadastrodata,
                'wait' => 'nao',
                'status' => 'validado',
            );

            $idProvincia = $this->input->post('idProvincia');

            // Verifica se já existe um boletim para a mesma data e província
            $this->db->where('DATE(cadastrodata)', date('Y-m-d'));
            $this->db->where('idProvincia', $idProvincia);
            $query = $this->db->get('cadastro_info');

            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Já existe um boletim diário para esta província com a mesma data, volta a cadastrar amanhã.');
                redirect('home/add');
            } else {
                // Insere os dados no banco
                $this->Boletim->insert('cadastro_info', $data);
                $this->session->set_flashdata('info', 'Boletim cadastrado com sucesso!');
                redirect('home/boletins');
            }
        }
    }

    // Deletar Boletim
    public function del($boletim_id = NULL){
        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))){
            $this->session->set_flashdata('error', 'Boletim não encontrado');
            redirect('home');
        } else {
            $this->Boletim->delete('cadastro_info', array('idBoletim' => $boletim_id));
            redirect('home');
        }
    }

    public function Inval() {
        // Regras de validação
        $this->form_validation->set_rules('comentario', 'Comentário', 'required');
        
        // Verifica se a validação do formulário passou
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'titulo' => 'Invalidar dados',
            );
            // Carregar as views
            $this->load->view('layout/header', $data);
            $this->load->view('home/invalidar');
            $this->load->view('layout/footer');
        } else {
            // Coleta os dados do formulário
            $invalidado = "invalidado";
            $data = array(
                'descricao' => $this->input->post('comentario'), 
                'id' => $this->input->post('id'), 
                'idBoletim' => $this->input->post('idboletim'),
                'responder' => 'invalidado',
                'estado' => 'naolido',
            );
    
            $datacadastro = array(
                'status' => 'invalidado', // Status "invalidado"
            );
    
            // Recupera o idBoletim corretamente do formulário
            $boletim_id = $this->input->post('idboletim');
            
            // Chamada para atualizar os dados na tabela cadastro_info
            $this->Boletim->update('cadastro_info', $datacadastro, array('idBoletim' => $boletim_id));
            
            // Chamada para inserir o comentário na tabela comentario
            $this->Boletim->insert('comentario', $data);
    
            // Configuração de mensagem de sucesso
            $this->session->set_flashdata('info', 'O boletim foi invalidado');
            
            // Redirecionamento
            redirect('home');
        }
    }
    



    public function validar($boletim_id) {

        // Verifica se a validação do formulário passou
        if ($boletim_id) {

               // Coleta os dados do formulário
               $invalidado = "validado";
       
               $datacadastro = array(
                   'status' => $invalidado, // Status "invalidado"
                   'wait' => 'nao', // Status "invalidado"
               );
       
               // Chamada para atualizar os dados na tabela cadastro_info
               $this->Boletim->update('cadastro_info', $datacadastro, array('idBoletim' => $boletim_id));
               
               // Configuração de mensagem de sucesso
               $this->session->set_flashdata('info', 'O boletim foi validado');
               
               // Redirecionamento
               redirect('home');
    
        } else {
            redirect('home');
         
        }
    }
    
    public function lerMensagem($boletim_id) {

        if ($boletim_id) {

               $lido = "lido";
       
               $datacadastro = array(
                   'estado' => $lido, 
               );
       
               // Chamada para atualizar os dados na tabela 
               $this->Boletim->update('comentario', $datacadastro, array('idBoletim' => $boletim_id));
               
               // Configuração de mensagem de sucesso
               $this->session->set_flashdata('info', 'Mensagem marcada como lida');
               
               // Redirecionamento
               redirect('home');
    
        } else {
            redirect('home');
         
        }
    }

}
