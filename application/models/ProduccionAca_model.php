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
		echo '<pre>'.var_dump($data).'</pre>';
		$this->db->set($data)->insert('produccionacademica');
	}
}
