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
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
 <h1 class="h3 mb-2 text-gray-800">categorias</h1>
<!-- Success Message -->
<?php if($message = $this->session->flashdata('sucesso')): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-smile-wink"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Error Message -->
<?php if($message = $this->session->flashdata('error')): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp; <?php echo $message; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('categorias'); ?>">Categorias</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
    </ol>
</nav>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo base_url('categorias/add'); ?>" title="Cadastrar nova categoria" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i>&nbsp Novo</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome da categoria</th>
                        <th class="text-center">Ativa</th>
                        <th class="text-right nosort pr-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo $categoria->categoria_id ?></td>
                        <td><?php echo $categoria->categoria_nome ?></td>
                        <td><?php echo ($categoria->categoria_ativa == 1 ? '<span class="badge badge-primary">Sim</span>' : '<span class="badge badge-warning btn-sm">Não</span>') ?></td>
                        <td class="text-right">
                            <a href="<?php echo base_url('categorias/edit/'.$categoria->categoria_id); ?>" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>
                            <a href="javascript(void)" data-toggle="modal" data-target="#categoria-<?php echo $categoria->categoria_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>

                    <!-- Modal for Deletion Confirmation -->
                    <div class="modal fade" id="categoria-<?php echo $categoria->categoria_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tens certeza que queres eliminar?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Para excluir o usuário, clique em "SIM".</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Não</button>
                                    <a class="btn btn-danger btn-sm" href="<?php echo base_url('categorias/del/'.$categoria->categoria_id); ?>">Sim</a>
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

