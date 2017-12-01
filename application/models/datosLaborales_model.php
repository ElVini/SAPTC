<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class DatosLaborales_model extends CI_Model
  {
    function __construct()
   	{
   		parent:: __construct();
   		$this->load->database();
   	}
    public function obtiene($id)
 	  {
      $query = $this->db->query('SELECT * FROM datoslaborales WHERE Datosprofesores_idDatosprofesor = '.$id);
      if($query->num_rows()>0)
  		{
  			return $query;
  		}
  		else
  		{
  			return null;
  		}
    }
    function insert_data($data)
   	{
   		return $this->db->insert("datoslaborales", $data);
   	}
    function delete_data($id){
   		$this->db->where("idDatoslaborales", $id);
   		$this->db->delete("datoslaborales");
   	}
    function contratoactual($data)
    {
      $this->db->where('idDatoslaborales', $data->id);
      $this->db->set('Cronologia',$data->Cronologia);
   		return $this->db->update('datoslaborales');
    }
    function contratoprimero($data)
    {
      $this->db->where('idDatoslaborales', $data->id);
      $this->db->set('Cronologia',$data->Cronologia);
      return $this->db->update('datoslaborales');
    }

    function tomafila($id)
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
