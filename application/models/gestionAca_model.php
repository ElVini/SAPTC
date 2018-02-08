<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gestionAca_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getGestiones(){
		$this->db->where('Datosprofesores_idDatosprofesor',$this->session->userdata('login'));
		$query = $this->db->get('gestionac');
		return $query;
	}
	public function agregarGestion($data){
		$this->db->set($data);
		$this->db->insert('gestionac');
		redirect(base_url('index.php/User/gestionAcademica'));
	}
	public function modificarGestion($data,$id){
		$this->db->where('idGestionac',$id);
		$this->db->set($data);
		$this->db->update('gestionac');
		redirect(base_url('index.php/User/gestionAcademica'));
	}
	public function deleteGestion($id){
		$this->db->where('idGestionac',$id);
		$this->db->delete('gestionac');
		redirect(base_url('index.php/User/gestionAcademica'));
	}
}
