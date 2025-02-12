<link href="<?php echo base_url('public/css/loginEstilo.css') ?>" rel="stylesheet">
<div class="container">
    <!-- Outer Row -->
    
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">
            <!-- Card de Login -->
            <div class="row" style="margin-top:150px">
                
                <div class="col-lg-12">
                         <!-- Exibição de mensagens de erro ou informações -->
            <?php if ($message = $this->session->flashdata('error')): ?>
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

            <?php if ($message = $this->session->flashdata('info')): ?>
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
                    <div class="card" style="width: 100%; max-width: 800px; border-radius: 15px;">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2 class="text-danger mb-2 font-weight-bold">Bem-vindo de volta!</h2>
                                <p class="text-muted">Insira os teus dados para entrar</p>
                            </div>

                            <!-- Formulário de Login -->
                            <form name="form_auth" method="POST" action="<?php echo base_url('login/auth'); ?>">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" 
                                           id="exampleInputEmail" placeholder="Digite seu e-mail" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" 
                                           id="exampleInputPassword" placeholder="Digite sua senha" required>
                                </div>

                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Lembrar-me</label>
                                    </div>
                                    <a href="<?php echo base_url('recuperar-senha'); ?>" class="small text-primary">Ainda não tenho conta?</a>
                                </div>

                                <button type="submit" class="btn btn-danger btn-block btn-lg" style="font-size: 18px; border-radius: 50px;">
                                    Entrar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

