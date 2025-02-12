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
        $data = array(
            'titulo' => 'Página Inicial',
            'boletins' => $this->Boletim->get_Boletim_registro('cadastro_info'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
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

    // Editar Boletim
    public function edit($boletim_id = NULL) {
        if(!$boletim_id || !$this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id))) {
            $this->session->set_flashdata('error', 'Boletim não encontrado');
            redirect('home');
        } else {
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
                $data = array(
                    'numero_provas_vida' => $this->input->post('numeroProvasVida'),
                    'numero_cadastrados' => $this->input->post('numeroCadastrados'),
                    'total_atendidos' => $totalsoma,
                    'masculino' => $this->input->post('masculino'),
                    'feminino' => $this->input->post('feminino'),
                    'passes_entregues' => $this->input->post('numeroPasses'),
                );

                // Escape de HTML
                $data = html_escape($data);

                // Atualiza o boletim
                $this->Boletim->update('cadastro_info', $data, array('idBoletim' => $boletim_id));

                // Mensagem de sucesso
                $this->session->set_flashdata('info', 'Boletim Atualizado');
                redirect('home');
            }

            // Carrega a view de edição
            $data = array(
                'titulo' => 'Atualizar boletim',
                'boletins' => $this->Boletim->get_by_id('cadastro_info', array('idBoletim' => $boletim_id)),
            );

            $this->load->view('layout/header');
            $this->load->view('home/edit', $data);
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
            );
            $this->load->view('layout/header');
            $this->load->view('home/add', $data);
            $this->load->view('layout/footer');
        } else {
            // Coleta os dados do formulário
            $data = array(
                'numero_Provas_vida' => $this->input->post('numeroProvasVida'),
                'numero_cadastrados' => $this->input->post('numeroCadastrados'),
                'total_atendidos' => $totalsoma,
                'masculino' => $this->input->post('masculino'),
                'feminino' => $this->input->post('feminino'),
                'passes_entregues' => $this->input->post('numeroPasses'),
                'idProvincia' => $this->input->post('idProvincia'),
                'id' => $this->input->post('id')
            );

            $idProvincia = $this->input->post('idProvincia');

            // Verifica se já existe um boletim para a mesma data e província
            $this->db->where('DATE(data_cadastro)', date('Y-m-d'));
            $this->db->where('idProvincia', $idProvincia);
            $query = $this->db->get('cadastro_info');

            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Já existe um boletim diário para esta província com a mesma data, volta a cadastrar amanhã.');
                redirect('home/add');
            } else {
                // Insere os dados no banco
                $this->Boletim->insert('cadastro_info', $data);
                $this->session->set_flashdata('info', 'Boletim cadastrado com sucesso!');
                redirect('home');
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

}
