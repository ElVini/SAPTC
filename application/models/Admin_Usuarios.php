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
}

?>
