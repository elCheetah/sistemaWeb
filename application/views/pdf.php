<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios Activos</title>
    <style>
        body {
            background-color: #f8f9fa;
            /* Color de fondo suave */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            margin-top: 50px;
            position: relative;
            /* Para la marca de agua */
        }

        h1 {
            text-align: center;
            color: #343a40;
            /* Color de título */
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Sombra para la tabla */
            overflow: hidden;
            /* Para que los bordes redondeados funcionen */
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
            /* Tamaño de fuente para celdas */
            border: 1px solid #ddd;
            /* Bordes de celdas */
        }

        th {
            background-color: #007bff;
            /* Color de fondo para encabezados */
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
            /* Color de fondo para filas pares */
        }

        tr:hover {
            background-color: #f1f1f1;
            /* Color de fondo al pasar el ratón */
        }

        .watermark {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%) rotate(-45deg);
            color: rgba(0, 123, 255, 0.1);
            /* Color azul claro y transparente */
            font-size: 80px;
            /* Tamaño grande para la marca de agua */
            font-weight: bold;
            pointer-events: none;
            /* No interferir con el clic en la tabla */
        }
    </style>
</head>

<body>

    <div class="container">


        <img src="<?php echo base_url('assets/img/usuarios/default.jpg'); ?>"
            class="rounded-circle mr-2 width36 height36 border border-primary" alt="" width="40px" height="40px">
        

        <h1>Lista de Usuarios Activos</h1>
        <div class="watermark">CRENASA SRL</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td>juan.perez@example.com</td>
                    <td>(123) 456-7890</td>
                    <td>Administrador</td>
                    <td>Activo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ana Gómez</td>
                    <td>ana.gomez@example.com</td>
                    <td>(123) 456-7891</td>
                    <td>Usuario</td>
                    <td>Activo</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pedro Ruiz</td>
                    <td>pedro.ruiz@example.com</td>
                    <td>(123) 456-7892</td>
                    <td>Moderador</td>
                    <td>Activo</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>María López</td>
                    <td>maria.lopez@example.com</td>
                    <td>(123) 456-7893</td>
                    <td>Usuario</td>
                    <td>Inactivo</td>
                </tr>
                <!-- Puedes agregar más filas aquí -->
            </tbody>
        </table>
    </div>

</body>

</html>