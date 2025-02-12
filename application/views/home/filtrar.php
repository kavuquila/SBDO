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
                <h2>Filtrar dados </h2><br/>
                <form action="<?php echo base_url('Home/filtro'); ?>" method="POST" name="form_add">
                    <!-- Form Row 1: Number of Provas de Vida and Cadastrados -->
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroProvasVida"><b>Data inicial</b></label>
                                <input type="date" class="form-control" id="numeroProvasVida" name="dataFinal" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroProvasVida"><b>Data inicial</b></label>
                                <input type="date"  class="form-control" id="numeroProvasVida" name="dataFinal" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numeroProvasVida"><b>Provincia</b></label>
                               <select name="provincia" class="form-control" required>
                                  <option value="">Selecionar Provincia</option>
                                  <?php foreach($provincias as $provincia): ?>
                                  <option value="<?php echo $provincia->idProvincia; ?>"><?php echo $provincia->nomeProvincia; ?></option>
                                  <?php endforeach; ?>
                               </select>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden Fields for User Info -->
                 

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block" style="max-width:200px;">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
