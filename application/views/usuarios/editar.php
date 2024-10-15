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
                            <form class="form-valide" method="post"
                                action="<?= base_url('index.php/usuarios/editar/' . $usuario['usuario_id']) ?>"
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
                                        <label class="text-black" for="email">Primer Apellido</label>
                                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                                            placeholder="PRIMER APELLIDO" value="<?= $usuario['primer_apellido'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                                            placeholder="SEGUNDO APELLIDO" value="<?= $usuario['segundo_apellido'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-black" for="nombre">Nombre(s)</label>
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
                                        <p id="imagenError" class="text-danger"></p>
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
                                            name="nombre_usuario" placeholder="Nombre de Usuario"
                                            value="<?= $usuario['nombre_usuario'] ?>" required>
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