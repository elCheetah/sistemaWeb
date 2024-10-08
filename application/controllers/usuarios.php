<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->helper('url');
        $this->load->library(['session', 'form_validation', 'upload', 'email']);
        $this->load->config('email');

    }

    public function index()
    {
        $data = array("usuarios" => $this->Usuario_model->obtener_usuarios_activos());
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/index', $data);
        $this->load->view('templates/footer');
    }

    public function agregar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required', array('required' => 'El campo %s es obligatorio.'));
        $this->form_validation->set_rules('primer_apellido', 'Primer Apellido', 'required', array('required' => 'El campo %s es obligatorio.'));
        $this->form_validation->set_rules('segundo_apellido', 'Segundo Apellido','trim');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|valid_email|is_unique[Usuarios.email]', array(
            'required' => 'El campo %s es obligatorio.',
            'valid_email' => 'El campo %s debe contener una dirección de correo válida.',
            'is_unique' => 'El %s ya está en uso.'
        ));
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim'); // Opcional, no obligatorio
        $this->form_validation->set_rules('rol', 'Rol', 'required', array('required' => 'El campo %s es obligatorio.'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('usuarios/agregar');
            $this->load->view('templates/footer');
        } else {
            // Procesar los datos del formulario
            $data['nombre'] = $this->input->post('nombre');
            $data['primer_apellido'] = $this->input->post('primer_apellido');
            $data['segundo_apellido'] = $this->input->post('segundo_apellido');
            $data['email'] = $this->input->post('email');
            $data['telefono'] = $this->input->post('telefono'); // Opcional
            $data['rol'] = $this->input->post('rol');

            // Generar nombre de usuario y contraseña
            $us_generado = $this->generarUsuario($this->input->post('nombre'));
            $pass_generado = $this->generarContrasena($this->input->post('nombre'), $this->input->post('email'));
            $hash_pass = md5($pass_generado);

            $data['nombre_usuario'] = $us_generado;
            $data['password'] = $hash_pass;

            // Manejo de la imagen (opcional)
            if (!empty($_FILES['imagen']['name'])) {
                $imagen_procesada = $this->procesar_imagen($_FILES['imagen'], $us_generado);
                if ($imagen_procesada) {
                    $data['imagen'] = $imagen_procesada;
                } else {
                    $data['imagen'] = null; // Si hay error en el procesamiento
                }
            } else {
                $data['imagen'] = null; // No se subió imagen
            }

            // Guardar los datos en la base de datos
            if ($this->Usuario_model->agregar_usuario($data)) {
                if ($this->enviarContrasenaEmail($data['email'], $us_generado, $pass_generado)) {
                    $this->session->set_flashdata("success", "Usuario guardado y correo enviado correctamente.");
                } else {
                    $this->session->set_flashdata("warning", "Usuario guardado, pero no se pudo enviar el correo.");
                }
                redirect(base_url() . "index.php/usuarios");
            } else {
                $this->session->set_flashdata("error", "No se pudo guardar el usuario.");
                redirect(base_url() . "index.php/usuarios/agregar");
            }
        }
    }

    public function procesar_imagen($imagen_subida, $nombre_usuario)
    {
        $config['upload_path'] = './assets/img/usuarios/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Tamaño máximo 2MB
        $config['file_name'] = $nombre_usuario . '.' . pathinfo($imagen_subida['name'], PATHINFO_EXTENSION);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagen')) {
            $ruta_imagen = $config['upload_path'] . $config['file_name'];

            // Verificar el tipo de imagen
            $tipo_imagen = getimagesize($ruta_imagen);
            switch ($tipo_imagen['mime']) {
                case 'image/jpeg':
                    $imagen_original = imagecreatefromjpeg($ruta_imagen);
                    break;
                case 'image/png':
                    $imagen_original = imagecreatefrompng($ruta_imagen);
                    break;
                default:
                    return null; // Tipo de imagen no soportado
            }

            if ($imagen_original) {
                $ancho_original = imagesx($imagen_original);
                $alto_original = imagesy($imagen_original);

                // Definir el tamaño del cuadrado (el lado más corto)
                $tamaño_cuadrado = min($ancho_original, $alto_original);

                // Coordenadas para centrar el recorte
                $x_centro = ($ancho_original - $tamaño_cuadrado) / 2;
                $y_centro = ($alto_original - $tamaño_cuadrado) / 2;

                // Crear una imagen cuadrada recortada
                $imagen_cuadrada = imagecrop($imagen_original, [
                    'x' => $x_centro,
                    'y' => $y_centro,
                    'width' => $tamaño_cuadrado,
                    'height' => $tamaño_cuadrado
                ]);

                if ($imagen_cuadrada) {
                    // Guardar la imagen recortada con el nombre generado
                    switch ($tipo_imagen['mime']) {
                        case 'image/jpeg':
                            imagejpeg($imagen_cuadrada, $ruta_imagen);
                            break;
                        case 'image/png':
                            imagepng($imagen_cuadrada, $ruta_imagen);
                            break;
                    }

                    // Liberar memoria
                    imagedestroy($imagen_cuadrada);
                    imagedestroy($imagen_original);

                    return $config['file_name']; // Retornar el nombre de la imagen procesada
                }
            }
        }

        return null; // Retornar null si algo falla
    }


    private function generarUsuario($nombre)
    {
        $num_aleatorio = rand(10, 99);
        $letras = '';

        // Generar dos letras minúsculas aleatorias
        for ($i = 0; $i < 2; $i++) {
            $letra = chr(rand(97, 122)); // Generar letra minúscula
            $letras .= $letra;
        }

        // Cortar el nombre hasta el primer espacio y convertir a minúsculas
        $parte_nombre = strtolower(strtok($nombre, ' '));

        return $parte_nombre . $num_aleatorio . $letras;
    }

    private function generarContrasena($nombre, $email)
    {
        $letras = '';
        for ($i = 0; $i < 3; $i++) {
            $letra = chr(rand(97, 122)); // Generar letra minúscula
            if (rand(0, 1) === 1) {
                $letra = strtoupper($letra); // Convertir a mayúscula aleatoriamente
            }
            $letras .= $letra;
        }

        $parte_nombre = strtoupper(substr($nombre, 0, 3));
        $parte_email = substr($email, 0, 2);
        $num_aleatorio = rand(10, 99);

        return $letras . $parte_nombre . $parte_email . $num_aleatorio;
    }

    private function enviarContrasenaEmail($email, $nombre_usuario, $password)
    {
        $this->email->from('crenasasrl2@gmail.com', 'CRENASA SRL'); // Remitente
        $this->email->to($email);
        $this->email->subject('Detalles de tu cuenta');
        $this->email->message("Tu nombre de usuario es: $nombre_usuario<br>Tu contraseña es: $password");

        if ($this->email->send()) {
            log_message('info', 'Correo enviado correctamente a: ' . $email);
            return true;
        } else {
            log_message('error', 'No se pudo enviar el correo a: ' . $email);
            log_message('error', $this->email->print_debugger(['headers']));
            return false;
        }
    }

    public function editar($usuario_id)
    {
        // Validación de los campos obligatorios
        $this->form_validation->set_rules('nombre', 'Nombre Completo', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nombre_usuario', 'Nombre de Usuario', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Obtener la información del usuario para la vista
            $data['usuario'] = $this->Usuario_model->obtener_usuario($usuario_id);

            // Cargar las vistas
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('usuarios/editar', $data); // Enviar los datos a la vista de edición
            $this->load->view('templates/footer');
        } else {
            // Recoger datos del formulario
            $data['nombre'] = $this->input->post('nombre');
            $data['nombre_usuario'] = $this->input->post('nombre_usuario');
            $data['email'] = $this->input->post('email');
            $data['telefono'] = $this->input->post('telefono');

            // Manejo de la imagen (opcional)
            if (!empty($_FILES['imagen']['name'])) {
                $config['upload_path'] = './assets/img/usuarios/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_name'] = $usuario_id . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION); // Nombre del archivo basado en el ID del usuario

                $this->upload->initialize($config);

                if ($this->upload->do_upload('imagen')) {
                    $data['imagen'] = $config['file_name'];
                }
            }

            // Actualizar datos del usuario en la base de datos
            $this->Usuario_model->editar_usuario($usuario_id, $data);

            // Mensaje de éxito y redirección
            $this->session->set_flashdata('mensaje', 'Usuario editado correctamente.');
            redirect('usuarios/info/' . $usuario_id, 'refresh');
        }
    }

    public function info($usuario_id)
    {
        $data['usuario'] = $this->Usuario_model->obtener_usuario_por_id($usuario_id);
        if (!$data['usuario']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/info', $data);
        $this->load->view('templates/footer');
    }






    public function eliminar($usuario_id)
    {
        $resp = $this->Usuario_model->eliminar_usuario($usuario_id);
        $this->session->set_flashdata($resp[0], $resp[1]);
        redirect(base_url() . 'index.php/usuarios');
    }
    public function eliminados()
    {
        $data['usuarios'] = $this->Usuario_model->obtener_usuarios_eliminados();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/eliminados', $data);
        $this->load->view('templates/footer');
    }

    public function habilitar($usuario_id)
    {
        $this->Usuario_model->habilitar_usuario($usuario_id);
        $this->session->set_flashdata('mensaje', 'Usuario habilitado correctamente.');
        redirect('usuarios');
    }
}
?>
?>