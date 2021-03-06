<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CuerpoAcademico_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

  public function todosCA(){
      return $this->db->get('cuerpoacademico');
  }

  public function obtenerCuerpoAcademico(){
    $this->db->where('id_profesor',$this->session->userdata('login'));
    $query = $this->db->get('cuerpoacademico_miembros');
    if(count($query->result()) > 0){
      foreach ($query->result() as $c ) { }
      $this->db->where('idCuerpoacademico', $c->id_cuerpoacademico);
      return $this->db->get('cuerpoacademico');
    }
  }

  public function obtenerLineaCA($cuerpoa){
    foreach ($cuerpoa->result() as $c) {}

    $this->db->where('idLineageneracion',$c->Lineageneracion_idLineageneracion);
    return $this->db->get('lineageneracion');
  }

    public function modificarCuerpo($id,$nombre,$grado,$clave){
      $data = array(
               'Nombre' => $nombre,
               'Grado' => $grado,
               'Clave' => $clave
            );

      $this->db->where('idCuerpoacademico', $id);
      $this->db->update('cuerpoacademico', $data);
    }

    public function eliminarCuerpo($id){
      $this->db->where('id_profesor', $id);
      $this->db->delete('cuerpoacademico_miembros');
    }

    public function unirseACA($idpro,$idCA){
      $this->db->set('id_profesor', $idpro);
      $this->db->set('id_cuerpoacademico', $idCA);
      $this->db->insert('cuerpoacademico_miembros');
    }

    public function agregarCuerpo($idp,$nombre,$grado,$clave){
      $this->db->set('Nombre', $nombre);
      $this->db->set('Grado', $grado);
      $this->db->set('Clave', $clave);
      $this->db->insert('cuerpoacademico');

      if($this->db->affected_rows()>0){
        $this->db->where('Nombre', $nombre);
        $this->db->where('Grado', $grado);
        $this->db->where('Clave', $clave);
        $query =  $this->db->get('cuerpoacademico');
        foreach ($query->result() as $q) {
          $insert_id = $q->idCuerpoacademico;
        }
      }
      $this->db->set('id_profesor', $idp);
      $this->db->set('id_cuerpoacademico', $insert_id);
      $this->db->insert('cuerpoacademico_miembros');
    }

		public function chkCA($nombre, $clave, $accion){
			//agregar
			if($accion == 2){
				$a=1;
				$this->db->where('Nombre', $nombre);
				$query1 =  $this->db->get('cuerpoacademico');
				foreach ($query1->result() as $q1) {
					echo "1";
					$a=0;
				}

				$this->db->where('Clave', $clave);
				$query2 =  $this->db->get('cuerpoacademico');
				foreach ($query2->result() as $q2) {
					echo "2";
					$a=0;
				}
				if($a==1){
					echo "a";
				}
			}

			//modificar
			if($accion == 1){
				$a=1;
				if($nombre != "0"){
					$this->db->where('Nombre', $nombre);
					$query3 =  $this->db->get('cuerpoacademico');
					foreach ($query3->result() as $q3) {
						echo "1";
						$a=0;
					}
				}

				if ($clave != "0") {
					$this->db->where('Clave', $clave);
					$query4 =  $this->db->get('cuerpoacademico');
					foreach ($query4->result() as $q4) {
						echo "2";
						$a=0;
					}
				}
				if($a==1){
					echo " a";
				}
			}

		}
}

?>
