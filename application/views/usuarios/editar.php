<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Editar Usuario</h4>
                    <p class="mb-0">Modificar datos Incorrectos</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('usuarios') ?>">Usuarios</a></li>
                    <li class="breadcrumb-item active">
                        <a href="<?= base_url('usuarios/info/' . $usuario['usuario_id']) ?>">Información</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="<?= base_url('usuarios/actualizar') ?>"
                                enctype="multipart/form-data">
                                <h4 class="text-primary mb-4">Foto</h4>
                                <div class="my-profile">
                                    <?php
                                    $imagen = !empty($usuario['imagen']) ? $usuario['imagen'] : 'default.jpg';
                                    ?>
                                    <img src="<?= base_url('assets/img/usuarios/' . $imagen) ?>" alt="Foto de perfil"
                                        class="rounded-circle mr-2 width36 height36 border border-primary">
                                </div>
                                <hr>
                                <h4 class="text-primary mb-4">Información Personal</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Nombre Completo" value="<?= $usuario['nombre'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="imagen">Foto de Perfil</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">Subir</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                                <label class="custom-file-label" for="imagen">Subir Archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-primary mb-4">Información de Contacto</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="correo@ejemplo.com" value="<?= $usuario['email'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono"
                                            placeholder="1234-5678" value="<?= $usuario['telefono'] ?>">
                                    </div>
                                </div>
                                <h4 class="text-primary mb-4">Credenciales</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="nombre_usuario">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="nombre_usuario"
                                            name="nombre_usuario" placeholder="Nombre de Usuario" value="<?= $usuario['nombre_usuario'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="rol">Rol</label>
                                        <select class="form-control select2-with-label-single js-states d-block"
                                            id="rol" name="rol" disabled>
                                            <option value="<?= $usuario['rol'] ?>"><?= $usuario['rol'] ?></option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <!-- No habrá opción de editar contraseña ya que eso se hará de otra manera -->
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
