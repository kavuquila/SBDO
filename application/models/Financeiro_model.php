<?php 

defined('BASEPATH') or exit('Ação Não permitida');

class Financeiro_model extends CI_Model{
    
    public function get_all_pagar(){
       
        $this->db->select([
           'contas_pagar.*',
           'fornecedor_id',
           'fornecedor_nome_fantasia as fornecedor',
        ]);

        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT');
        return $this->db->get('contas_pagar')->result();
        
    }


    /* METODO GET RECEBER */

    public function get_all_receber(){
       
        $this->db->select([
           'contas_receber.*',
           'cliente_id',
           'cliente_nome',
        ]);

        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT');
        return $this->db->get('contas_receber')->result();
        
    }

    //get contas receber relatorio orginal
    public function get_contas_receber_relatorio($contas_receber_status = NULL , $data_vencimento){

        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
         ]);

         $this->db->where('conta_receber_status', $contas_receber_status);

         $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT'); // FAZ A UNIÃO DE TABELAS

         if($data_vencimento){

            date_default_timezone_set('Africa/Luanda');

            $this->db->where('conta_receber_data_vencimento <', date('y-m-d'));

         }
        return $this->db->get('contas_receber')->result();
      
    }


     //GET CONTA RECEBER COM APENAS UM PARAMETRO
    public function get_contas_receber_relatorioo($contas_receber_status = NULL){

        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
         ]);

         $this->db->where('conta_receber_status', $contas_receber_status);

         $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT'); // FAZ A UNIÃO DE TABELAS

        return $this->db->get('contas_receber')->result();
      
    }

    // GET SUM CONTAS RECEBER COM APENAS UM PARAMETRO

    public function get_sum_contas_receber_relatorioo($contas_receber_status = NULL){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")), 2) as conta_receber_valor_total',
         ]);

         $this->db->where('conta_receber_status', $contas_receber_status);
        return $this->db->get('contas_receber')->row();
      
    }

    //get sum receber relatorio orginal
    public function get_sum_contas_receber_relatorio($contas_receber_status = NULL , $data_vencimento){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")), 2) as conta_receber_valor_total',
         ]);

         $this->db->where('conta_receber_status', $contas_receber_status);

         if($data_vencimento){

            date_default_timezone_set('Africa/Luanda');

            $this->db->where('conta_receber_data_vencimento <', date('y-m-d'));

         }
        return $this->db->get('contas_receber')->row();
      
    }


    //PAGAR RELATORIO

        //get contas receber relatorio orginal
        public function get_contas_pagar_relatorio($contas_pagar_status = NULL , $data_vencimento){

            $this->db->select([
                'contas_pagar.*',
                'fornecedor_id',
                'fornecedor_nome_fantasia',
                'fornecedor_cnpj'
             ]);
    
             $this->db->where('conta_pagar_status', $contas_pagar_status);
    
             $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT'); // FAZ A UNIÃO DE TABELAS
    
             if($data_vencimento){
    
                date_default_timezone_set('Africa/Luanda');
    
                $this->db->where('conta_pagar_data_vencimento <', date('y-m-d'));
    
             }
            return $this->db->get('contas_pagar')->result();
          
        }
    
            //get sum receber relatorio orginal
    public function get_sum_contas_pagar_relatorio($contas_pagar_status = NULL , $data_vencimento){

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_pagar_valor, ",", "")), 2) as conta_pagar_valor_total',
         ]);

         $this->db->where('conta_pagar_status', $contas_pagar_status);

         if($data_vencimento){

            date_default_timezone_set('Africa/Luanda');

            $this->db->where('conta_pagar_data_vencimento <', date('y-m-d'));

         }
        return $this->db->get('contas_pagar')->row();
      
    }


}