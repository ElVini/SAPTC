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
		$query = $this->db->query('SELECT * FROM estudiosrealizados WHERE status = 1 AND Datosprofesores_idDatosprofesor = '.$id);
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return null;
		}
	}
	public function getEstudio($id)
	{
		$query = $this->db->query('SELECT * FROM estudiosrealizados WHERE idEstudiosrealizados = '.$id);
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return null;
		}
	}
	public function getInstituciones()
	{
		$query = $this->db->query('SELECT * FROM instituciones');
		return $query;
	}
	public function setInstitucionER($Institucion)
	{
		$dat = array(
			'Nombre' => $Institucion
		);
		$this->db->insert('instituciones', $dat);
	}
	public function insertarEstudioRealizado($data)
	{
		$this->db->insert('estudiosrealizados', $data);
		return $this->db->error();
	}
	public function eliminarEstudioRealizado($id)
	{
		$this -> db -> where('idEstudiosrealizados', $id);
  	$this -> db -> delete('estudiosrealizados');
		return $this->db->error();
	}
}

?>
