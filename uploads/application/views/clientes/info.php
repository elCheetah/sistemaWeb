<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Información Personal del Cliente</h4>
                    <p class="mb-0"><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . $cliente['segundo_apellido']; ?></p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= site_url('clientes/index') ?>">Clientes</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="<?= site_url('clientes/editar/' . $cliente['cliente_id']) ?>">Editar</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-personal-info">
                            <h4 class="text-primary mb-4">Información Personal</h4>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Cédula de Identidad (CI)<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['ci']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Nombre Completo <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7">
                                    <span><?php echo $cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . $cliente['segundo_apellido']; ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Fecha de Nacimiento <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['fecha_nacimiento']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Estado Civil <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['estado_civil']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Género <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['genero']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Estado <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7">
                                    <span><?php echo $cliente['estado'] ? 'Activo' : 'Inactivo'; ?></span>
                                </div>
                            </div>
                            <hr>
                            <h4 class="text-primary mb-4">Información de Contacto</h4>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Correo Electrónico <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['email']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Teléfono - Celular <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['telefono']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Dirección <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['direccion']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Dirección GPS <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['direccion_gps']; ?></span></div>
                            </div>
                            <hr>
                            <h4 class="text-primary mb-4">Información Laboral </h4>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Profesión u Ocupación <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['ocupacion']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Promedio de Ingresos Mensuales <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['promedio_ingresos_mensuales']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Dirección del Trabajo<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['direccion_ocupacion']; ?></span></div>
                            </div>
                            <hr>
                            <h4 class="text-primary mb-4">Información de Garantía</h4>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Primer Garante <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['primer_garante_id']; ?></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-3 col-5">
                                    <h5 class="f-w-500">Segundo Garante <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-sm-9 col-7"><span><?php echo $cliente['segundo_garante_id']; ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
