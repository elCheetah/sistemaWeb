<?php
class Usuario_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function obtener_usuario_por_id($usuario_id)
    {
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('usuarios');
        return $query->row_array();  // Asegúrate de que esto devuelve un objeto stdClass
    }


    public function agregar_usuario($data)
    {
        return $this->db->insert('usuarios', $data);
    }

    public function obtener_usuario($usuario_id)
    {
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('usuarios');
        return $query->row_array();
    }

    public function editar_usuario($usuario_id, $data)
    {
        $this->db->where('usuario_id', $usuario_id);
        $this->db->update('usuarios', $data);
    }

    public function obtener_usuarios_activos()
    {
        $this->db->where('estado', TRUE);
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }

    public function autenticar($nombre_usuario, $password)
    {
        $this->db->select('usuario_id, nombre, nombre_usuario, primer_apellido, segundo_apellido, imagen, email, telefono, rol');
        $this->db->where('nombre_usuario', $nombre_usuario);
        $this->db->where('password', $password);

        $query = $this->db->get('usuarios');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }



   

    public function eliminar_usuario($usuario_id)
    {
        $data = ['estado' => FALSE];
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('usuarios', $data);
    }

    public function obtener_usuarios_eliminados()
    {
        $this->db->where('estado', FALSE);
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }

    public function habilitar_usuario($usuario_id)
    {
        $data = ['estado' => TRUE];
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('usuarios', $data);
    }



    public function email_exists($email)
    {
        $query = $this->db->get_where('usuarios', ['email' => $email]);
        return $query->num_rows() > 0;
    }
}
?>