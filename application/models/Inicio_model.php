<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}

	public function login($user, $pass)
	{
		$query = $this->db->query('SELECT * FROM login WHERE Usuario = "'.$user.'"');
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $value)
			{
				if($pass == $value['Password'])
				{
					return $query;
				}
				else
				{
					return null;
				}
			}
		}
	}

	public function getNombre($id)
	{
		$query = $this->db->query('SELECT * FROM datosprofesores WHERE idDatosprofesor ='. $id);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $res)
			{
				$nombre = $res->Nombres . " " . $res->Primerapellido . " " . $res->Segundoapellido;
			}
			return $nombre;
		}
	}

	public function getContra($correo)
	{
		$this->db->where('Usuario',$correo);
		$query = $this->db->get('login');
		if($query->num_rows() > 0){
			foreach($query->result() as $res)
			{
				return md5($res->Password);
			}
		}
		else{
			return false;
		}
	}

	public function verificarEstado($id)
	{
		$query = $this->db->query('SELECT Estatus FROM datosprofesores WHERE idDatosprofesor = '.$id);
		$r = $query->row();
		return $r->Estatus;
	}
}
?>
