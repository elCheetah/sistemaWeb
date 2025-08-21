<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');


        $this->load->helper('url');
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->library(['session', 'form_validation', 'email']);
        $this->load->config('email');

        #if (!$this->session->userdata("login")) {
        #	redirect(base_url()."index.php/login");
        #}
    }

    public function index()
    {
        $data = array("usuarios" => $this->Usuario_model->obtener_usuarios_activos());

        #$data['usuarios'] = $this->Usuario_model->obtener_usuarios_activos();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/index', $data);
        $this->load->view('templates/footer');
    }

    public function eliminar($usuario_id)
    {
        $resp = $this->Usuario_model->eliminar_usuario($usuario_id);
        $this->session->set_flashdata($resp[0], $resp[1]);
        redirect(base_url() . 'index.php/usuarios');
    }
    public function agregar()
{
    // Validaciones de los campos obligatorios
    $this->form_validation->set_rules('nombre', 'Nombre Completo', 'required');
    $this->form_validation->set_rules('nombre_usuario', 'Nombre de Usuario', 'required|is_unique[Usuarios.nombre_usuario]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[Usuarios.email]');
    $this->form_validation->set_rules('password', 'Contraseña', 'required');
    $this->form_validation->set_rules('rol', 'Rol', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        // Si hay errores, se vuelve a cargar la vista con los errores
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/agregar');
        $this->load->view('templates/footer');
    } else {
        // Procesar los datos del formulario
        $data['nombre'] = $this->input->post('nombre');
        $data['nombre_usuario'] = $this->input->post('nombre_usuario');
        $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Encriptar la contraseña
        $data['email'] = $this->input->post('email');
        $data['telefono'] = $this->input->post('telefono'); // Opcional
        $data['rol'] = $this->input->post('rol');
        $data['estado'] = 1; // Por defecto activo (1)

        // Manejo de la imagen (opcional)
        if (!empty($_FILES['imagen']['name'])) {
            $config['upload_path'] = './uploads/usuarios/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // Tamaño máximo 2MB
            $config['file_name'] = $data['nombre_usuario'] . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagen')) {
                $data['imagen'] = $config['file_name'];
            } else {
                // Si hay error en la subida, puedes manejar el error o dejar imagen como NULL
                $data['imagen'] = null;
            }
        } else {
            $data['imagen'] = null; // No se subió imagen
        }

        // Guardar el usuario en la base de datos
        $this->Usuario_model->agregar_usuario($data);

        // Mostrar mensaje de éxito y redirigir
        $this->session->set_flashdata('mensaje', 'Usuario agregado correctamente.');
        redirect('usuarios', 'refresh');
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

    private function generate_password($name, $street, $phoneNumber) {
        // Generar contraseña con el formato solicitado
        $name_part = strtolower(substr($name, 0, 2));
        $street_part = strtolower($street);
        $random_number = rand(100, 999);
        return $name_part . $street_part . $random_number;
    }

    private function send_password_email($email, $username, $password) {
        $this->load->library('email');

        $this->email->from('calle.abram.146@gmail.com', 'ANDROID CENTER');
        $this->email->to($email);
        $this->email->subject('Detalles de tu cuenta');
        $this->email->message("Tu nombre de usuario es: $username<br>Tu contraseña es: $password");

        if ($this->email->send()) {
            log_message('info', 'Correo enviado correctamente a: ' . $email);
            return true;
        } else {
            log_message('error', 'No se pudo enviar el correo a: ' . $email);
            log_message('error', $this->email->print_debugger());
            return false;
        }
    }

}
?>
?>