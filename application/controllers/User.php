<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//hola Chuy
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->library(array('session'));
	}

	public function index()
	{
		if($this->session->userdata('tipo') !='2')
		{
			redirect(base_url());
		}
		$data['titulo'] = 'SAPTC - Inicio';
		$data['query'] = $this->Usuario_model->obtenerRecordatorios();
		$this->load->view('User/inicio',$data);
	}
	public function funcionRecordatorio()
	{
		//primer parametro de la funcion para identificar si se va agregar o editar valor
		// -1 para agregar
		// cualquier otro valor para modificar

		//ultimo parametro de la funcion define funcionalidad
		// 0 - agregar/Modificar
		// 1 - eliminar
		if(isset($_POST['idrecordatorios']) && $_POST['idrecordatorios']==""){
				$this->Usuario_model->funcionesRecordatorios(-1, $_POST['date'], $_POST['title'], $_POST['description'], 0);
		}
		else if(isset($_POST['idAborrar'])) {
			$id = $_POST['idAborrar'];
			$funcion = 1; //eliminar
			$this->Usuario_model->funcionesRecordatorios($id, "" , "", "", $funcion);
		}
		else{
			$id = $_POST['idrecordatorios'];
			$this->Usuario_model->funcionesRecordatorios($id, $_POST['date'], $_POST['title'], $_POST['description'], 0);
		}

		redirect(base_url());
	}

	public function tutorias()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else if($this->session->userdata('id') == 2)
		{
			$data['tutorias'] = $this->Usuario_model->getTutorias($this->session->userdata('login'));
			$data['titulo'] = 'SAPTC - Tutorías';
			$this->load->view('User/tutorias', $data);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function agregarTutoria()
	{
		$data = array(
			'nivel'       => $this->input->post('nivel'),
			'programa'    => $this->input->post('programa'),
			'tipo'		  => $this->input->post('tipo'),
			'n'			  => $this->input->post('n'),
			'fechaInicio' => $this->input->post('fechaInicio'),
			'fechaFin'    => $this->input->post('fechaFin'),
			'estado'	  => $this->input->post('estado'),
			'id'		  => $this->session->userdata('login')
		);
		$this->Usuario_model->agregar($data);
		redirect(base_url('index.php/User/tutorias'));
	}
	public function eliminarTutoria()
	{
		$this->Usuario_model->eliminarTutoria($this->input->get('id'));
		redirect(base_url('index.php/User/tutorias'));
	}

	public function getData()
	{
		$query = $this->Usuario_model->getTutoria($this->input->get('id'));
		foreach ($query->result() as $res)
		{
			$data = array(
				'nivel'       => $res->Nivelestudios,
				'programa'    => $res->Programaeducativo,
				'tipo'		  => $res->Tipo,
				'fechaInicio' => $res->Fechainicio,
				'fechaFin'    => $res->Fechafin,
				'estado'	  => $res->Estado,
				'id'		  => $res->idTutoria
			);
			/**
			* La variable 'n' cambia dependiendo del tipo de tutoría
			* es decir, si la tutoría es grupal toma el valor del número
			* de alumnos, si es individual, toma el valor del nombre
			* del alumno
			*/
			if($res->Noestudiantes == '1')
			{
				$data['n'] = $res->Grupoalumnos;
			}
			else
			{
				$data['n'] = $res->Noestudiantes;
			}
		}
		$this->load->view('User/Helpers/modTut', $data);
	}

	public function modificarTutoria()
	{
		$data = array(
			'nivel' 		=> $this->input->post('nivel'),
			'programa'		=> $this->input->post('programa'),
			'tipo'			=> $this->input->post('tipo'),
			'n'				=> $this->input->post('n'),
			'fechaInicio'	=> $this->input->post('fechaInicio'),
			'fechaFin'		=> $this->input->post('fechaFin'),
			'estado'		=> $this->input->post('estado')
		);
		$this->Usuario_model->modificarTutoria($this->input->post('id'), $data);
	}

	public function docencias()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else if($this->session->userdata('id') == 2)
		{
			$data['titulo'] = 'SAPTC - Docencias';
			$this->load->view('User/docencais', $data);
		}
		else
		{
			redirect(base_url());
		}
	}
}

?>
