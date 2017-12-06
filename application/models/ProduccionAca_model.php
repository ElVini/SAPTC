<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProduccionAca_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getData()
    {
        $this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
        $query = $this->db->get('produccionacademica');
		return $query;
    }
	public function agregarProduccion($data)
	{
		if(isset($data['idProduccionacademica'])){
			$this->db->where('idProduccionacademica',$data['idProduccionacademica']);
			$this->db->set($data);
			$this->db->update('produccionacademica');
		}
		//Hago lo mismo que en el controlador
		else if(isset($data['Titulo']))
		{
			$this->db->set($data)->insert('produccionacademica');
		}
		else{
			$this->db->where('idProduccionacademica',$data);
			$this->db->delete('produccionacademica');
		}
        redirect(base_url('index.php/User/produccion_academica'));
	}

    public function getLineasGeneracion()
    {
        $this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
        $query = $this->db->get('lineageneracion');
        return $query;
    }
}
