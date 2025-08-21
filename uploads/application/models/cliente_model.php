<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_model extends CI_Model
{

    public function obtener_clientes_activos()
    {
        $this->db->where('estado', 1);
        $query = $this->db->get('Clientes');
        return $query->result_array();
    }
    public function obtener_cliente_por_id($cliente_id)
    {
        $this->db->select('c.*, g1.nombre as garante_nombre, g1.primer_apellido as garante_primer_apellido, g1.segundo_apellido as garante_segundo_apellido, 
                       g2.nombre as segundo_garante_nombre, g2.primer_apellido as segundo_garante_primer_apellido, g2.segundo_apellido as segundo_garante_segundo_apellido');
        $this->db->from('Clientes c');
        $this->db->join('Garantes g1', 'c.primer_garante_id = g1.garante_id', 'left');
        $this->db->join('Garantes g2', 'c.segundo_garante_id = g2.garante_id', 'left');
        $this->db->where('c.cliente_id', $cliente_id);
        $query = $this->db->get();
        return $query->row_array();
    }


    

    public function agregar_cliente($data)
    {
        return $this->db->insert('Clientes', $data);  // Asegúrate de que 'Clientes' es el nombre correcto de la tabla
    }


    public function actualizar_cliente($cliente_id, $data)
    {
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('Clientes', $data);
    }

    public function eliminar_cliente_logicamente($cliente_id)
    {
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('Clientes', ['estado' => 0]);
    }

    public function obtener_clientes_inactivos()
    {
        $this->db->where('estado', 0);
        $query = $this->db->get('Clientes');
        return $query->result_array();
    }
    public function habilitar_cliente($cliente_id)
    {
        $data = ['estado' => TRUE];
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('clientes', $data);
    }

}
?>