<?php if (!$this->router->fetch_class() == 'login'): ?>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
<?php endif; ?>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pronto para sair?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Clique logout para encerrar a sessão</div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Não</button>
                <a class="btn btn-danger btn-sm" href="<?php echo base_url('login/logout'); ?>">Sair</a>
            </div>
        </div>
    </div>
</div>

<!-- Cadastro Modal -->
<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-link" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-arrow-left"></i> Voltar
                </button>
                <h5 class="modal-title" id="cadastroModalLabel">Cadastro de Informações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('Home/add'); ?>" method="POST">
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

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroAtendidos">Total atendidos</label>
                                <input type="number" placeholder="12" class="form-control" id="numeroAtendidos" name="numeroAtendidos" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numeroMasculino">Masculino</label>
                                <input type="number" placeholder="Total Masculino" class="form-control" id="numeroMasculino" name="numeroMasculino" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numeroFeminino">Feminino</label>
                                <input type="number" placeholder="Total Femininos" class="form-control" id="numeroFeminino" name="numeroFeminino" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroPasses">Nº Passes entregues</label>
                                <input type="number" placeholder="Total passes" class="form-control" id="numeroPasses" name="numeroPasses" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroPasses">Solicitação adiantamento</label>
                                <input type="number" title="Quantas solicitações de adiantamento foram feitas hoje" placeholder="Total solicitações" class="form-control" id="numeroPasses" name="numeroPasses" required>
                            </div>
                        </div>
                    </div>

                    <!-- Adicione mais campos conforme necessário -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('public/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('public/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('public/js/sb-admin-2.min.js') ?>"></script>
<script src="<?php echo base_url('public/js/util.js') ?>"></script>

<script>
    <?php if ($boletim->data_cadastro == $dataHora) { ?>
        setTimeout(function() {
            document.getElementById("tr-<?= $boletim->id ?>").classList.remove("fundo-blink");
        }, 5000); // Remove a classe após 5 segundos
    <?php } ?>
</script>
 <script>  
    function fecharElemento(id, segundos) {
        setTimeout(function() {
            var elemento = document.getElementById(id);
            if (elemento) {
                elemento.style.display = 'none';
            }
        }, segundos * 1000); // Converte segundos para milissegundos
    }

    // Chamar a função para fechar o elemento "mensagem" após 5 segundos
    fecharElemento('fechaElemento', 5);
</script>

<?php if (isset($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <!-- Custom scripts for this modules-->
        <script src="<?php echo base_url('public/'.$script); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script>
</body>

</html>
