<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garante_model extends CI_Model {

    // Obtiene todos los garantes activos (estado = 1)
    public function obtener_garantes_activos() {
        $this->db->where('estado', 1);
        $query = $this->db->get('Garantes');
        return $query->result_array();
    }

    // Obtiene un garante por su ID
    public function obtener_garante_por_id($garante_id) {
        $query = $this->db->get_where('Garantes', ['garante_id' => $garante_id]);
        return $query->row_array();
    }

    // Agrega un nuevo garante
    public function agregar_garante($data) {
        return $this->db->insert('Garantes', $data);
    }

    // Actualiza la información de un garante existente
    public function actualizar_garante($garante_id, $data) {
        $this->db->where('garante_id', $garante_id);
        return $this->db->update('Garantes', $data);
    }

    // Elimina un garante lógicamente (cambia el estado a 0)
    public function eliminar_garante_logicamente($garante_id) {
        $this->db->where('garante_id', $garante_id);
        return $this->db->update('Garantes', ['estado' => 0]);
    }

    // Obtiene todos los garantes inactivos (estado = 0)
    public function obtener_garantes_inactivos() {
        $this->db->where('estado', 0);
        $query = $this->db->get('Garantes');
        return $query->result_array();
    }
    public function habilitar_garante($garante_id) {
        $data = ['estado' => TRUE];
        $this->db->where('garante_id', $garante_id);
        return $this->db->update('garantes', $data);
    }
}
?>
