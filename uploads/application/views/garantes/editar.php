<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Editar Garante</h4>
                    <p class="mb-0">Modificar datos Incorrectos</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('index.php/garantes') ?>">Garantes</a></li>
                    <li class="breadcrumb-item active">Editar Garante</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post"
                                action="<?= base_url('index.php/garantes/editar/' . $garante['garante_id']) ?>"
                                enctype="multipart/form-data">
                                <h4 class="text-primary mb-4">Información Personal</h4>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre" class="text-black">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Nombre" value="<?= $garante['nombre'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="primer_apellido">Primer Apellido</label>
                                        <input type="text" class="form-control" id="primer_apellido"
                                            name="primer_apellido" placeholder="Primer Apellido"
                                            value="<?= $garante['primer_apellido'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="segundo_apellido">Segundo Apellido</label>
                                        <input type="text" class="form-control" id="segundo_apellido"
                                            name="segundo_apellido" placeholder="Segundo Apellido"
                                            value="<?= $garante['segundo_apellido'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento"
                                            name="fecha_nacimiento" value="<?= $garante['fecha_nacimiento'] ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="estado_civil">Estado Civil</label>
                                        <select class="form-control select2-with-label-single js-states d-block"
                                            id="estado_civil" name="estado_civil" required>
                                            <option value="">Seleccionar Estado Civil</option>
                                            <option value="SOLTERO" <?= $garante['estado_civil'] == 'SOLTERO' ? 'selected' : '' ?>>SOLTERO</option>
                                            <option value="CASADO" <?= $garante['estado_civil'] == 'CASADO' ? 'selected' : '' ?>>CASADO</option>
                                            <option value="DIVORCIADO" <?= $garante['estado_civil'] == 'DIVORCIADO' ? 'selected' : '' ?>>DIVORCIADO</option>
                                            <option value="VIUDO" <?= $garante['estado_civil'] == 'VIUDO' ? 'selected' : '' ?>>VIUDO</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="sexo">Sexo</label>
                                        <div class="basic-form">
                                            <div class="form-group mb-0">
                                                <label class="radio-inline mr-3"><input type="radio" name="sexo"
                                                        value="M" <?= $garante['sexo'] == 'M' ? 'checked' : '' ?>>
                                                    Masculino</label>
                                                <label class="radio-inline mr-3"><input type="radio" name="sexo"
                                                        value="F" <?= $garante['sexo'] == 'F' ? 'checked' : '' ?>>
                                                    Femenino</label>
                                                <label class="radio-inline mr-3"><input type="radio" name="sexo"
                                                        value="O" <?= $garante['sexo'] == 'O' ? 'checked' : '' ?>>
                                                    Otro</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-primary mb-4">Información de Contacto</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="correo@ejemplo.com" value="<?= $garante['email'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono"
                                            placeholder="1234-5678" value="<?= $garante['telefono'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion"
                                            placeholder="Dirección completa" value="<?= $garante['direccion'] ?>"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="direccion_gps">Dirección GPS</label>
                                        <input type="text" class="form-control" id="direccion_gps" name="direccion_gps"
                                            placeholder="Pegar el link de Google Maps"
                                            value="<?= $garante['direccion_gps'] ?>">
                                    </div>
                                </div>

                                <h4 class="text-primary mb-4">Información Laboral</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="ocupacion">Ocupación</label>
                                        <input type="text" class="form-control" id="ocupacion" name="ocupacion"
                                            placeholder="Ocupación" value="<?= $garante['ocupacion'] ?>" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>