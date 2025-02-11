<a href="<?php echo base_url(); ?>" class="navbar-brand">
        <img src="<?php echo base_url('public/img/logo.png'); ?>" alt="Logo" style="height: 40px; width: auto;">
    </a>
<ul class="navbar-nav ml-auto">
<?php $user =  $this->ion_auth->user()->row(); ?> 
<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
        aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small"
                    placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>

<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    <a href="<?php echo base_url('Home/add'); ?>" class="nav-link dropdown-toggle"  >
        <button class="btn btn-danger">Cadastrar</button>
    </a>
    <!-- Dropdown - Alerts -->
    
</li>
  
<!-- Nav Item - Messages -->
<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="<?php echo base_url('home/perfil'); ?>" id="userDropdown">

        <span class="mr-2 d-none d-lg-inline text-gray-600 " style="font-size:14px">
            <?php echo $user->username; ?>
        </span>

        <i class="far fa-user fa-sm fa-fw mr-2 text-gray-600" style="font-size:16px;"></i>
      </a>
    <!-- Dropdown - User Information -->
    
</li>

</ul>

</nav>