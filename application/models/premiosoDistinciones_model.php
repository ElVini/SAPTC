<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class PremiosoDistinciones_model extends CI_Model
  {
    function __construct()
   	{
   		parent:: __construct();
   		$this->load->database();
   	}
    public function obtiene($id)
 	  {
      $query = $this->db->query('SELECT * FROM premios WHERE Datosprofesores_idDatosprofesor = '.$id);
      if($query->num_rows()>0)
  		{
  			return $query;
  		}
  		else
  		{
  			return null;
  		}
    }
    public function obtienei()
    {
      $query = $this->db->query('SELECT * FROM instituciones');
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
      return $this->db->insert("premios", $data);
    }
    function delete_data($id){
   		$this->db->where("idPremios", $id);
   		$this->db->delete("premios");
   	}
    function updatePremios($data)
    {
      $this->db->where('idPremios', $data->idPremios);
   		return $this->db->update('premios', $data);
    }
    function tomafila($id)
    {
      $this->db->where("idPremios", $id);
      return $query= $this->db->get("premios");
    }
    function insert_ins($data)
    {
      return $this->db->insert("instituciones", $data);
    }

  }
?>
