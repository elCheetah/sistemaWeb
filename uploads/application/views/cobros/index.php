<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Cobros</h4>
                    <p class="mb-0">Lista de Cobros Registrados</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('cobros/agregar') ?>">Agregar Nuevo</a></li>
                    <li class="breadcrumb-item active"><a href="<?= site_url('cobros/eliminados') ?>">Inactivos</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-sm-flex d-block">
                        <div class="mr-auto mb-sm-0 mb-3">
                            <h4 class="card-title"></h4>
                            <span>Bienvenido</span>
                        </div>

                        <a href="javascript:void(0);" class="btn btn-info light mr-3">
                            <i class="las la-download scale3 mr-2"></i>Importar en Csv
                        </a>
                        <a href="javascript:void(0);" class="btn btn-info">+ Agregar Cobro</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3"
                                class="table  display mb-4 dataTablesCard short-one card-table text-black table-hover"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th><strong>ID Cobro</strong></th>
                                        <th><strong>Cuota ID</strong></th>
                                        <th><strong>Usuario ID</strong></th>
                                        <th><strong>Fecha de Cobro</strong></th>
                                        <th><strong>Monto Cobrado</strong></th>
                                        <th><strong>Acciones</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    foreach ($cobros as $cobro): ?>
                                        <tr>
                                            <td><strong><?= $contador++ ?></strong></td>
                                            <td><?= $cobro['cuota_id'] ?></td>
                                            <td><?= $cobro['usuario_id'] ?></td>
                                            <td><?= $cobro['fecha_cobro'] ?></td>
                                            <td><?= number_format($cobro['monto_cobrado'], 2) ?></td>
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
                                                            href="<?= site_url('cobros/info/' . $cobro['cobro_id']) ?>">Ver</a>
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('cobros/editar/' . $cobro['cobro_id']) ?>">Editar</a>
                                                        <a class="dropdown-item"
                                                            href="<?= site_url('cobros/eliminar/' . $cobro['cobro_id']) ?>"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este cobro?');">Eliminar</a>
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
