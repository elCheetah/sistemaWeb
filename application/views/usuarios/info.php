<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Información Personal del Usuario</h4>
                    <p class="mb-0"><?php echo $usuario['nombre'].' '.$usuario['primer_apellido'].' '.$usuario['segundo_apellido']; ?></p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= site_url('usuarios/index') ?>">Usuarios</a>
                    </li>
                    <li class="breadcrumb-item active">

                        <a href="<?= site_url('usuarios/editar/' . $usuario['usuario_id']) ?>">Editar</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-personal-info">
                            <h4 class="text-primary mb-4">Perfil</h4>
                            <div class="my-profile">
                                <?php
                                if (!empty($usuario['imagen']) && $usuario['imagen'] !== null) {
                                    // Si la imagen no es vacía ni nula, mostrar la imagen del usuario
                                    $ruta_imagen = base_url('assets/img/usuarios/' . $usuario['imagen']);
                                } else {
                                    // Si la imagen es vacía o nula, mostrar la imagen por defecto
                                    $ruta_imagen = base_url('assets/img/usuarios/default.jpg');
                                }
                                ?>
                                <img src="<?php echo $ruta_imagen; ?>" alt="Imagen de perfil"
                                    class="rounded-circle mr-2 width36 height36 border border-primary">
                            </div>

                            <ul class="portofolio-social">
                                <li><a href="javascript:void(0);"><i class="fa fa-phone"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-envelope-o"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                            </ul>
                            <hr>
                            <h4 class="text-primary mb-4">Información del Usuario</h4>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Nombre Completo <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $usuario['nombre']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Nombre de Usuario <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $usuario['nombre_usuario']; ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Rol <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $usuario['rol']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Estado <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7">
                                    <span><?php echo $usuario['estado'] ? 'Activo' : 'Inactivo'; ?></span>
                                </div>
                            </div>
                            <hr>
                            <h4 class="text-primary mb-4">Información de Contacto</h4>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Correo Electrónico <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $usuario['email']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Teléfono - Celular <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $usuario['telefono']; ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>