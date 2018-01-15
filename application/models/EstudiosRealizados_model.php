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
	public function getRuta($id)
	{
		$query = $this->db->query('SELECT * FROM estudiosrealizados WHERE idEstudiosrealizados = '.$id);;
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return null;
		}
	}
	public function setInstitucionER($Institucion)
	{
		$query = $this->db->query('SELECT Nombre FROM instituciones WHERE Nombre = "'.$Institucion.'"');
		if(count($query->result()) == 0)
		{
			$dat = array(
				'Nombre' => $Institucion
			);
			$this->db->insert('instituciones', $dat);
		}
	}
	public function insertarEstudioRealizado($data)
	{
		$this->db->insert('estudiosrealizados', $data);
		// return $this->db->insert_id();
		$dat = array(
			'error' => $this->db->error(),
			'lastID' => $this->db->insert_id()
		);
		return $dat;
	}
	function cambiarRuta($id,$ruta)
	{

        $dat = array('PDF' => $ruta);
        $this->db->where('idEstudiosrealizados', $id);
        $this->db->update('estudiosrealizados', $dat);
  }
	public function eliminarEstudioRealizado($id)
	{
		$this -> db -> where('idEstudiosrealizados', $id);
  	$this -> db -> delete('estudiosrealizados');
		return $this->db->error();
	}
}

?>
