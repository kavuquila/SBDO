
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

                          <!-- Page Heading -->
                          <h1 class="h3 mb-2 text-gray-800">USUÁRIOS</h1>
                   <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>-->
                            <?php if($message = $this->session->flashdata('sucesso')): ?>

                            <div class="row">
                                <div class="col-md-12">
                                
                                    <div id="fechaElemento" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong> <i class="fas fa-smile-wink"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                </div>
                            </div>

                            <?php endif; ?>

                            <?php if($message = $this->session->flashdata('error')): ?>

                                <div class="row">
                                    <div class="col-md-12">
                                      
                                         <div id="fechaElemento"  class="alert alert-danger alert-dismissible fade show" role="alert">
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
                        <div class="card-header py-3">
                            <a href="<?php echo base_url('usuarios/add'); ?>" title="Cadstrar novo usuario" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp Novo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuário</th>
                                            <th>Login</th>
                                            <th>Perfil</th>
                                            <th>Ativo</th>
                                            <th class="text-right nosort">Ações</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                        <?php foreach ($usuarios as $pefil) : ?>
                                        <tr>
                                            <td><?php echo $pefil->id ?></td>
                                            <td><?php echo $pefil->username ?></td>
                                            <td><?php echo $pefil->email ?></td>
                                            <td><?php echo ($this->ion_auth->is_admin($pefil->id) ? 'Administrador' : 'Vendedor'); ?></td>
                                            <td><?php echo ($pefil->active == 1 ? '<span class="badge badge-primary">Sim</span>' : '<span class="badge badge-warning btn-sm">Não</span>') ?></td>
                                            <td class="text-right">
                                                <a href="<?php echo base_url('usuarios/edit/'.$pefil->id); ?>" class="btn btn-sm btn-primary"> <i class="fas fa-user-edit"></i></a>
                                                <a href="javascript(void)" data-toggle="modal" data-target="#pefil-<?php  echo $pefil->id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="pefil-<?php  echo $pefil->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tens certeza que queres eliminar?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Para excluir o usuario clica clica em  "SIM"</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Não</button>
                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('usuarios/del/'.$pefil->id); ?>">Sim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           