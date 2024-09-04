<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cliente_model');
    }

    public function index()
    {
        $data['clientes'] = $this->Cliente_model->obtener_clientes_activos();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/index', $data);
        $this->load->view('templates/footer');
    }
    public function info($cliente_id) {
        $data['cliente'] = $this->Cliente_model->obtener_cliente_por_id($cliente_id);
        if (!$data['cliente']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/info', $data);
        $this->load->view('templates/footer');
    }
    public function agregar()
    {
        if ($this->input->post()) {
            $data = [
                'ci' => $this->input->post('ci'),
                'nombre' => $this->input->post('nombre'),
                'primer_apellido' => $this->input->post('primer_apellido'),
                'segundo_apellido' => $this->input->post('segundo_apellido'),
                'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
                'direccion' => $this->input->post('direccion'),
                'telefono' => $this->input->post('telefono'),
                'email' => $this->input->post('email'),
                'nombre_garante' => $this->input->post('nombre_garante'),
                'apellidos_garante' => $this->input->post('apellidos_garante'),
                'telefono_garante' => $this->input->post('telefono_garante'),
                'email_garante' => $this->input->post('email_garante'),
                'direccion_garante' => $this->input->post('direccion_garante'),
            ];
            $this->Cliente_model->agregar_cliente($data);
            redirect('clientes');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('clientes/agregar');
            $this->load->view('templates/footer');
        }
    }

    public function editar($cliente_id)
{
    // Obtener los datos del cliente desde la base de datos
    $data['cliente'] = $this->Cliente_model->obtener_cliente_por_id($cliente_id);

    if ($this->input->post()) {
        // Actualizar los datos del cliente con los valores recibidos del formulario
        $data_update = [
            'ci' => $this->input->post('ci'),
            'nombre' => $this->input->post('nombre'),
            'primer_apellido' => $this->input->post('primer_apellido'),
            'segundo_apellido' => $this->input->post('segundo_apellido'),
            'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
            'direccion' => $this->input->post('direccion'),
            'direccion_gps' => $this->input->post('direccion_gps'),
            'telefono' => $this->input->post('telefono'),
            'email' => $this->input->post('email'),
            'estado_civil' => $this->input->post('estado_civil'),
            'genero' => $this->input->post('genero'),
            'ocupacion' => $this->input->post('ocupacion'),
            'promedio_ingresos_mensuales' => $this->input->post('promedio_ingresos_mensuales'),
            'direccion_ocupacion' => $this->input->post('direccion_ocupacion'),
            'primer_garante_id' => $this->input->post('primer_garante_id'),
            'segundo_garante_id' => $this->input->post('segundo_garante_id')
        ];

        // Actualizar los datos en la base de datos
        $this->Cliente_model->actualizar_cliente($cliente_id, $data_update);

        // Redirigir a la lista de clientes
        redirect('clientes');
    } else {
        // Cargar las vistas para la edición
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/editar', $data);
        $this->load->view('templates/footer');
    }
}


    public function eliminados()
    {
        $data['clientes'] = $this->Cliente_model->obtener_clientes_inactivos();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/eliminados',$data);
        $this->load->view('templates/footer');

    }

    public function eliminar($cliente_id)
    {
        $this->Cliente_model->eliminar_cliente_logicamente($cliente_id);
        $this->session->set_flashdata('mensaje', 'Cliente eliminado correctamente.');
        redirect('clientes');
    }
    public function habilitar($cliente_id) {
        $this->Cliente_model->habilitar_cliente($cliente_id);
        $this->session->set_flashdata('mensaje', 'Cliente habilitado correctamente.');
        redirect('clientes');
    }
}
?>