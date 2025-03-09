
        <!-- Sidebar -->
        <?php $this->load->view('layout/sidebar'); ?>
        <?php $user =  $this->ion_auth->user()->row(); ?> 
        <!-- End of Sidebar -->

        <style>
            /* Definindo a animação para o efeito de piscar com mudança de fundo */
  @keyframes piscar-fundo {
    0% { background-color: white; }  /* Cor normal de fundo */
    50% { background-color: rgb(253, 217, 226); }  /* Cor alterada durante o piscar */
    100% { background-color: white; }  /* Retorna à cor original */
  }

  .fundo-blinkk {
    animation: piscar-fundo 1s infinite; /* 1s para duração e infinite para repetição */
  }

  @keyframes piscarlaranja {
    0% { background-color: rgb(249, 243, 238); }  /* Cor normal de fundo */
    50% { background-color: rgb(249, 243, 238); }  /* Cor alterada durante o piscar */
    100% { background-color: rgb(249, 243, 238); }  /* Retorna à cor original */
  }

  .fundo-laranja {
    animation: piscarlaranja 1s infinite; /* 1s para duração e infinite para repetição */
  }


  .content {
  padding: 20px;
  background-color: #fff;
  margin: 50px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Estilos para a sobreposição da mensagem */
.overlay-message {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  z-index: 1000;
}

.message-box {
  background-color: #fff;
  padding: 15px 20px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  display: flex;
  align-items: center;
  max-width: 300px;
  border-left: 5px solid rgb(255, 0, 55);
  background-color: #f7faff;
}

.user-icon {
  font-size: 28px;
  margin-right: 15px;
}

.message-content {
  font-size: 14px;
  color: #333;
}

.sender {
  font-size: 16px;
  font-weight: bold;
  color:rgb(223, 45, 75);
}

.messagem {
  font-size: 14px;
  color: #555;
}



        </style>

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <?php $this->load->view('layout/navbar'); ?>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid" style="max-width: 95%;height:1000px;">
            <?php if($message = $this->session->flashdata('error')): ?>
     <div class="row">
      <div class="col-md-12">
        <div  id="alerta" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> <i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>
</div>

<?php endif; ?>
<?php if($message = $this->session->flashdata('info')): ?>
<div class="row">
    <div class="col-md-12" >
        <div id="alerta" class="alert alert-info alert-dismissible fade show" role="alert">
        <strong> <i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>
</div>
<?php endif; ?>

    <div class="row" id="atualizaDiv">

        <h3><strong>DADOS DAS OCORRÊNCIAS DIÁRIAS</strong></h3><br>
       
        <table class="table table-striped table-bordered mt-3 mb-3">
            
            <thead style="font-size:18px; color:#333; background-color:#f4f4f4;" class="text-center">
                <tr>
                    <th scope="col">N º</th>
                    <th scope="col">PROVÍNCIA</th>
                    <th scope="col">Nº ATENDIDOS</th>
                    <th scope="col">Masculino</th>
                    <th scope="col">Feminino</th>
                    <th scope="col">PROVA DE VIDA</th>
                    <th scope="col">CADASTRAMENTO</th>
                    <th scope="col">RECLAMAÇÕES</th>
                    <th scope="col">ÚLTIMA ATUALIZAÇÃO</th>
                    <th scope="col">FUNCIONÁRIO</th>
                    <th scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody style="font-size:24px; color:#555;" class="text-center">
                <?php $count = 1;  foreach($boletins as $boletim): ?>
                <tr class="<?php
                
                if($boletim->status == 'invalidado' AND $boletim->wait == 'nao'){
                  echo 'fundo-blinkk';
                }elseif ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') {
                  echo 'fundo-laranja';
                }else{
                  echo '';
                }
            ?>">
                    <th scope="row"><?php echo $count++; ?></b></th>
                    <td><?php echo $boletim->nomeProvincia; ?></td>
                    <td><b><?php echo $boletim->total_atendidos; ?></b></td>
                    <td><b><?php echo $boletim->masculino; ?></b></td>
                    <td><b><?php echo $boletim->feminino; ?></b></td>
                    <td><b><?php echo $boletim->numero_provas_vida; ?></b></td>
                    <td><b><?php echo $boletim->numero_cadastrados; ?></b></td>
                    <td><b><?php echo $boletim->passes_entregues; ?></b></td>
                    <td>
                    <?php if($boletim->status == 'invalidado' AND $boletim->wait == 'nao'){ ?> 
                        <span style="color:red">Boletim invalidado</span>
                    <?php }elseif($boletim->status == 'invalidado' AND $boletim->wait == 'sim'){?>
                      <span style="color:orange">Aguardando Aprovação...</span>
                      <?php }else{ echo tempo_relativo($boletim->data_cadastro); }?>

                   </td>
                    <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                    <td>
                        <?php if($boletim->status == 'invalidado' AND $boletim->wait == 'nao'){ ?>
                            
                            <a href="<?php echo base_url('home/edit/'.$boletim->idBoletim); ?>" class="btn btn-sm btn-danger" > <i class="fas fa-pencil-alt"></i> Editar boletim</a>
                        <?php }elseif($boletim->status == 'invalidado' AND $boletim->wait == 'sim'){?>
                          <a href="<?php echo base_url('home/edit/'.$boletim->idBoletim); ?>" class="btn btn-sm btn-warning"> <i class="fas fa-success"></i><img src="<?php echo base_url('public/img/Animation - 1740665334024.gif');?>" height="32"> Aguardando </a>
                       <?php }else{ ?>
                        <a href="<?php echo base_url('home/docTable/'.$boletim->idBoletim); ?>" class="btn btn-sm btn-primary" target="_blank"> <i class="fas fa-eye"></i></a>
                        <a href="<?php echo base_url('home/edit/'.$boletim->idBoletim); ?>" class="btn btn-sm btn-primary" > <i class="fas fa-pencil-alt"></i></a>
                        <a href="<?php echo base_url('home/del/'.$boletim->idBoletim); ?>" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i></a>
                      <?php } ?>
                  </td>
                </tr>
               <?php endforeach; ?>
            </tbody>
  
        </table>
    </div>

    <?php foreach($comentarios as $comentario): ?>
    <?php if($comentario->idBoletim == $boletim->idBoletim AND $comentario->responder == 'invalidado'): ?>
        <div class="overlay-message">
    <div class="message-box">
      <div class="user-icon"><i class="fas fa-comments"></i></div>
      <div class="message-content">
        <p class="sender">Mensagem Enviada por:
        <?php echo '@'.$comentario->first_name.' '.$comentario->last_name; ?>
        </p>
        <p class="messagem"><?php echo $comentario->descricao; ?></p>
      </div>
    </div>
  </div>
   <?php endif; ?>
   <?php endforeach; ?>
  
</div>

</div><!-- End of Main Content -->
<script>
    setInterval(function() {
    location.reload();
   }, 5000); // 5000 milissegundos = 5 segundos

</script>



