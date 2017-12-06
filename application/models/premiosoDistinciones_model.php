<?php defined('BASEPATH') OR exit('No direct script access allowed');
  class PremiosoDistinciones_model extends CI_Model
  {
    function __construct()
   	{
   		parent:: __construct();
   		$this->load->database();
   	}
    public function obtiene($id)
 	  {
      $this->db->from('premios');
      $this->db->where('Datosprofesores_idDatosprofesor',$id);
      $this->db->order_by("Fecha", "ASC");
      $query = $this->db->get();
      if($query->num_rows()>0)
  		{
  			return $query->result();
  		}
  		else
  		{
  			return null;
  		}
    }
    public function obtienei()
    {
      $this->db->from('instituciones');
      $query= $this->db->order_by("Nombre", "ASC");
      $query = $this->db->get();
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
    function tomafilaIns($nombre)
    {
      $this->db->where("Nombre", $nombre);
      $query= $this->db->get("instituciones");
      return $query->result();
    }

  }
?>
