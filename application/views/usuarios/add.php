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
    </nav>
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
                <a href="<?php echo base_url('usuarios'); ?>" title="Cadastrar novo usuário" class="btn btn-success btn-sm float-right">
                    <i class="fas fa-arrow-left"></i>&nbsp Voltar
                </a>
            </div>
            <div class="card-body">
                <form method="POST" name="form_add">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="first_name">Nome</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Primeiro nome" value="<?php echo set_value('first_name'); ?>">
                            <?php echo form_error('first_name', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                            <label for="last_name">Sobrenome</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Inserir sobrenome" value="<?php echo set_value('last_name'); ?>">
                            <?php echo form_error('last_name', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Inserir email" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                            <label for="email">Genero</label>
                            <select class="form-control" name="genero" required>
                                <option value="">Escolher</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            <?php echo form_error('email', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="username">Usuário</label>
                            <input type="text" class="form-control" name="username" placeholder="Seu usuário" value="<?php echo set_value('username'); ?>">
                            <?php echo form_error('username', '<small class="form-text text-danger">','</small>'); ?>
                        </div>

                        <div class="col-md-3">
                            <label for="active">Ativo</label>
                            <select class="form-control" name="active">
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="perfil_usuario">Perfil de Acesso</label>
                            <select class="form-control" name="perfil_usuario">
                                <option value="2">Técnico</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="idProvincia">Província</label>
                            <select name="idProvincia" id="provincia" class="form-control">
                                <?php
                                $provincas = [
                                    ["idProvincia" => 1, "nomeProvincia" => "Bengo"],
                                    ["idProvincia" => 2, "nomeProvincia" => "Benguela"],
                                    ["idProvincia" => 3, "nomeProvincia" => "Bié"],
                                    ["idProvincia" => 4, "nomeProvincia" => "Cabinda"],
                                    ["idProvincia" => 5, "nomeProvincia" => "Cunene"],
                                    ["idProvincia" => 6, "nomeProvincia" => "Huambo"],
                                    ["idProvincia" => 7, "nomeProvincia" => "Huíla"],
                                    ["idProvincia" => 8, "nomeProvincia" => "Cuando Cubango"],
                                    ["idProvincia" => 9, "nomeProvincia" => "Cuanza-Norte"],
                                    ["idProvincia" => 10, "nomeProvincia" => "Cuanza-Sul"],
                                    ["idProvincia" => 11, "nomeProvincia" => "Luanda"],
                                    ["idProvincia" => 12, "nomeProvincia" => "Lunda-Norte"],
                                    ["idProvincia" => 13, "nomeProvincia" => "Lunda-Sul"],
                                    ["idProvincia" => 14, "nomeProvincia" => "Malange"],
                                    ["idProvincia" => 15, "nomeProvincia" => "Moxico"],
                                    ["idProvincia" => 16, "nomeProvincia" => "Namibe"],
                                    ["idProvincia" => 17, "nomeProvincia" => "Uíge"],
                                    ["idProvincia" => 18, "nomeProvincia" => "Zaire"]
                                ];

                                foreach ($provincas as $provincia) {
                                    echo "<option value='" . $provincia['idProvincia'] . "'>" . $provincia['nomeProvincia'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Sua senha">
                            <?php echo form_error('password', '<small class="form-text text-danger">','</small>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="comfirm_password">Confirmação de Senha</label>
                            <input type="password" class="form-control" name="comfirm_password" placeholder="Confirme sua senha">
                            <?php echo form_error('comfirm_password', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
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
