<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docencia_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}

  public function obtenerDocencias(){
    $this->db->where("Datosprofesores_idDatosprofesor",$this->session->userdata('login'));
    return $this->db->get('docencias');
  }

  public function obtenerDependencia(){
    return $this->db->get('instituciones');
  }

	public function agreDocencica($nombre, $pre, $fei, $noa, $dus, $ham, $hos, $np){
		if(!is_numeric($np)){
			$this->db->set('Nombre', $np);
			$this->db->insert('instituciones');
			if($this->db->affected_rows()>0){
				$this->db->where('Nombre', $np);
				$query =  $this->db->get('instituciones');
				foreach ($query->result() as $q) {
					$idDep = $q->idInstituciones;
				}
			}
			$this->db->set('NombreDependencia', $idDep);
		}
		else{
				$this->db->set('NombreDependencia', $np);
		}
		$this->db->set('Nombre', $nombre);
		$this->db->set('Duracionsem', $dus);
		$this->db->set('Fechainicio', $fei);
		$this->db->set('Horasasesoriamensual', $ham);
		$this->db->set('Horassemanales', $hos);
		$this->db->set('Numerodealumnos', $noa);
		$this->db->set('Programaeducativo', $pre);
		$this->db->set('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
		$this->db->insert('docencias');
	}

	public function modDocencica($id,$nombre, $pre, $fei, $noa, $dus, $ham, $hos, $np){
		if(!is_numeric($np)){
			$this->db->set('Nombre', $np);
			$this->db->insert('instituciones');
			if($this->db->affected_rows()>0){
				$this->db->where('Nombre', $np);
				$query =  $this->db->get('instituciones');
				foreach ($query->result() as $q) {
					$idDep = $q->idInstituciones;
				}
			}
			$np = $idDep;
		}
		$data = array(
               'Nombre' => $nombre,
               'Duracionsem' => $dus,
               'Fechainicio' => $fei,
							 'Horasasesoriamensual' => $ham,
							 'Horassemanales' => $hos,
							 'Numerodealumnos' => $noa,
							 'Programaeducativo' => $pre,
							 'NombreDependencia' => $np,
            );
		$this->db->where('idDocencias', $id);
		$this->db->update('docencias', $data);
	}

	public function elimiDocencica($id){
		$this->db->where('idDocencias', $id);
		$this->db->delete('docencias');
	}

}
?>
