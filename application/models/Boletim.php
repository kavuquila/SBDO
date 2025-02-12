<?php

defined('BASEPATH') OR exit('Não autorizado');

class Boletim extends CI_Model{

   public function get_all($tabela = NULL , $condicao = NULL){
    
    if($tabela){
        if(is_array($condicao)){
            $this->db->where($condicao);
        }
        $this->db->join('provincia','provincia.idProvincia = cadastro_info.idProvincia');
        return $this->db->get($tabela)->result();
    }else{
        return FALSE;
    }
  
   }

   public function get_all_p($tabela = NULL , $condicao = NULL){
    
    if($tabela){
        if(is_array($condicao)){
            $this->db->where($condicao);
        }
        return $this->db->get($tabela)->result();
    }else{
        return FALSE;
    }
  
   }

   public function get_boletim_filtrar($dataInicial = NULL, $dataFinal = NULL, $provincia){
    
        $this->db->select('*');
        $this->db->from('cadastro_info');

        if(!empty($dataInicial)){

           $this->db->where('data_cadastro >=',$dataInicial);

        }
        if(!empty($dataFinal)){

            $this->db->where('data_cadastro <=',$dataFinal);
 
         }
         if(!empty($provincia)){

            $this->db->where('provincia.idProvincia',$provincia);
 
         }
         $this->db->join('provincia', 'provincia.idProvincia = cadastro_info.idProvincia');
         $this->db->join('users', 'users.id = cadastro_info.id');

         $sql = $this->db->get();

        return $sql->result();
    }



   public function get_Boletim_registro($tabela = NULL , $condicao = NULL){
    
    if($tabela){
        if(is_array($condicao)){
            $this->db->where($condicao);
        }

        // Subconsulta para pegar o ID do registro mais recente de cada província
        $this->db->select('
            cadastro_info.*,
            provincia.*,
             users.* 
        ');

        $this->db->join('provincia', 'provincia.idProvincia = cadastro_info.idProvincia');
        $this->db->join('users', 'users.id = cadastro_info.id');

        // Subconsulta para pegar o registro com a maior data_cadastro para cada província
        $this->db->where("cadastro_info.data_cadastro IN (
            SELECT MAX(data_cadastro) 
            FROM cadastro_info
            WHERE cadastro_info.idProvincia = provincia.idProvincia
        )");

        // Ordenar pela data de cadastro para garantir que está pegando o mais recente
        $this->db->order_by('cadastro_info.data_cadastro', 'DESC');

        return $this->db->get($tabela)->result();
    } else {
        return FALSE;
    }
}


   public function get_by_id($tabela = NULL, $condicao =NULL){
    if($tabela && is_array($condicao)){
     $this->db->where($condicao);
     $this->db->limit(1);

     return $this->db->get($tabela)->row();
    } else{
        return FALSE;
    }
  }

   public function insert($tabela,$data) {

    
        return $this->db->insert($tabela, $data);  // Insere os dados na tabela 'usuarios'
  
    }

    public function get_boletim($tabela = NULL,  $idProvincia = NULL){
    
        if ($tabela) {
          
            // Fazendo o join com a tabela provincia
            $this->db->join('provincia', 'provincia.idProvincia = cadastro_info.idProvincia');
            
            // Adicionando o filtro para pegar um único idProvincia, caso o $idProvincia seja passado
            if ($idProvincia) {
                $this->db->where('cadastro_info.idProvincia', $idProvincia);
            }
            
            // Realizando a consulta e retornando o resultado
            return $this->db->get($tabela)->row();  // Usando row() para pegar um único registro
        } else {
            return FALSE;
        }
    }

    
    public function update($tabela = NULL, $data = NULL, $condicao = NULL){

        if($tabela && is_array($data) && IS_ARRAY($condicao)) {
  
          $this->db->update($tabela, $data, $condicao);
  
          if( $this->db->update($tabela, $data, $condicao)){
            $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
          }
  
          else{
            $this->session->set_flashdata('error', 'Erro ao atualizar dados no banco');
          }
  
        }else{
            return FALSE;
        }
    }


    public function delete($tabela = NULL, $condicao = NULL){
    
        $this->db->db_debug = FALSE;
    
        if($tabela && is_array($condicao)){
    
          $status = $this->db->delete($tabela, $condicao);
    
          $error = $this->db->error();
    
           if(!$status){
             foreach ($error as $code){
    
                if($code == 1451){
                    $this->session->set_flashdata('error', 'Não pode ser excluido porque esta ser usado em outra tabela');
                }
             }
           }else{ 
              $this->session->set_flashdata('sucesso', 'registro excluido');
           }
           $this->db->db_debug = TRUE;
    
        }
        else{
          return  FALSE;
       }
    
      }

}
