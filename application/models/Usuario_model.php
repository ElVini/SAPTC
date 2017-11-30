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

<<<<<<< HEAD
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
=======
	public function obtenerRecordatorios(){
		$this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
		$query = $this->db->get('recordatorios');
		return $query->result();
	}

	public function funcionesRecordatorios($idrecordatorios,$fecha,$titulo,$descripcion,$funcion){
		if($funcion!=1){
			$this->db->set('Titulo',$titulo);
			$this->db->set('Descripcion',$descripcion);
			$this->db->set('Dia',$fecha);
			//agregar
			if($idrecordatorios == -1){
				$this->db->set('Datosprofesores_idDatosprofesor',$this->session->userdata('login'));
				$resultado = $this->db->insert('recordatorios');
			}
			//modificar
			else{
				$this->db->where('idRecordatorios',$idrecordatorios);
				$resultado = $this->db->update('recordatorios');
			}
			if(!$resultado)
			{
				echo "No se pudo agregar correctamente este registro";
			}
		}
		//eliminar
		else{
			$this->db->where('idrecordatorios',$idrecordatorios);
			$this->db->delete('recordatorios');
>>>>>>> dc80d7dd919dd61e79b122969ed0054331ae37cb
		}
	}
}

?>
