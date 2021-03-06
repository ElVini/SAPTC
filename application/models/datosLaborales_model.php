<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class DatosLaborales_model extends CI_Model
  {
    function __construct()
   	{
   		parent:: __construct();
   		$this->load->database();
   	}
    public function obtieneDL($id)
 	  {
      $this->db->from('datoslaborales');
      $this->db->where('Datosprofesores_idDatosprofesor',$id);
      //$this->db->order_by("Fechadeiniciocontrato", "ASC");
      $query = $this->db->get();
      if($query->num_rows()>0)
  			return $query;
  		else
  			return null;
    }
    function insert_DL($data)
   	{
   		return $this->db->insert("datoslaborales", $data);
   	}
    function delete_DL($id){
   		$this->db->where("idDatoslaborales", $id);
   		$this->db->delete("datoslaborales");
   	}
    function contratoactual($data)
    {
      $query = $this->db->query('SELECT * FROM datoslaborales WHERE Datosprofesores_idDatosprofesor = '.$data->profeid);
      if ($query->num_rows()==1)
      {
        $this->db->where('Datosprofesores_idDatosprofesor', $data->profeid);
        $this->db->where('idDatoslaborales', $data->id);
        $this->db->set('Cronologia','Primero y actual');
     		return $this->db->update('datoslaborales');
      }
      else {
        $this->db->where('Datosprofesores_idDatosprofesor', $data->profeid);
        $this->db->where('Cronologia', 'Primero y actual');
        $this->db->set('Cronologia','');
        $this->db->update('datoslaborales');
        $this->db->where('Datosprofesores_idDatosprofesor', $data->profeid);
        $this->db->where('Cronologia', 'Contrato Actual');
        $this->db->set('Cronologia','');
        $this->db->update('datoslaborales');
        $this->db->where('idDatoslaborales', $data->id);
        $this->db->set('Cronologia',$data->Cronologia);
     		return $this->db->update('datoslaborales');
      }
    }
    function contratoprimero($data)
    {
      $query = $this->db->query('SELECT * FROM datoslaborales WHERE Datosprofesores_idDatosprofesor = '.$data->profeid);
      if ($query->num_rows()==1)
      {
        $this->db->where('Datosprofesores_idDatosprofesor', $data->profeid);
        $this->db->where('idDatoslaborales', $data->id);
        $this->db->set('Cronologia','Primero y actual');
        return $this->db->update('datoslaborales');
      }
      else {
        $this->db->where('Datosprofesores_idDatosprofesor', $data->profeid);
        $this->db->where('Cronologia', 'Primero y actual');
        $this->db->set('Cronologia','');
        $this->db->update('datoslaborales');
        $this->db->where('Datosprofesores_idDatosprofesor', $data->profeid);
        $this->db->where('Cronologia', 'Primer Contrato');
        $this->db->set('Cronologia','');
        $this->db->update('datoslaborales');
        $this->db->where('idDatoslaborales', $data->id);
        $this->db->set('Cronologia',$data->Cronologia);
        return $this->db->update('datoslaborales');
      }
    }

    function tomafilaDL($id)
    {
      $this->db->where("idDatoslaborales", $id);
   		$query= $this->db->get("datoslaborales");
   		return $query;
    }
    function updateDatoslaborales($data)
    {
      $this->db->where('idDatoslaborales', $data->idDatoslaborales);
   		return $this->db->update('datoslaborales', $data);
    }
  }
?>
