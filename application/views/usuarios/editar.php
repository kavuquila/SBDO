
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
                            <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios'); ?>">Usuários</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                        </ol>
                    </nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?php echo base_url('usuarios'); ?>" title="Cadstrar novo usuario" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp Voltar</a>
                        </div>
                        <div class="card-body">
                        <form method="POST" name="form_editar">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Nome</label>
                                    <input type="text" class="form-control"  name="first_name"  placeholder="Primeiro nome" value="<?php echo $usuarios->first_name; ?>">
                                    <?php echo form_error('first_name', '<small class="form-text text-danger">','</small>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Sobrenome</label>
                                    <input type="text" class="form-control"  name="last_name" aria-describedby="emailHelp" placeholder="Inserir sobrenome" value="<?php echo $usuarios->last_name; ?>">
                                    <?php echo form_error('last_name', '<small class="form-text text-danger">','</small>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control"  name="email" aria-describedby="emailHelp" placeholder="Inserir email" value="<?php echo $usuarios->email; ?>">
                                    <?php echo form_error('email', '<small class="form-text text-danger">','</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">

                              <div class="col-md-4">
                                    <label for="exampleInputEmail1">Usuario</label>
                                    <input type="text" class="form-control"  name="username" aria-describedby="emailHelp" placeholder="seu usuario" value="<?php echo $usuarios->username; ?>">
                                    <?php echo form_error('username', '<small class="form-text text-danger">','</small>'); ?>
                                </div>

                                <div class="col-md-4">
                                        <label>Ativo</label>
                                        <select class="form-control" name="active" <?php echo(!$this->ion_auth->is_admin() ? 'disabled' : ''); ?>>
                                        <option value="0" <?php echo ($usuarios->active == 0) ? 'selected' : '' ?>>Não</option>
                                        <option value="1" <?php echo ($usuarios->active == 1) ? 'selected' : '' ?>>Sim</option>
                                        </select>
                                        
                                </div>
                                <div class="col-md-4">
                                        <label>Perfil de acesso</label>
                                        <select class="form-control" name="perfil_usuario" <?php echo(!$this->ion_auth->is_admin() ? 'disabled' : ''); ?>>
                                        <option value="2" <?php echo ($usuarios->id == 1) ? 'selected' : '' ?>>Vendedor</option>
                                        <option value="1" <?php echo ($usuarios->id == 0) ? 'selected' : '' ?>>Administrador</option>
                                        </select>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="exampleInputEmail1">Senha</label>
                                    <input type="password" class="form-control"  name="password" aria-describedby="emailHelp" placeholder="sua senha" value="">
                                    <?php echo form_error('password', '<small class="form-text text-danger">','</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                  <label for="exampleInputEmail1">Confirmação de Senha</label>
                                    <input type="password" class="form-control"  name="comfirm_password" aria-describedby="emailHelp" placeholder="comfirm sua senha" value="">
                                    <?php echo form_error('comfirm_password', '<small class="form-text text-danger">','</small>'); ?>
                                </div>

                                <input type="hidden" name="usuario_id" value="<?php echo $usuarios->id ?> ">
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           