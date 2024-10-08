<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prestamo_model');
        $this->load->model('Cliente_model');
        $this->load->model('Cuotas_model');
        $this->load->model('DetallePrestamos_model');
        $this->load->library('form_validation');
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


    }

    public function agregar()
    {
        $this->form_validation->set_rules('cliente_id', 'Cliente', 'required');
        $this->form_validation->set_rules('monto', 'Monto del Préstamo', 'required|numeric');
        $this->form_validation->set_rules('tasa_interes', 'Tasa de Interés', 'required|numeric');
        $this->form_validation->set_rules('numero_cuotas', 'Número de Cuotas', 'required|integer');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha de Inicio', 'required');
        $this->form_validation->set_rules('fecha_fin', 'Fecha de Fin', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripción del préstamo', 'required');

        // Mensajes de error personalizados en español
        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser un número.');
        $this->form_validation->set_message('integer', 'El campo %s debe ser un número entero.');

        if ($this->form_validation->run() == FALSE) {
            // Si la validación falla, vuelve a cargar el formulario
            $prestamo_data['clientes'] = $this->Cliente_model->obtener_clientes_activos();
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('prestamos/agregar', $prestamo_data);

            $this->load->view('templates/footer');


        } else {
            // Obtener los datos del formulario
            $cliente_id = $this->input->post('cliente_id');
            $monto = $this->input->post('monto');
            $tasa_interes = $this->input->post('tasa_interes');
            $numero_cuotas = $this->input->post('numero_cuotas');
            $cargo = $this->input->post('cargo');
            $fecha_inicio = $this->input->post('fecha_inicio');
            $fecha_fin = $this->input->post('fecha_fin');
            $descripcion = $this->input->post('descripcion');

            // Iniciar transacción
            $this->db->trans_begin();

            // Registrar el préstamo
            $prestamo_data = array(
                'cliente_id' => $cliente_id,
                'usuario_id' => 1, // Asignar el ID del usuario autenticado
                'monto' => $monto,
                'tasa_interes' => $tasa_interes,
                'numero_cuotas' => $numero_cuotas,
                'cargo' => $cargo,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'estado_prestamo_id' => 1, // Estado "Pendiente"
            );

            $prestamo_id = $this->Prestamo_model->agregar_prestamo($prestamo_data);

            // Registrar el detalle del préstamo
            $detalle_data = array(
                'prestamo_id' => $prestamo_id,
                'descripcion' => $descripcion
            );
            $this->DetallePrestamos_model->agregar_detalle($detalle_data);

            // Registrar las cuotas
            for ($i = 1; $i <= $numero_cuotas; $i++) {
                // Calcular la fecha de pago de cada cuota
                $fecha_pago = date('Y-m-d', strtotime("+$i month", strtotime($fecha_inicio)));

                $cuota_data = array(
                    'prestamo_id' => $prestamo_id,
                    'monto' => $monto / $numero_cuotas,
                    'fecha_pago' => $fecha_pago,
                    'estado_cuota_id' => 1, // Estado "Pendiente"
                );

                $this->Cuotas_model->agregar_cuota($cuota_data);
            }

            // Verificar si la transacción se completa correctamente
            if ($this->db->trans_status() === FALSE) {
                // Si algo falla, hacer rollback
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'No se pudo registrar el préstamo. Inténtelo de nuevo.');
            } else {
                // Si todo es exitoso, hacer commit
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Préstamo registrado exitosamente.');
            }

            redirect('prestamos');
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