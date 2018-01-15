<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProduccionAca_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	//obtiene las producciones del profesor
    public function getData()
    {
        $this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
		$query = $this->db->get('produccionacademica');
		return $query;
    }

	//obtiene las lineas individuales que tienen las producciones
	public function getLineas(){
		$this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
		$query = $this->db->get('produccionacademica')->result();
		$query2=[];
		foreach ($query as $query) {
			$this->db->where('id_produccion_academica',$query->idProduccionacademica);
			$query2[] = $this->db->get('produccion_lineas')->result();
		}
		return $query2;
	}

	//busca si es miembro de algun cuerpo academico y lo retorna
	public function getCA()
	{
		$this->db->where('id_profesor',$this->session->userdata('login'));
		$query = $this->db->get('cuerpoacademico_miembros');
		return $query->row();
	}
	//obtiene todos los miembros del cuerpo academico actual
	public function getMiembros($id_ca)
	{
		$this->db->where('id_cuerpoacademico',$id_ca->id_cuerpoacademico);
		$this->db->where('id_profesor !=',$this->session->userdata('login'));
		$query = $this->db->get('cuerpoacademico_miembros');

		foreach ($query->result() as $idProfesor) {
			$this->db->where('idDatosprofesor',$idProfesor->id_profesor);
			$array[] = $this->db->get('datosprofesores')->result();
		}
		return $array;
	}
	//esta función funciona para agregar y modificar los registros
	public function agregModProduccion($data,$lgacInd)
	{
        if($data['idProduccionacademica'] != null && $data['Titulo'] != "") {
			$this->db->where('idProduccionacademica',$data['idProduccionacademica']);
			$this->db->set($data);
			$this->db->update('produccionacademica');
		}
		//Hago lo mismo que en el controlador
		else if($data['idProduccionacademica'] == null)
		{
			$this->db->set($data)->insert('produccionacademica');
			$lastId = $this->db->insert_id();
			for ($i=0; $i < count($lgacInd); $i++) {
				$this->db->set('id_lineageneracion',$lgacInd[$i]);
				$this->db->set('id_produccion_academica',$lastId);
				$this->db->insert('produccion_lineas');
			}
		}
        redirect(base_url('index.php/User/produccion_academica'));
	}

	public function eliminarProduccion($id)
	{
		$this->db->where('idProduccionacademica',$id);
		$this->db->delete('produccionacademica');

		$this->db->where('id_produccion_academica',$id);
		$this->db->delete('produccion_lineas');

		$this->db->where('id_produccion', $id);
		$citas = $this->db->get('citas_produccion')->result();

		foreach ($citas as $cita) {
			$this->db->where('idCita',$cita->id_cita);
			$this->db->delete('cita');
		}

		$this->db->where('id_produccion',$id);
		$this->db->delete('citas_produccion');

		redirect(base_url('index.php/User/produccion_academica'));
	}
	//función para obtener linea de generación del cuerpo acádemico
    public function getLineasGeneracionCA($id_ca)
    {
		//id_ca trae la información del cuerpo academico al que pertenece
		//asi que se consulta dentro de la tabla del cuerpo academico para obtener
		//el id de la linea de generación
		$this->db->where('idCuerpoacademico',$id_ca->id_cuerpoacademico);
        $query = $this->db->get('cuerpoacademico');
		//Se consulta el id obtenido previamente para obtener el nombre
		$this->db->where('idLineageneracion',$query->row()->Lineageneracion_idLineageneracion);
		$query = $this->db->get('lineageneracion');
		return $query->row(); //se retorna el registro encontrado
    }
	//función que obtiene los miembros especificos de la produccion academica para mostrarlos en los detalles
	public function getMiembrosProduccion($miembros){
		$miembros = explode(",",$miembros);
		$MiembrosCA=[];
		foreach ($miembros as $miembro) {
			$this->db->where('idDatosprofesor',$miembro);
			$MiembrosCA[]=$this->db->get('datosprofesores')->row();
		}
		return $MiembrosCA;
	}
	//función que obtiene las lineas especificas de la produccion academica para mostrarlos en los detalles
	public function getLineasInd($lineas){
		$lineas = explode(",",$lineas);
		$lineasInd = [];
		foreach ($lineas as $linea) {
			$this->db->where('idLineageneracion',$linea);
			$lineasInd[] = $this->db->get('lineageneracion')->row();
		}
		return $lineasInd;
	}
	//función para retonar todas las lineas individuales
	public function getLineasGeneracion()
    {
        $this->db->where('Datosprofesores_idDatosprofesor', $this->session->userdata('login'));
		$this->db->order_by('Nombre','asc');
        $query = $this->db->get('lineageneracion');
        return $query;
    }
	//función para obtener las citas
	//si función es 1 es mandado llamar desde agregar/editar/eliminar cita(funciona para imprimir los datos por ajax)
	public function getCitas($idProd,$funcion){
		$this->db->where('id_produccion', $idProd);
		$citas = $this->db->get('citas_produccion')->result();
		$arrayCitas=[];
		foreach ($citas as $cita) {
			$this->db->where('idCita',$cita->id_cita);
			$arrayCitas[]=$this->db->get('cita')->row();
		}
		if($funcion==1){
			foreach ($arrayCitas as $cita){
				echo '<tr>
						<td hidden>'.$cita->idCita.'</td>
						<td>'.$cita->Nombrepublicacion.'</td>
						<td>'.$cita->Tipoproduccion.'</td>
						<td>'.$cita->Ano.'</td>
						<td>'.$cita->Infadicional.'</td>
					 </tr>';
				 }
		}
		return $arrayCitas;
	}
	//sirve para agregar citas
	public function addCita($data,$idProd){
		$this->db->set($data);
		$this->db->insert('cita');

		$this->db->set('id_cita',$this->db->insert_id());
		$this->db->set('id_produccion',$idProd);
		$this->db->insert('citas_produccion');
		$this->getCitas($idProd,1);
	}

	public function editCita($data,$idProd,$idCita){
		$this->db->where('idCita',$idCita);
		$this->db->set($data);
		$this->db->update('cita');

		$this->getCitas($idProd,1);
	}

	public function deleteCita($idCita,$idProd){
		$this->db->where('idCita',$idCita);
		$this->db->delete('cita');

		$this->db->where('id_cita',$idCita);
		$this->db->delete('citas_produccion');

		$this->getCitas($idProd,1);
	}
}
