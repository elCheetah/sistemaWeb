<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0 ">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Usuarios - Eliminados</h4>
                    <p class="mb-0">Lista de Usuarios Inactivos</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= site_url('usuarios/index') ?>">Usuarios</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="<?= site_url('usuarios/index') ?>">Activos</a>
                    </li>
                </ol>
            </div>
        </div>

       

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3"
                                class="table  display mb-4 dataTablesCard short-one card-table text-black table-hover"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th><strong>ID</strong></th>
                                        <th><strong>Nombre Completo</strong></th>
                                        <th><strong>Correo Electrónico</strong></th>
                                        <th><strong>Telefono</strong></th>
                                        <th><strong>Rol</strong></th>
                                        <th><strong>Estado</strong></th>
                                        <th><strong>Acciones</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    foreach ($usuarios as $usuario): ?>
                                        <tr>
                                            <td><strong><?= $contador++ ?></strong></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo base_url(); ?>/assets/img/usuarios/default.jpg"
                                                        class="rounded-circle mr-2 width36 height36" alt="" with="40px"
                                                        height="40px">
                                                    <span>
                                                        <?= $usuario['nombre'] ?>
                                                        <?= isset($usuario['primer_apellido']) ? ' ' . $usuario['primer_apellido'] : '' ?>
                                                        <?= isset($usuario['segundo_apellido']) ? ' ' . $usuario['segundo_apellido'] : '' ?>
                                                    </span>
                                                </div>

                                            </td>
                                            <td><?= $usuario['email'] ?></td>
                                            <td><?= $usuario['telefono'] ?></td>
                                            <td>
                                                <?php if ($usuario['rol'] == 'Administrador'): ?>
                                                    <span class="badge light badge-success"><?= $usuario['rol'] ?></span>
                                                <?php elseif ($usuario['rol'] == 'Cajero'): ?>
                                                    <span class="badge light badge-warning"><?= $usuario['rol'] ?></span>
                                                <?php elseif ($usuario['rol'] == 'Asesor'): ?>
                                                    <span class="badge light badge-danger"><?= $usuario['rol'] ?></span>
                                                <?php else: ?>
                                                    <span class="badge light badge-secondary">DESCONOCIDO</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($usuario['estado'] == '1'): ?>
                                                    <span class="badge light badge-success">ACTIVO</span>
                                                <?php elseif ($usuario['estado'] == '0'): ?>
                                                    <span class="badge light badge-primary">INACTIVO</span>
                                                <?php else: ?>
                                                    <span class="badge light badge-secondary">DESCONOCIDO</span>
                                                <?php endif; ?>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-success light sharp"
                                                        data-toggle="dropdown">
                                                        <svg width="20px" height="20px" viewbox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('usuarios/info/' . $usuario['usuario_id']) ?>">Ver</a>
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('usuarios/habilitar/' . $usuario['usuario_id']) ?>">Habilitar</a>
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('usuarios/eliminar/' . $usuario['usuario_id']) ?>"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario de manera PERMANENTE?');">Eliminar</a>
                                                    </div>


                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>