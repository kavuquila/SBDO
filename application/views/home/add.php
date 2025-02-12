<!-- Sidebar -->
<?php $this->load->view('layout/sidebar'); ?>
<?php $user = $this->ion_auth->user()->row(); ?> 
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
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid" style="max-width:1080px;height:1000px;">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('titulo'); ?>">Boletim</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <!-- Display Messages -->
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

        <!-- Form Section -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h2>Atualizar dados diários</h2><br/>
                <form action="<?php echo base_url('Home/add'); ?>" method="POST" name="form_add">
                    <!-- Form Row 1: Number of Provas de Vida and Cadastrados -->
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroProvasVida">Número de Provas de Vida</label>
                                <input type="number" placeholder="Total prova de vida" class="form-control" id="numeroProvasVida" name="numeroProvasVida" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroCadastrados">Número de Cadastrados</label>
                                <input type="number" placeholder="Total cadastrado" class="form-control" id="numeroCadastrados" name="numeroCadastrados" required>
                            </div>
                        </div>
                    </div>

                    <!-- Form Row 2: Masculino, Feminino and Passes -->
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numeroMasculino">Total Masculino atendidos</label>
                                <input type="number" placeholder="Total Masculino" class="form-control" id="numeroMasculino" name="masculino" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numeroFeminino">Total Feminino atendidos</label>
                                <input type="number" placeholder="Total Femeninos" class="form-control" id="numeroFeminino" name="feminino" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroPasses">Total de Reclamações</label>
                                <input type="number" placeholder="Total reclamações" class="form-control" id="numeroPasses" name="numeroPasses" required>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Fields for User Info -->
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="idProvincia" value="<?php echo $user->idProvincia; ?>" style="display:none;">
                                <input type="text" name="id" value="<?php echo $user->id; ?>" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group"><br/><br/>
                        <button type="submit" class="btn btn-danger btn-block" style="max-width:200px;">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
