<?php
class DetallePrestamos_model extends CI_Model {

    public function agregar_detalle($data) {
        $this->db->insert('DetallePrestamos', $data);
    }
}
