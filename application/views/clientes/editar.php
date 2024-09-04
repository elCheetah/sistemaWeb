<div class="content-body">
    <div class="container-fluid">
        <!-- Encabezado y breadcrumb -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Editar Cliente</h4>
                    <p class="mb-0">Modificar datos Incorrectos</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('clientes') ?>">Clientes</a></li>
                    <li class="breadcrumb-item active">Editar Cliente</li>
                </ol>
            </div>
        </div>

        <!-- Formulario de edición de cliente -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post"
                                action="<?= base_url('index.php/clientes/editar/' . $cliente['cliente_id']) ?>"
                                enctype="multipart/form-data">
                                <h4 class="text-primary mb-4">Información Personal</h4>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ci" class="text-black">Cédula de Identidad (CI)</label>
                                        <input type="text" class="form-control" id="ci" name="ci"
                                            placeholder="Cédula de Identidad" value="<?= $cliente['ci'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Nombre Completo" value="<?= $cliente['nombre'] ?>" required>
                                    </div>
                                </div>

                                <!-- Resto de campos personales -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="primer_apellido">Primer Apellido</label>
                                        <input type="text" class="form-control" id="primer_apellido"
                                            name="primer_apellido" placeholder="Primer Apellido"
                                            value="<?= $cliente['primer_apellido'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="segundo_apellido">Segundo Apellido</label>
                                        <input type="text" class="form-control" id="segundo_apellido"
                                            name="segundo_apellido" placeholder="Segundo Apellido"
                                            value="<?= $cliente['segundo_apellido'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento"
                                            name="fecha_nacimiento" value="<?= $cliente['fecha_nacimiento'] ?>"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="estado_civil">Estado Civil</label>
                                        <select class="form-control select2-with-label-single js-states d-block"
                                            id="estado_civil" name="estado_civil" required>
                                            <option value="<?= $cliente['estado_civil'] ?>">
                                                <?= $cliente['estado_civil'] ?></option>
                                            <option value="SOLTERO">SOLTERO</option>
                                            <option value="CASADO">CASADO</option>
                                            <option value="DIVORCIADO">DIVORCIADO</option>
                                            <option value="VIUDO">VIUDO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="genero">Género</label>
                                        <div class="basic-form">
                                            <div class="form-group mb-0">
                                                <label class="radio-inline mr-3"><input type="radio" name="genero"
                                                        value="Masculino" <?= ($cliente['genero'] == 'Masculino') ? 'checked' : '' ?> required> Masculino</label>
                                                <label class="radio-inline mr-3"><input type="radio" name="genero"
                                                        value="Femenino" <?= ($cliente['genero'] == 'Femenino') ? 'checked' : '' ?> required> Femenino</label>
                                                <label class="radio-inline mr-3"><input type="radio" name="genero"
                                                        value="Otro" <?= ($cliente['genero'] == 'Otro') ? 'checked' : '' ?>
                                                        required> Otro</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Información de contacto -->
                                <h4 class="text-primary mb-4">Información de Contacto</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="correo@ejemplo.com" value="<?= $cliente['email'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono"
                                            placeholder="1234-5678" value="<?= $cliente['telefono'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion"
                                            placeholder="Dirección completa" value="<?= $cliente['direccion'] ?>"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="direccion_gps">Dirección GPS</label>
                                        <input type="text" class="form-control" id="direccion_gps" name="direccion_gps"
                                            placeholder="Pegar el link de Google Maps"
                                            value="<?= $cliente['direccion_gps'] ?>">
                                    </div>
                                </div>

                                <!-- Información adicional -->
                                <h4 class="text-primary mb-4">Información Adicional</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="ocupacion">Ocupación</label>
                                        <input type="text" class="form-control" id="ocupacion" name="ocupacion"
                                            placeholder="Ocupación" value="<?= $cliente['ocupacion'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="promedio_ingresos_mensuales">Promedio de Ingresos
                                            Mensuales</label>
                                        <input type="number" class="form-control" id="promedio_ingresos_mensuales"
                                            name="promedio_ingresos_mensuales"
                                            placeholder="Promedio de Ingresos Mensuales"
                                            value="<?= $cliente['promedio_ingresos_mensuales'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="direccion_ocupacion">Dirección de la
                                            Ocupación</label>
                                        <input type="text" class="form-control" id="direccion_ocupacion"
                                            name="direccion_ocupacion" placeholder="Dirección del lugar de trabajo"
                                            value="<?= $cliente['direccion_ocupacion'] ?>">
                                    </div>
                                </div>

                                <!-- Información del Garante -->
                                <h4 class="text-primary mb-4">Información del Garante</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="primer_garante_id">Primer Garante</label>
                                        <select class="form-control select2-with-label-single js-states d-block"
                                            id="primer_garante_id" name="primer_garante_id">
                                            <option value="<?= $cliente['primer_garante_id'] ?>">
                                                <?= $cliente['primer_garante_nombre'] ?></option>
                                            <?php foreach ($garantes as $garante): ?>
                                                <option value="<?= $garante['garante_id'] ?>"><?= $garante['nombre'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="segundo_garante_id">Segundo Garante</label>
                                        <select class="form-control select2-with-label-single js-states d-block"
                                            id="segundo_garante_id" name="segundo_garante_id">
                                            <option value="<?= $cliente['segundo_garante_id'] ?>">
                                                <?= $cliente['segundo_garante_nombre'] ?></option>
                                            <?php foreach ($garantes as $garante): ?>
                                                <option value="<?= $garante['garante_id'] ?>"><?= $garante['nombre'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    <a href="<?= base_url('clientes') ?>" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>