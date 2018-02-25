<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

  	public function getProfesores()
	{
		$this->db->select('idDatosprofesor,Nombres,Primerapellido,Segundoapellido,estudiosrealizados.Nivelestudios,estudiosrealizados.Disciplina');
		$this->db->from('datosprofesores');
		$this->db->join('estudiosrealizados',  'datosprofesores.idDatosprofesor = estudiosrealizados.Datosprofesores_idDatosprofesor', 'INNER');
		$query = $this->db->get();
    	return $query;
	}

	public function mostrar($valor)
	{
		/*$consulta = $this->db->get("datosprofesores");*/
		//AQUI MAS ADELANTE VOY HACER LA CONSULTA PARA EL ENLACE A LAS DOS TABLAS
		$this->db->select('idDatosprofesor,Nombres,Primerapellido,Segundoapellido,estudiosrealizados.Nivelestudios,estudiosrealizados.Disciplina');
		$this->db->from('datosprofesores');
		$this->db->join('estudiosrealizados',  'datosprofesores.idDatosprofesor = estudiosrealizados.Datosprofesores_idDatosprofesor', 'INNER');
		$this->db->like("Nombres",$valor);
		$consulta = $this->db->get();

		return $consulta->result();
		//->result();
	}





}

?>
