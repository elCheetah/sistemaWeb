<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Préstamos</h4>
                    <p class="mb-0">Lista de Préstamos Activos</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('prestamos/agregar') ?>">Agregar Nuevo</a></li>
                    <li class="breadcrumb-item active"><a href="<?= site_url('prestamos/eliminados') ?>">Inactivos</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-sm-flex d-block">
                        <div class="mr-auto mb-sm-0 mb-3">
                            <h4 class="card-title"></h4>
                            <span>Gestión de Préstamos</span>
                        </div>

                        <a href="javascript:void(0);" class="btn btn-info light mr-3">
                            <i class="las la-download scale3 mr-2"></i>Importar en CSV
                        </a>
                        <a href="<?= site_url('prestamos/agregar') ?>" class="btn btn-info">+ Agregar Préstamo</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3"
                                class="table display mb-4 dataTablesCard short-one card-table text-black table-hover"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th><strong>ID</strong></th>
                                        <th><strong>Cliente</strong></th>
                                        <th><strong>Monto</strong></th>
                                        <th><strong>Tasa de Interés</strong></th>
                                        <th><strong>Cargo</strong></th>
                                        <th><strong>Fecha de Inicio</strong></th>
                                        <th><strong>Fecha de Fin</strong></th>
                                        <th><strong>Estado</strong></th>
                                        <th><strong>Acciones</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($prestamos as $prestamo): ?>
                                        <tr>
                                            <td><strong><?= $prestamo['prestamo_id'] ?></strong></td>
                                            <td>
                                                <?= $prestamo['cliente_nombre'] ?>
                                            </td>
                                            <td><?= number_format($prestamo['monto'], 2) ?></td>
                                            <td><?= number_format($prestamo['tasa_interes'], 2) ?>%</td>
                                            <td><?= number_format($prestamo['cargo'], 2) ?></td>
                                            <td><?= date('d-m-Y', strtotime($prestamo['fecha_inicio'])) ?></td>
                                            <td><?= date('d-m-Y', strtotime($prestamo['fecha_fin'])) ?></td>
                                            <td>
                                                <?php if ($prestamo['estado_prestamo_id'] == 1): // ID para 'PENDIENTE' ?>
                                                    <span class="badge light badge-warning">PENDIENTE</span>
                                                <?php elseif ($prestamo['estado_prestamo_id'] == 2): // ID para 'APROBADO' ?>
                                                    <span class="badge light badge-success">APROBADO</span>
                                                <?php elseif ($prestamo['estado_prestamo_id'] == 3): // ID para 'VIGENTE' ?>
                                                    <span class="badge light badge-info">VIGENTE</span>
                                                <?php elseif ($prestamo['estado_prestamo_id'] == 4): // ID para 'RECHAZADO' ?>
                                                    <span class="badge light badge-danger">RECHAZADO</span>
                                                <?php elseif ($prestamo['estado_prestamo_id'] == 5): // ID para 'PAGADO' ?>
                                                    <span class="badge light badge-primary">PAGADO</span>
                                                <?php elseif ($prestamo['estado_prestamo_id'] == 6): // ID para 'EN MORA' ?>
                                                    <span class="badge light badge-dark">EN MORA</span>
                                                <?php elseif ($prestamo['estado_prestamo_id'] == 0): // ID para 'ELIMINADO' ?>
                                                    <span class="badge light badge-secondary">ELIMINADO</span>
                                                <?php else: ?>
                                                    <span class="badge light badge-secondary">DESCONOCIDO</span>
                                                <?php endif; ?>
                                            </td>

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
                                                            href="<?= site_url('prestamos/info/' . $prestamo['prestamo_id']) ?>">Ver</a>
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('prestamos/editar/' . $prestamo['prestamo_id']) ?>">Editar</a>
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('prestamos/eliminar/' . $prestamo['prestamo_id']) ?>"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?');">Eliminar</a>
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