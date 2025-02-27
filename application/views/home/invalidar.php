
        <!-- Sidebar -->
        <?php $this->load->view('layout/sidebar'); ?>
        <?php $user =  $this->ion_auth->user()->row(); ?> 
        <!-- End of Sidebar -->
         <style>
            .table-bordered th, .table-bordered td {
            border: 1px solid #fbcfc5 !important;
            }

            #comentario{max-width:35%;}
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
        <h3><strong>Invalidar dados</strong></h3><br>
        <table class="table table-striped table-bordered mt-3 mb-3" style="border:1px solid red">
            <thead style="font-size:18px; color:#333; background-color:#f4f4f4;" class="text-center">
                <tr>
                    <th scope="col">N º</th>
                    <th scope="col">PROVÍNCIA</th>
                    <th scope="col">Nº ATENDIDOS</th>
                    <th scope="col">Masculino</th>
                    <th scope="col">Femenino</th>
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
                $dataHora = date('Y-m-d H:i:s');
                $dataCadastro = $boletim->data_cadastro;
                $diferenca = strtotime($dataHora) - strtotime($dataCadastro);
    
                // Verifica se a diferença é menor que 60 segundos
                 echo ($diferenca < 60 && $user->idProvincia != $boletim->idProvincia ? 'fundo-blink' : '');
            ?>">
                    <th scope="row"><?php echo $count++; ?></b></th>
                    <td><?php echo $boletim->nomeProvincia; ?></td>
                    <td><b><?php echo $boletim->total_atendidos; ?></b></td>
                    <td><b><?php echo $boletim->masculino; ?></b></td>
                    <td><b><?php echo $boletim->feminino; ?></b></td>
                    <td><b><?php echo $boletim->numero_provas_vida; ?></b></td>
                    <td><b><?php echo $boletim->numero_cadastrados; ?></b></td>
                    <td><b><?php echo $boletim->passes_entregues; ?></b></td>
                    <td><?php echo tempo_relativo($boletim->data_cadastro); ?></td>
                    <td><?php echo $boletim->first_name.' '.$boletim->last_name; ?></td>
                    <td>

                    <?php if($this->ion_auth->is_admin()): ?>
                        <a href="<?php echo base_url('home/invalidar/'.$boletim->idBoletim); ?>" class="btn btn-outline-danger btn-sm"><b>Ivalidar dados</b></a>
                    <?php endif; ?>
                  </td>
                </tr>
               <?php endforeach; ?>
            </tbody>
            <!-- Formulário para Enviar Comentário -->


        </table>
        <div class="container-fluid" style="padding:0">
            
    <form action="<?php echo base_url('Home/inval'); ?>" method="POST">
        <div class="form-group">
            <label for="comentario">Comentário:</label>
            <textarea id="comentario" name="comentario" class="form-control" rows="3" placeholder="Escreva uma mensagem para notificar a secção..."></textarea>
            <input type="text" name="id" value="<?php echo $user->id; ?>" style="display:none;">
            <input type="text" name="idboletim" value="<?php echo $boletim->idBoletim; ?>" style="display:none;">
        </div>
        <button type="submit" class="btn btn-danger mt-2">Concluir ação</button>
    </form>
</div>
    </div>
</div>
</div><!-- End of Main Content -->


