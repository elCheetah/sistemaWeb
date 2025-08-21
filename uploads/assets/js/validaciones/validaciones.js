document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('userForm');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Nombre Completo
        const nombre = document.getElementById('nombre').value.trim();
        const nombreError = document.getElementById('nombreError');
        if (nombre === '') {
            nombreError.textContent = 'El nombre completo es obligatorio.';
            valid = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
            nombreError.textContent = 'El nombre completo solo debe contener letras y espacios.';
            valid = false;
        } else {
            nombreError.textContent = '';
        }

        // Imagen de Perfil
        const imagen = document.getElementById('imagen').files[0];
        const imagenError = document.getElementById('imagenError');
        if (imagen && !['image/jpeg', 'image/png'].includes(imagen.type)) {
            imagenError.textContent = 'Solo se permiten imágenes en formato JPEG o PNG.';
            valid = false;
        } else {
            imagenError.textContent = '';
        }

        // Email
        const email = document.getElementById('email').value.trim();
        const emailError = document.getElementById('emailError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            emailError.textContent = 'El correo electrónico es obligatorio.';
            valid = false;
        } else if (!emailRegex.test(email)) {
            emailError.textContent = 'Ingrese un correo electrónico válido.';
            valid = false;
        } else {
            emailError.textContent = '';
        }

        // Teléfono (opcional)
        const telefono = document.getElementById('telefono').value.trim();
        const telefonoError = document.getElementById('telefonoError');
        const telefonoRegex = /^(091|0[2-9][0-9])\d{6,8}$/;
        if (telefono !== '' && !telefonoRegex.test(telefono)) {
            telefonoError.textContent = 'Ingrese un número de teléfono válido (ej. 091234567 o 0912-345678).';
            valid = false;
        } else {
            telefonoError.textContent = '';
        }

        // Nombre de Usuario
        const nombreUsuario = document.getElementById('nombre_usuario').value.trim();
        const nombreUsuarioError = document.getElementById('nombreUsuarioError');
        if (nombreUsuario === '') {
            nombreUsuarioError.textContent = 'El nombre de usuario es obligatorio.';
            valid = false;
        } else if (/[^a-zA-Z0-9_]/.test(nombreUsuario)) {
            nombreUsuarioError.textContent = 'El nombre de usuario solo puede contener letras, números y guiones bajos.';
            valid = false;
        } else {
            nombreUsuarioError.textContent = '';
        }

        // Rol
        const rol = document.getElementById('rol').value;
        const rolError = document.getElementById('rolError');
        if (rol === '') {
            rolError.textContent = 'Seleccione un rol.';
            valid = false;
        } else {
            rolError.textContent = '';
        }

        // Contraseña
        const password = document.getElementById('password').value;
        const passwordError = document.getElementById('passwordError');
        if (password === '') {
            passwordError.textContent = 'La contraseña es obligatoria.';
            valid = false;
        } else if (password.length < 6) {
            passwordError.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            valid = false;
        } else if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/\d/.test(password)) {
            passwordError.textContent = 'La contraseña debe contener al menos una letra minúscula, una letra mayúscula y un número.';
            valid = false;
        } else {
            passwordError.textContent = '';
        }

        // Repetir Contraseña
        const passwordConfirm = document.getElementById('password_confirm').value;
        const passwordConfirmError = document.getElementById('passwordConfirmError');
        if (passwordConfirm === '') {
            passwordConfirmError.textContent = 'Debe repetir la contraseña.';
            valid = false;
        } else if (password !== passwordConfirm) {
            passwordConfirmError.textContent = 'Las contraseñas no coinciden.';
            valid = false;
        } else {
            passwordConfirmError.textContent = '';
        }

        // Deshabilitar el botón si hay errores
        submitButton.disabled = !valid;

        // Previene el envío del formulario si hay errores
        if (!valid) {
            event.preventDefault();
        }
    });
});
