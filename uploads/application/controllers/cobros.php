<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cobros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cobro_model');
    }

    public function index()
    {
        $data['cobros'] = $this->Cobro_model->obtener_cobros();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('cobros/index', $data);
        $this->load->view('templates/footer');
    }

    public function info($cobro_id)
    {
        $data['cobro'] = $this->Cobro_model->obtener_cobro_por_id($cobro_id);
        if (!$data['cobro']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('cobros/info', $data);
        $this->load->view('templates/footer');
    }

    public function agregar()
    {
        if ($this->input->post()) {
            $data = [
                'cuota_id' => $this->input->post('cuota_id'),
                'usuario_id' => $this->input->post('usuario_id'),
                'fecha_cobro' => $this->input->post('fecha_cobro'),
                'monto_cobrado' => $this->input->post('monto_cobrado'),
            ];
            $this->Cobro_model->agregar_cobro($data);
            redirect('cobros');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('cobros/agregar');
            $this->load->view('templates/footer');
        }
    }

    public function editar($cobro_id)
    {
        $data['cobro'] = $this->Cobro_model->obtener_cobro_por_id($cobro_id);

        if ($this->input->post()) {
            $data_update = [
                'cuota_id' => $this->input->post('cuota_id'),
                'usuario_id' => $this->input->post('usuario_id'),
                'fecha_cobro' => $this->input->post('fecha_cobro'),
                'monto_cobrado' => $this->input->post('monto_cobrado'),
            ];
            $this->Cobro_model->actualizar_cobro($cobro_id, $data_update);
            redirect('cobros');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('cobros/editar', $data);
            $this->load->view('templates/footer');
        }
    }

    public function eliminados()
    {
        $data['cobros'] = $this->Cobro_model->obtener_cobros_inactivos();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('cobros/eliminados', $data);
        $this->load->view('templates/footer');
    }

    public function eliminar($cobro_id)
    {
        $this->Cobro_model->eliminar_cobro_logicamente($cobro_id);
        $this->session->set_flashdata('mensaje', 'Cobro eliminado correctamente.');
        redirect('cobros');
    }

    public function habilitar($cobro_id)
    {
        $this->Cobro_model->habilitar_cobro($cobro_id);
        $this->session->set_flashdata('mensaje', 'Cobro habilitado correctamente.');
        redirect('cobros');
    }
}
?>
