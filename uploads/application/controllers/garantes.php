<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Garantes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Garante_model'); // Cambiar Cliente_model a Garante_model
    }

    public function index()
    {
        $data['garantes'] = $this->Garante_model->obtener_garantes_activos(); // Cambiar clientes a garantes
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('garantes/index', $data); // Cambiar clientes a garantes
        $this->load->view('templates/footer');
    }

    public function info($garante_id) {
        $data['garante'] = $this->Garante_model->obtener_garante_por_id($garante_id); // Cambiar cliente_id a garante_id
        if (!$data['garante']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('garantes/info', $data); // Cambiar clientes a garantes
        $this->load->view('templates/footer');
    }

    public function agregar()
    {
        if ($this->input->post()) {
            $data = [
                'nombre' => $this->input->post('nombre'),
                'primer_apellido' => $this->input->post('primer_apellido'),
                'segundo_apellido' => $this->input->post('segundo_apellido'),
                'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
                'direccion' => $this->input->post('direccion'),
                'direccion_gps' => $this->input->post('direccion_gps'),
                'estado_civil' => $this->input->post('estado_civil'),
                'ocupacion' => $this->input->post('ocupacion'),
                'telefono' => $this->input->post('telefono'),
                'email' => $this->input->post('email'),
                'sexo' => $this->input->post('sexo'),
            ];
            $this->Garante_model->agregar_garante($data); // Cambiar agregar_cliente a agregar_garante
            redirect('garantes'); // Cambiar clientes a garantes
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('garantes/agregar'); // Cambiar clientes a garantes
            $this->load->view('templates/footer');
        }
    }

    public function editar($garante_id)
    {
        $data['garante'] = $this->Garante_model->obtener_garante_por_id($garante_id); // Cambiar cliente_id a garante_id

        if ($this->input->post()) {
            $data_update = [
                'nombre' => $this->input->post('nombre'),
                'primer_apellido' => $this->input->post('primer_apellido'),
                'segundo_apellido' => $this->input->post('segundo_apellido'),
                'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
                'direccion' => $this->input->post('direccion'),
                'direccion_gps' => $this->input->post('direccion_gps'),
                'estado_civil' => $this->input->post('estado_civil'),
                'ocupacion' => $this->input->post('ocupacion'),
                'telefono' => $this->input->post('telefono'),
                'email' => $this->input->post('email'),
                'sexo' => $this->input->post('sexo'),
            ];
            $this->Garante_model->actualizar_garante($garante_id, $data_update); // Cambiar actualizar_cliente a actualizar_garante
            redirect('garantes'); // Cambiar clientes a garantes
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('garantes/editar', $data); // Cambiar clientes a garantes
            $this->load->view('templates/footer');
        }
    }

    public function eliminados()
    {
        $data['garantes'] = $this->Garante_model->obtener_garantes_inactivos(); // Cambiar clientes a garantes
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('garantes/eliminados', $data); // Cambiar clientes a garantes
        $this->load->view('templates/footer');
    }

    public function eliminar($garante_id)
    {
        $this->Garante_model->eliminar_garante_logicamente($garante_id); // Cambiar cliente_id a garante_id
        $this->session->set_flashdata('mensaje', 'Garante eliminado correctamente.'); // Cambiar Cliente a Garante
        redirect('garantes'); // Cambiar clientes a garantes
    }
    public function habilitar($garante_id) {
        $this->Garante_model->habilitar_garante($garante_id);
        $this->session->set_flashdata('mensaje', 'Garante habilitado correctamente.');
        redirect('garantes');
    }
}
?>
