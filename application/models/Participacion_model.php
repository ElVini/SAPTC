<?php defined('BASEPATH') OR exit('No direct script access allowed');
  class Participacion_model extends CI_Model
  {
    function __construct()
   	{
   		parent:: __construct();
   		$this->load->database();
   	}
    public function obtieneParticipacion($id)
 	  {
      $this->db->from('participacion');
      $this->db->where('Datosprofesores_idDatosprofesor',$id);
      $this->db->join('grado', 'grado.idGrado = participacion.Grado_idGrado', 'left');
      //$this->db->order_by("Fecha", "ASC");
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
    public function obtieneg()
    {
      $this->db->from('grado');
      $query= $this->db->order_by("nombre", "ASC");
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
    function insert_grado($data)
    {
      $this->db->insert("grado", $data);
      $grado= $this->db->insert_id();
  		return $grado;
    }
    function insert_participacion($data)
    {
      $this->db->insert("participacion", $data);
      $dat= $this->db->insert_id();
  		return $dat;
    }
    function deleteParticipacion($id){
   		$this->db->where("idParticipacion", $id);
   		$this->db->delete("participacion");
   	}
    function updateParticipacion($data)
    {
      $this->db->where('idParticipacion', $data->idParticipacion);
      return $this->db->update('participacion', $data);
    }
    function tomafilaParticipacion($id)
    {
      $this->db->where("idParticipacion", $id);
      return $query= $this->db->get("participacion");
    }
    function cambiarRutaParticipacion($id,$ruta)
  	{
        $dat = array('PDF' => $ruta);
        $this->db->where('idParticipacion', $id);
        $this->db->update('participacion', $dat);
    }
  }
?>
