<style>
        /* Reset e estilização básica */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', sans-serif;
   
}

/* Container do card */
.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

/* Estilos principais do card */
.profile-card {
    width: 350px;
    border-radius: 15px;
    color: white;
    overflow: hidden;

    font-size: 16px;
}

/* Cabeçalho do card (imagem de perfil) */
.profile-header {
    position: relative;
    height:189px;
}

.profile-img {
    width: 180px;
    height:180px;
    border-radius: 50%;
    border: 4px solid #fff;
    margin-left:80px;
  
}

/* Corpo do card */
.profile-body {
    padding: 10px 20px 20px;
    text-align: center;
}

.pefil_h2 {
    font-size: 1.8em;
    font-weight: 700;
    margin-bottom: 10px;
    color:black;
}

.username {
    font-size: 1.2em;
    color:rgb(41, 30, 30);
    margin-bottom: 15px;
}

.profile-info p {
    margin: 8px 0;
    color:rgb(87, 86, 86);
}

strong {
    color: #666;
}

/* Botão de terminar sessão */
.logout-btn {
    width: 100%;
    padding: 12px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1em;
    cursor: pointer;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #d32f2f;
}

    </style>


        <!-- Sidebar -->
        <?php $this->load->view('layout/sidebar'); ?>
        <?php $user =  $this->ion_auth->user()->row(); ?> 
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
            <div class="container-fluid" style="max-width: 95%;">
        
     <div class="row">
      <div class="col-md-12">
       
    </div>
</div>

<div class="profile-container">
        <div class="profile-card" style="height:1000px;padding-top:50px;">
            <div class="profile-header">
                <?php if($user->genero == 'Femenino'){ ?>
                <img src="<?php echo base_url('public/img/woman.svg'); ?>" alt="Imagem de Perfil" class="profile-img">
                <?php }elseif($user->genero == 'Masculino'){ ?>
                  <img src="<?php echo base_url('public/img/4825087.png'); ?>" style="max-width:100;" alt="Imagem de Perfil" class="profile-img">
                <?php }else{ ?>
                    <img src="<?php echo base_url('public/img/954337.png'); ?>" style="max-width:100;" alt="Imagem de Perfil" class="profile-img">
                <?php } ?>


            </div>
            <div class="profile-body">
                <h2 class="pefil_h2"><?php echo $user->first_name.' '.$user->last_name; ?></h2>
                
                <div class="profile-info">
                    <p><strong>Email:</strong> <?php echo $user->email; ?></p>
                    <p><strong>Nome Completo:</strong> <?php echo $user->first_name.' '.$user->last_name; ?> </p>
                </div>

                <a href="#" data-toggle="modal" data-target="#logoutModal"><button class="logout-btn">Terminar Sessão</button></a></br></br>
               <?php if($this->ion_auth->is_admin()): ?>
                <a href="<?php echo base_url('usuarios/add'); ?>" >Gerir utilizadores</a>
                <?php endif; ?>
            </div>
        </div>
    </div>