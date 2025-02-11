
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

                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                 <?php $this->load->view('layout/navbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('categorias'); ?>">categorias</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                        </ol>
                    </nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                        <form method="POST" name="form_add">
                          <!--<p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última alteração:</strong> <?php echo formata_data_banco_com_hora($categorias->categoria_data_alteracao); ?></p>-->
                           <fieldset class="mt-4 border p-2 mb-4"> <!--INICIO FIELDSET -->
                            <legend class="font-small"><i class="fas fa-cubes"></i>&nbsp;Dados da categoria</legend>
                           <div class="form-group row mb-4"> <!-- INICIO GRUPO 1 -->
                                <div class="col-md-8">
                                    <label for="exampleInputEmail1">Nome da categoria</label>
                                      <input type="text" class="form-control"  name="categoria_nome"  placeholder="Nome da categoria" value="<?php echo set_value('categoria_nome'); ?>">
                                    <?php echo form_error('categoria_nome', '<small class="form-text text-danger">','</small>'); ?>
                                </div>
                               
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">categoria Activa</label>
                                    <select class="form-control" name="categoria_ativa">
                                      <option value="0" > Não</option>
                                      <option value="1"> Sim</option>
                                    </select>
                                </div>
                            </div> <!-- FIM GRUPO 1-->


                            
                           </fieldset> <!--FIM FIELDSET-->

                            <button type="submit" class="btn btn-primary btn-sm">Salvar</button> <a href="<?php echo base_url('categorias'); ?>" title="Atualizar categoria" class="btn btn-success btn-sm ml-2">Voltar</a>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

           