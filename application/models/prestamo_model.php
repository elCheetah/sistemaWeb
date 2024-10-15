<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamo_model extends CI_Model
{

    public function obtener_prestamos_activos()
    {
        // $this->db->where('estado_prestamo_id', 1); // Suponiendo que '1' es el ID del estado activo
        $query = $this->db->get('Prestamos');
        return $query->result_array();
    }

    public function obtener_prestamo_por_id($prestamo_id)
    {
        $query = $this->db->get_where('Prestamos', ['prestamo_id' => $prestamo_id]);
        return $query->row_array();
    }


    public function agregar_prestamo($data) {
        $this->db->insert('Prestamos', $data);
        return $this->db->insert_id();  // Retorna el ID del préstamo recién creado
    }

    public function actualizar_prestamo($prestamo_id, $data)
    {
        $this->db->where('prestamo_id', $prestamo_id);
        return $this->db->update('Prestamos', $data);
    }

    public function eliminar_prestamo_logicamente($prestamo_id)
    {
        $this->db->where('prestamo_id', $prestamo_id);
        return $this->db->update('Prestamos', ['estado_prestamo_id' => 0]); // Suponiendo que '0' es el ID del estado inactivo o eliminado
    }

    public function obtener_prestamos_inactivos()
    {
        $this->db->where('estado_prestamo_id', 0); // Suponiendo que '0' es el ID del estado inactivo
        $query = $this->db->get('Prestamos');
        return $query->result_array();
    }

    public function habilitar_prestamo($prestamo_id)
    {
        $this->db->where('prestamo_id', $prestamo_id);
        return $this->db->update('Prestamos', ['estado_prestamo_id' => 1]); // Suponiendo que '1' es el ID del estado activo
    }
    public function obtener_prestamos_con_clientes()
    {
        $this->db->select('p.*, CONCAT(c.nombre, " ", c.primer_apellido, " ", c.segundo_apellido) as cliente_nombre');
        $this->db->from('Prestamos p');
        $this->db->join('Clientes c', 'p.cliente_id = c.cliente_id');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>