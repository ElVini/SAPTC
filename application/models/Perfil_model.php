<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getData($id)
    {
        $get = "SELECT * FROM datosprofesores WHERE idDatosprofesor = ".$id;
        $query = $this->db->query($get);
        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return null;
        }
    }
}
