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
                    <li class="breadcrumb-item"><a href="<?= base_url('index.php/usuarios') ?>">Usuarios</a></li>
                    <li class="breadcrumb-item active">Agregar Usuario</li>
                </ol>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <polygon
                                        points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                    </polygon>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                                <strong>Errores de Validación:</strong>
                                <ul>
                                    <?php foreach ($this->form_validation->error_array() as $error): ?>
                                        <li>
                                            <?php echo $error; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                            </div>
                        <?php endif; ?>


                        <div class="basic-form">
                            <form class="form-valide" method="post"
                                action="<?= base_url('index.php/usuarios/agregar') ?>" enctype="multipart/form-data">

                                <h4 class="text-primary mb-4">Información Personal</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="primer_apellido">Primer Apellido</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="primer_apellido"
                                            name="primer_apellido" placeholder="PRIMER APELLIDO"
                                            style="text-transform: uppercase;"
                                            value="<?php echo set_value('primer_apellido'); ?>">
                                        <p id="primerApellidoError" class="text-danger"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="segundo_apellido">Segundo Apellido</label>
                                        <input type="text" class="form-control" id="segundo_apellido"
                                            name="segundo_apellido" placeholder="SEGUNDO APELLIDO"
                                            style="text-transform: uppercase;"
                                            value="<?php echo set_value('segundo_apellido'); ?>">
                                        <p id="segundoApellidoError" class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="nombre">Nombre(s)</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="NOMBRE(S)" style="text-transform: uppercase;"
                                            value="<?php echo set_value('nombre'); ?>">

                                        <p id="nombreError" class="text-danger"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="imagen">Foto de Perfil</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">Subir</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                                <label class="custom-file-label" for="imagen">Selecciona una
                                                    imagen</label>
                                            </div>
                                        </div>
                                        <p id="imagenError" class="text-danger"></p>
                                    </div>
                                </div>

                                <h4 class="text-primary mb-4">Información de Contacto</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="email">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" class="form-control" id="email" name="email"
                                            style="text-transform: lowercase;"
                                            placeholder="correo.electronico@gmail.com" required>
                                        <p id="emailError" class="text-danger"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="telefono">Teléfono - Celular</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono"
                                            placeholder="00000000">
                                        <p id="telefonoError" class="text-danger"></p>
                                    </div>
                                </div>
                                <h4 class="text-primary mb-4">Credenciales</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="rol">Rol</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control select2-with-label-single js-states d-block"
                                            id="rol" name="rol" required>
                                            <option value="">Seleccione un rol</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Cajero">Cajero</option>
                                            <option value="Asesor">Asesor</option>
                                        </select>
                                        <p id="rolError" class="text-danger"></p>
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


