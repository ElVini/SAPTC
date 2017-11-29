<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicio extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
}
?>
