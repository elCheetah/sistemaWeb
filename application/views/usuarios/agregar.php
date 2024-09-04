<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Agregar Usuario</h4>
                    <p class="mb-0">Llenar todos los campos requeridos</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('usuarios') ?>">Usuarios</a></li>
                    <li class="breadcrumb-item active">Agregar Usuario</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="<?= base_url('index.php/usuarios/agregar') ?>" enctype="multipart/form-data">
                                <h4 class="text-primary mb-4">Información Personal</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="imagen">Foto de Perfil</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">Subir</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                                <label class="text-black" class="custom-file-label" for="imagen">Subir Archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-primary mb-4">Información de Contacto</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="correo@ejemplo.com" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="1234-5678">
                                    </div>
                                </div>
                                <h4 class="text-primary mb-4">Credenciales</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="nombre_usuario">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de Usuario" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label class="text-black" for="rol">Rol</label>
                                    <select class="form-control select2-with-label-single js-states d-block" id="rol" name="rol" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="administrador">Administrador</option>
                                            <option value="cajero">Cajero</option>
                                            <option value="atencion">Asesor</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="password_confirm">Repetir Contraseña</label>
                                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Repetir Contraseña" disabled >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
