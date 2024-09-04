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
    }

    public function index()
    {
        $data['usuarios'] = $this->Usuario_model->obtener_usuarios_activos();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/index', $data);
        $this->load->view('templates/footer');
    }

    public function agregar()
{
    if ($this->input->post()) {
        // Configuración de las reglas de validación
        $this->form_validation->set_rules('nombre', 'Nombre Completo', 'required|regex_match[/^[a-zA-Z\s]+$/]|min_length[3]|max_length[50]', [
            'required' => 'El campo Nombre Completo es obligatorio.',
            'regex_match' => 'El campo Nombre Completo debe contener solo letras.',
            'min_length' => 'El campo Nombre Completo debe tener al menos 3 caracteres.',
            'max_length' => 'El campo Nombre Completo debe tener como máximo 50 caracteres.'
        ]);
        $this->form_validation->set_rules('imagen', 'Foto de Perfil', 'callback_file_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]', [
            'required' => 'El campo Email es obligatorio.',
            'valid_email' => 'El campo Email debe contener una dirección de correo válida.',
            'is_unique' => 'El Email ingresado ya está registrado.'
        ]);
        $this->form_validation->set_rules('telefono', 'Teléfono', 'numeric|exact_length[8]', [
            'numeric' => 'El campo Teléfono debe contener solo números.',
            'exact_length' => 'El campo Teléfono debe tener exactamente 8 dígitos.'
        ]);
        $this->form_validation->set_rules('nombre_usuario', 'Nombre de Usuario', 'required|min_length[4]|max_length[20]|is_unique[usuarios.nombre_usuario]', [
            'required' => 'El campo Nombre de Usuario es obligatorio.',
            'min_length' => 'El campo Nombre de Usuario debe tener al menos 4 caracteres.',
            'max_length' => 'El campo Nombre de Usuario debe tener como máximo 20 caracteres.',
            'is_unique' => 'El Nombre de Usuario ingresado ya está registrado.'
        ]);
        $this->form_validation->set_rules('rol', 'Rol', 'required', [
            'required' => 'Debe seleccionar un rol.'
        ]);
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]|callback_valid_password', [
            'required' => 'El campo Contraseña es obligatorio.',
            'min_length' => 'El campo Contraseña debe tener al menos 8 caracteres.',
            'valid_password' => 'El campo Contraseña debe incluir al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.'
        ]);
        $this->form_validation->set_rules('password_confirm', 'Repetir Contraseña', 'required|matches[password]', [
            'required' => 'El campo Repetir Contraseña es obligatorio.',
            'matches' => 'Las contraseñas no coinciden.'
        ]);

        if ($this->form_validation->run() === TRUE) {
            // Preparar los datos para insertar en la base de datos
            $data = [
                'nombre' => $this->input->post('nombre'),
                'email' => $this->input->post('email'),
                'nombre_usuario' => $this->input->post('nombre_usuario'),
                'password' => md5($this->input->post('password')),
                'rol' => $this->input->post('rol')
            ];

            // Manejo de la imagen (si se sube)
            if (!empty($_FILES['imagen']['name'])) {
                $config['upload_path'] = './uploads/usuarios/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB máximo
                $config['file_name'] = $this->input->post('nombre_usuario') . '_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('imagen')) {
                    $uploadData = $this->upload->data();
                    $data['imagen'] = $uploadData['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('usuarios/agregar');
                }
            }

            $this->Usuario_model->insertar_usuario($data);
            $this->session->set_flashdata('mensaje', 'Usuario agregado correctamente.');
            redirect('usuarios');
        } else {
            $this->session->set_flashdata('error', validation_errors());
        }
    }

    $this->load->view('templates/header');
    $this->load->view('templates/navbar');
    $this->load->view('templates/sidebar');
    $this->load->view('usuarios/agregar');
    $this->load->view('templates/footer');
}

// Validación de la contraseña
public function valid_password($password)
{
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
        $this->form_validation->set_message('valid_password', 'El campo Contraseña debe incluir al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.');
        return FALSE;
    }
    return TRUE;
}

// Validación del archivo
public function file_check($str)
{
    $allowed_mime_type_arr = ['image/jpeg', 'image/png'];
    $mime = get_mime_by_extension($_FILES['imagen']['name']);
    if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {
        if (in_array($mime, $allowed_mime_type_arr)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('file_check', 'El archivo debe ser una imagen en formato JPG, JPEG o PNG.');
            return FALSE;
        }
    } else {
        return TRUE;
    }
}



    public function editar($usuario_id)
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('nombre', 'Nombre Completo', 'required|alpha_spaces|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'numeric|exact_length[8]');
            $this->form_validation->set_rules('nombre_usuario', 'Nombre de Usuario', 'required|min_length[4]|max_length[20]|is_unique[usuarios.nombre_usuario]');
            $this->form_validation->set_rules('rol', 'Rol', 'required');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]|callback_valid_password');
            $this->form_validation->set_rules('password_confirm', 'Repetir Contraseña', 'required|matches[password]');


            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'nombre' => $this->input->post('nombre'),
                    'email' => $this->input->post('email'),
                    'nombre_usuario' => $this->input->post('nombre_usuario'),
                    'rol' => $this->input->post('rol'),
                    'ultima_modificacion' => date('Y-m-d H:i:s')
                ];

                // Manejo de la imagen (si se sube una nueva)
                if (!empty($_FILES['imagen']['name'])) {
                    $config['upload_path'] = './uploads/usuarios/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 2048; // 2MB máximo
                    $config['file_name'] = $this->input->post('nombre_usuario') . '_' . time();

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('imagen')) {
                        $uploadData = $this->upload->data();
                        $data['imagen'] = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('usuarios/editar/' . $usuario_id);
                    }
                }

                if ($this->input->post('password')) {
                    $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                }

                $this->Usuario_model->editar_usuario($usuario_id, $data);
                $this->session->set_flashdata('mensaje', 'Usuario actualizado correctamente.');
                redirect('usuarios');
            } else {
                $this->session->set_flashdata('error', validation_errors());
            }
        }

        $data['usuario'] = $this->Usuario_model->obtener_usuario_por_id($usuario_id);
        if (!$data['usuario']) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/editar', $data);
        $this->load->view('templates/footer');
    }

    public function eliminar($usuario_id)
    {
        $this->Usuario_model->eliminar_usuario($usuario_id);
        $this->session->set_flashdata('mensaje', 'Usuario eliminado correctamente.');
        redirect('usuarios');
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
}
?>
?>