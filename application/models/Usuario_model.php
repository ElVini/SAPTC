<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function agregar($data)
	{
		if($data['tipo'] == 'Grupal')
		{
			$insert = "INSERT INTO tutoria VALUES('', '".$data['n']."', '".$data['fechaInicio']."', '".$data['fechaFin']."', '".$data['estado']."', '".$data['tipo']."', '".$data['nivel']."', '',  '".$data['programa']."', '".$data['id']."')";
		}
		else if ($data['tipo'] == 'Individual')
		{
			$insert = "INSERT INTO tutoria VALUES('', '1', '".$data['fechaInicio']."', '".$data['fechaFin']."', '".$data['estado']."', '".$data['tipo']."', '".$data['nivel']."', '".$data['n']."',  '".$data['programa']."', '".$data['id']."')";
		}
		$this->db->query($insert);
	}

	public function getTutorias($id)
	{
		$query = $this->db->query('SELECT * FROM tutoria WHERE Datosprofesores_idDatosprofesor = '.$id);
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return null;
		}
	}
	public function eliminarTutoria($id)
	{
		$this->db->query('DELETE FROM tutoria WHERE idTutoria = '.$id);
	}

	public function getTutoria($id)
	{
		$query = $this->db->query("SELECT * FROM tutoria WHERE idTutoria =".$id);
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
