<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LineaGeneracion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function ObtenerLineas()
    {
        $this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
        $query = $this->db->get('lineageneracion');
		return $query;
    }

    function modificarlinea($data){  
        $this->db->set('Nombre', $data->Nombre);
        $this->db->set('Actividades',$data->Actividades);
        $this->db->set('HorasSemana',$data->HorasSemana);
        $this->db->where('idLineageneracion', $data->idLineageneracion);
        return $this->db->update('lineageneracion');  
    }

    public function BuscarLineas($nombre){
        $this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
        $this->db->where('Nombre', $nombre);
        $query = $this->db->get('lineageneracion');
        return $query;
    }

    function agregarLinea($data){  
        return $this->db->insert('lineageneracion',$data);  
    }

    function eliminarlinea($data){
        $this->db->where("idLineageneracion", $data->idLineageneracion);
        $this->db->delete("lineageneracion");
    }
}
