<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstudiosRealizados_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getEstudios($id)
	{
		$query = $this->db->query('SELECT * FROM estudiosrealizados WHERE Datosprofesores_idDatosprofesor = '.$id);
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

?>
