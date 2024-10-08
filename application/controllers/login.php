<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('login_view');
    }

    public function autenticar()
    {
        $nombre_usuario = $this->input->post('nombre_usuario');
        $password = $this->input->post('password');

        $usuario = $this->Usuario_model->autenticar($nombre_usuario, $password);

        if ($usuario) {
            $data = array(
                'usuario_id' => $usuario->usuario_id,
                'nombre ' => $usuario->nombre ,
                'nombre_usuario' => $usuario->nombre_usuario,
                'imagen' => $usuario->imagen,
                'email' => $usuario->email,
                'telefono' => $usuario->telefono,
                'rol ' => $usuario->rol ,
                'login' => TRUE
            );
            $this->session->set_userdata($data);
            $this->session->set_flashdata("sweet-success", "Bienvenido " . $usuario->nombre . "!");
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Nombre de usuario o contraseña incorrectos.');
            redirect('login');
        }
    }

    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
?>