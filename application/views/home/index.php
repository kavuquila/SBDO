<!-- Sidebar -->
<?php $this->load->view('layout/sidebar'); ?>
<?php $user =  $this->ion_auth->user()->row(); ?> 
<!-- End of Sidebar -->

<style>
    .notification-card {
        position: fixed;
        bottom: 80px;
        left: 50%;
        transform: translateX(-50%);
        width: 400px;
        height: 60px;
        background-color: rgb(250, 203, 164);
        color: rgb(157, 74, 7);
        border: 1px solid rgb(255, 154, 53);
        border-radius: 10px;
        display: flex;
        align-items: center;
        padding: 10px;
        z-index: 9999;
    }

    .icon-container {
        margin-right: 15px;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
    }

    .text-container {
        display: flex;
        align-items: center;
    }

    .text-container p {
        margin: 0;
        font-size: 14px;
        font-weight: bold;
    }

    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }

    .blink {
        animation: blink 1s infinite;
    }
</style>

<!-- Main Content -->
<div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Topbar Navbar -->
        <?php $this->load->view('layout/navbar'); ?>
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid" style="max-width: 95%; height: 1000px;">
        <?php if($message = $this->session->flashdata('error')): ?>
        <div class="row">
            <div class="col-md-12">
                <div id="alerta" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($message = $this->session->flashdata('info')): ?>
        <div class="row">
            <div class="col-md-12">
                <div id="alerta" class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
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
                <thead style="font-size: 30px; color: #333; background-color: #f4f4f4;" class="text-center">
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
                <tbody style="font-size: 30px; color: #555;" class="text-center">
                    <?php $count = 1; foreach($boletins as $boletim): ?>
                    <tr class="<?php 
                        $dataHora = date('Y-m-d H:i:s');
                        $dataCadastro = $boletim->data_cadastro;
                        $diferenca = strtotime($dataHora) - strtotime($dataCadastro);
                        echo ($diferenca < 60 && $user->idProvincia != $boletim->idProvincia ? 'fundo-blink' : ''); 
                    ?>">
                        <th scope="row"><?php echo $count++; ?></th>
                        <td>
                            <?php 
                                if ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') {
                            ?>
                                <span style="color: green;"><?php echo $boletim->nomeProvincia; ?></span>
                            <?php } else { ?>
                                <?php echo $boletim->nomeProvincia; ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?php 
                                if ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') {
                            ?>
                                <span style="color: green;"><?php echo $boletim->total_atendidos; ?></span>
                            <?php } else { ?>
                                <?php echo $boletim->total_atendidos; ?>
                            <?php } ?>
                        </td>
                        <td>
                            <span style="color:<?php echo ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') ? 'green' : 'black'; ?>;">
                                <?php echo $boletim->masculino; ?>
                            </span>
                        </td>
                        <td>
                            <span style="color:<?php echo ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') ? 'green' : 'black'; ?>;">
                                <?php echo $boletim->feminino; ?>
                            </span>
                        </td>
                        <td>
                            <span style="color:<?php echo ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') ? 'green' : 'black'; ?>;">
                                <?php echo $boletim->numero_provas_vida; ?>
                            </span>
                        </td>
                        <td>
                            <span style="color:<?php echo ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') ? 'green' : 'black'; ?>;">
                                <?php echo $boletim->numero_cadastrados; ?>
                            </span>
                        </td>
                        <td>
                            <span style="color:<?php echo ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') ? 'green' : 'black'; ?>;">
                                <?php echo $boletim->passes_entregues; ?>
                            </span>
                        </td>
                        <td>
                            <?php if($boletim->status == 'invalidado' AND $boletim->wait == 'sim'){ ?>
                                <img src="<?php echo base_url('public/img/Animation - 1740672935299.gif');?>" height="18"> <span style="color: green;">Dados corrigidos</span>
                            <?php } else { ?>
                                <?php echo tempo_relativo($boletim->data_cadastro); ?>
                            <?php } ?>
                        </td>
                        <td>
                            <span style="color:<?php echo ($boletim->status == 'invalidado' AND $boletim->wait == 'sim') ? 'green' : 'black'; ?>;">
                                <?php echo $boletim->first_name.' '.$boletim->last_name; ?>
                            </span>
                        </td>
                        <td>
                        <?php if($boletim->status == 'invalidado' AND $boletim->wait == 'sim'){ ?>
                            <?php if($this->ion_auth->is_admin()): ?>
                                <?php if($boletim->status == 'invalidado'){ ?>
                                    <a href="#" class="btn btn-danger btn-sm">Invalidado</a>
                                    <a href="<?php echo base_url('home/validar/'.$boletim->idBoletim); ?>" class="btn btn-success btn-sm"><i class="fas fa-check blink" style="color: white;"></i> Aprovar</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('home/invalidar/'.$boletim->idBoletim); ?>" class="btn btn-outline-danger btn-sm">Invalidar dados</a>
                                <?php } ?>
                            <?php endif; ?>
                        <?php }else{ ?>
                            <?php if($this->ion_auth->is_admin()): ?>
                                <?php if($boletim->status == 'invalidado'){ ?>
                                    <a href="#" class="btn btn-danger btn-sm">Invalidado</a>
                                    <a href="<?php echo base_url('home/validar/'.$boletim->idBoletim); ?>" class="btn btn-success btn-sm"><i class="fas fa-check" style="color: white;"></i> Aprovar</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('home/invalidar/'.$boletim->idBoletim); ?>" class="btn btn-outline-danger btn-sm">Invalidar dados</a>
                                <?php } ?>
                            <?php endif; ?>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    setInterval(function() {
        location.reload();
    }, 5000); // Atualiza a página a cada 5 segundos
</script>
