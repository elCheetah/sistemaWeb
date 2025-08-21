<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro_model extends CI_Model {

    // Obtener todos los cobros activos
    public function obtener_cobros() {
        $this->db->order_by('fecha_cobro', 'DESC');
        $query = $this->db->get('Cobros');
        return $query->result_array();
    }

    // Obtener un cobro por su ID
    public function obtener_cobro_por_id($cobro_id) {
        $query = $this->db->get_where('Cobros', ['cobro_id' => $cobro_id]);
        return $query->row_array();
    }

    // Agregar un nuevo cobro
    public function agregar_cobro($data) {
        return $this->db->insert('Cobros', $data);
    }

    // Actualizar un cobro existente
    public function actualizar_cobro($cobro_id, $data) {
        $this->db->where('cobro_id', $cobro_id);
        return $this->db->update('Cobros', $data);
    }

    // Eliminar un cobro lógicamente (aquí puedes agregar un campo 'estado' en la tabla si quieres manejar eliminación lógica)
    public function eliminar_cobro_logicamente($cobro_id) {
        $this->db->where('cobro_id', $cobro_id);
        return $this->db->delete('Cobros');
    }
}
?>
