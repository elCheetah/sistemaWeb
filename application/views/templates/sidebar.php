<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <?php
                if (!empty($this->session->userdata('imagen')) && $this->session->userdata('imagen') !== null) {
                    // Si la imagen no es vacía ni nula, mostrar la imagen del usuario
                    $ruta_imagen = base_url('assets/img/usuarios/' . $this->session->userdata('imagen'));
                } else {
                    // Si la imagen es vacía o nula, mostrar la imagen por defecto
                    $ruta_imagen = base_url('assets/img/usuarios/default.jpg');
                }
                ?>
                <img class="rounded-circle mr-2 width36 height36 border border-primary"
                    src="<?php echo $ruta_imagen; ?>" width="20" alt="Profile Picture">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hola,</span></h5>
            <p class="email">
                <?php echo $this->session->userdata('nombre ') . ' ' . $this->session->userdata('primer_apellido'); ?>
            </p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label">Menu</li>
            <li><a href="<?php echo base_url(); ?>index.php/dashboard" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-label">Componentes</li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user-7"></i>
                    <span class="nav-text">Usuarios</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo base_url(); ?>index.php/usuarios">Usuarios</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-id-card"></i>
                    <span class="nav-text">Clientes</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo base_url(); ?>index.php/clientes">Clientes</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user-9"></i>
                    <span class="nav-text">Garantes</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo base_url(); ?>index.php/garantes">Garantes</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-money"></i>
                    <span class="nav-text">Prestamos</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo base_url(); ?>index.php/prestamos">Prestamos</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-credit-card"></i>
                    <span class="nav-text">Cobros</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo base_url(); ?>index.php/cobros">Cobros</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-file"></i>
                    <span class="nav-text">Reportes</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?php echo base_url(); ?>index.php/usuarios">Reporte de Usuarios</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/clientes">Reporte de Clientes</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/garantes">Reporte de Garantes</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/prestamos">Reporte de Prestamos</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/cobros">Reporte de Cobros</a></li>
                </ul>
            </li>
            <li class="nav-label">Configuraciones</li>
            <li><a href="#" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Configuraciones</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->