<script>
    const formInputs = [
        'primer_apellido', 'segundo_apellido', 'nombre', 'email', 'telefono', 'rol'
    ];

    // Agregar eventos de 'input' y 'keydown' para cada campo
    formInputs.forEach(id => {
        const inputElement = document.getElementById(id);

        // Validación en tiempo real en cada campo
        inputElement.addEventListener('input', function () {
            validarCampo(id);
        });

        // Validar todos los campos al presionar Enter
        inputElement.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                validarTodosLosCampos();
            }
        });
    });

    document.getElementById('imagen').addEventListener('change', validarImagen);

    function validarTodosLosCampos() {
        let todasValidaciones = true;

        formInputs.forEach(id => {
            const isValid = validarCampo(id);
            if (!isValid) {
                todasValidaciones = false; // Si al menos uno no es válido, establecemos en false
            }
        });

        if (todasValidaciones) {
            console.log("Todos los campos son válidos.");
            // Aquí puedes añadir lógica para lo que quieras hacer si todo es válido
        }
    }

    function validarCampo(id) {
        switch (id) {
            case 'primer_apellido':
                return validarPrimerApellido();
            case 'segundo_apellido':
                return validarSegundoApellido();
            case 'nombre':
                return validarNombre();
            case 'email':
                return validarEmail();
            case 'telefono':
                return validarTelefono();
            case 'rol':
                return validarSelect();
        }
        return false;
    }

    function validarPrimerApellido() {
        const input = document.getElementById('primer_apellido');
        const errorId = 'primerApellidoError';
        const valor = input.value.trim();
        const regex = /^[A-Za-z]+(?:[ ]{1,2}[A-Za-z]+)*$/;

        if (valor === '') {
            document.getElementById(errorId).textContent = 'Este campo es obligatorio.';
            return false;
        } else if (!regex.test(valor)) {
            document.getElementById(errorId).textContent = 'Solo se permiten letras';
            return false;
        } else {
            document.getElementById(errorId).textContent = '';
            return true;
        }
    }

    function validarSegundoApellido() {
        const input = document.getElementById('segundo_apellido');
        const errorId = 'segundoApellidoError';
        const valor = input.value.trim();
        const regex = /^[A-Za-z]+(?:[ ]{1,2}[A-Za-z]+)*$/;

        if (valor !== '' && !regex.test(valor)) {
            document.getElementById(errorId).textContent = 'Solo se permiten letras';
            return false;
        } else {
            document.getElementById(errorId).textContent = '';
            return true;
        }
    }

    function validarNombre() {
        const input = document.getElementById('nombre');
        const errorId = 'nombreError';
        const valor = input.value.trim();
        const regex = /^[A-Za-z]+(?:[ ]{1,2}[A-Za-z]+)*$/;

        if (valor === '') {
            document.getElementById(errorId).textContent = 'Este campo es obligatorio.';
            return false;
        } else if (!regex.test(valor)) {
            document.getElementById(errorId).textContent = 'Solo se permiten letras';
            return false;
        } else {
            document.getElementById(errorId).textContent = '';
            return true;
        }
    }

    function validarEmail() {
        const input = document.getElementById('email');
        const errorId = 'emailError';
        const valor = input.value.trim();
        const regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

        if (valor === '') {
            document.getElementById(errorId).textContent = 'Este campo es obligatorio.';
            return false;
        } else if (!regex.test(valor)) {
            document.getElementById(errorId).textContent = 'El formato del correo es incorrecto.';
            return false;
        } else {
            document.getElementById(errorId).textContent = '';
            return true;
        }
    }

    function validarTelefono() {
        const input = document.getElementById('telefono');
        const errorId = 'telefonoError';
        const valor = input.value.trim();
        const regex = /^[0-9]*$/;

        if (valor !== '' && !regex.test(valor)) {
            document.getElementById(errorId).textContent = 'Solo se permiten números.';
            return false;
        } else if (valor.length > 0 && valor.length < 8) {
            document.getElementById(errorId).textContent = 'Debe ingresar 8 dígitos.';
            return false;
        } else if (valor.length > 8) {
            document.getElementById(errorId).textContent = 'Solo se permite un máximo de 8 dígitos.';
            return false;
        } else {
            document.getElementById(errorId).textContent = '';
            return true;
        }
    }

    function validarSelect() {
        const select = document.getElementById('rol');
        const errorId = 'rolError';
        const valor = select.value;

        if (valor === '') {
            document.getElementById(errorId).textContent = 'Debe seleccionar un rol.';
            return false;
        } else {
            document.getElementById(errorId).textContent = '';
            return true;
        }
    }

    function validarImagen() {
        const imagen = document.getElementById('imagen');
        const imagenError = document.getElementById('imagenError');
        const archivo = imagen.files[0];
        const formatosPermitidos = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2 MB

        if (archivo) {
            if (!formatosPermitidos.includes(archivo.type)) {
                imagenError.textContent = 'Solo se permiten imágenes en formato JPG, JPEG o PNG.';
                imagen.value = ''; // Limpiar el campo
            } else if (archivo.size > maxSize) {
                imagenError.textContent = 'El tamaño máximo permitido es de 2MB.';
                imagen.value = ''; // Limpiar el campo
            } else {
                imagenError.textContent = '';
            }
        }
    }
</script>