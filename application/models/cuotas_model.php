<?php
class Cuotas_model extends CI_Model {

    public function agregar_cuota($data) {
        $this->db->insert('Cuotas', $data);
    }
}
