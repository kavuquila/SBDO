
        <!-- Sidebar -->
        <?php $this->load->view('layout/sidebar'); ?>
        <!-- End of Sidebar -->
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="max-width:1080px;height:1000px;">
                    
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('titulo'); ?>">Boletim</a></li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
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
                            <div class="col-md-12">
                            
                                <div id="alerta" class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong> <i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            </div>
                        </div>

                        <?php endif; ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body" >
                        <h2>Atualizar dados diários</h2><br/>
                        <form action="<?php echo base_url('Home/edit/' . $boletins->idBoletim); ?>" name="form_edit" method="POST">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numeroProvasVida">Número de Provas de Vida</label>
                                        <input type="number" min="0" placeholder="Total prova de vida" value="<?php echo $boletins->numero_provas_vida; ?>" class="form-control" id="numeroProvasVida" name="numeroProvasVida" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numeroCadastrados">Número de Cadastrados</label>
                                        <input type="number" min="0" placeholder="Total cadastrado" class="form-control" id="numeroCadastrados" value="<?php echo $boletins->numero_cadastrados; ?>" name="numeroCadastrados" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numeroPasses">Nº de reclamações</label>
                                        <input type="number" min="0" value="<?php echo $boletins->passes_entregues; ?>" placeholder="Total reclamações" class="form-control" id="numeroPasses" name="numeroPasses" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numeroMasculino">Masculino</label>
                                        <input type="number" min="0" placeholder="Total Masculino" class="form-control" value="<?php echo $boletins->masculino; ?>" id="numeroMasculino" name="masculino" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numeroFeminino">Feminino</label>
                                        <input type="number" min="0" placeholder="Total Femeninos" class="form-control" value="<?php echo $boletins->feminino; ?>" id="numeroFeminino" name="feminino" required>
                                    </div>
                                </div>
                            </div>

                           

                            <!-- Adicione mais campos conforme necessário -->
                            <div class="form-group"><br/><br/>
                        <button type="submit" class="btn btn-danger btn-block" style="max-width:200px;">ATUALIZAR</button>
                    </div>
                        </form>

                        
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           