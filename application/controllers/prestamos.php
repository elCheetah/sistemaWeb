<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prestamo_model');
    }

    public function index()
    {
        $data['prestamos'] = $this->Prestamo_model->obtener_prestamos_con_clientes();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('prestamos/index', $data);
        $this->load->view('templates/footer');
    }

    public function info($prestamo_id)
    {
        $data['prestamo'] = $this->Prestamo_model->obtener_prestamo_por_id($prestamo_id);
        if (!$data['prestamo']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('prestamos/info', $data);
        $this->load->view('templates/footer');
    }

    public function agregar()
    {
        if ($this->input->post()) {
            $data = [
                'cliente_id' => $this->input->post('cliente_id'),
                'usuario_id' => $this->input->post('usuario_id'),
                'monto' => $this->input->post('monto'),
                'tasa_interes' => $this->input->post('tasa_interes'),
                'cargo' => $this->input->post('cargo'),
                'fecha_inicio' => $this->input->post('fecha_inicio'),
                'fecha_fin' => $this->input->post('fecha_fin'),
                'estado_prestamo_id' => $this->input->post('estado_prestamo_id'),
                'numero_cuotas' => $this->input->post('numero_cuotas'),
            ];
            $this->Prestamo_model->agregar_prestamo($data);
            redirect('prestamos');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('prestamos/agregar');
            $this->load->view('templates/footer');
        }
    }

    public function editar($prestamo_id)
    {
        $data['prestamo'] = $this->Prestamo_model->obtener_prestamo_por_id($prestamo_id);

        if ($this->input->post()) {
            $data_update = [
                'cliente_id' => $this->input->post('cliente_id'),
                'usuario_id' => $this->input->post('usuario_id'),
                'monto' => $this->input->post('monto'),
                'tasa_interes' => $this->input->post('tasa_interes'),
                'cargo' => $this->input->post('cargo'),
                'fecha_inicio' => $this->input->post('fecha_inicio'),
                'fecha_fin' => $this->input->post('fecha_fin'),
                'estado_prestamo_id' => $this->input->post('estado_prestamo_id'),
                'numero_cuotas' => $this->input->post('numero_cuotas'),
            ];
            $this->Prestamo_model->actualizar_prestamo($prestamo_id, $data_update);
            redirect('prestamos');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('prestamos/editar', $data);
            $this->load->view('templates/footer');
        }
    }

    public function eliminados()
    {
        $data['prestamos'] = $this->Prestamo_model->obtener_prestamos_inactivos();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('prestamos/eliminados', $data);
        $this->load->view('templates/footer');
    }

    public function eliminar($prestamo_id)
    {
        $this->Prestamo_model->eliminar_prestamo_logicamente($prestamo_id);
        $this->session->set_flashdata('mensaje', 'Préstamo eliminado correctamente.');
        redirect('prestamos');
    }

    public function habilitar($prestamo_id)
    {
        $this->Prestamo_model->habilitar_prestamo($prestamo_id);
        $this->session->set_flashdata('mensaje', 'Préstamo habilitado correctamente.');
        redirect('prestamos');
    }
}
?>
