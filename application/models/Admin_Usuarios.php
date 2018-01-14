<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Usuarios extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Para la vista de usuarios en Administrador
    //devuelve la consulta sql con los usuarios obtenidos
    public function getUsuarios()
    {
        $usuarios = 'SELECT * FROM datosprofesores';
        $query = $this->db->query($usuarios);
        return $query;
    }

    //Para modificar el estado del profesor
    public function modificarEstado($id)
    {
        $query = $this->db->query('SELECT Estatus FROM datosprofesores WHERE idDatosprofesor = '.$id);
        $e = $query->row();
        if($e->Estatus == 1)
        {
            $this->db->query('UPDATE datosprofesores SET Estatus = 0 WHERE idDatosprofesor = '.$id);
        }
        if($e->Estatus == 0)
        {
            $this->db->query('UPDATE datosprofesores SET Estatus = 1 WHERE idDatosprofesor = '.$id);

        }
    }

    //Para obtener los detalles de un usuario por su id
    public function getUsuario($id)
    {
        $query = $this->db->query('SELECT * FROM datosprofesores WHERE idDatosprofesor='.$id);
        if($query->num_rows() > 0)
            return $query;
        else
            return null;
    }
}

?>
