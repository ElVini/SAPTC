<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//hola Chuy
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->model('datosLaborales_model');
		$this->load->model('EstudiosRealizados_model');
		$this->load->model('Perfil_model');
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

	public function estudiosRealizados()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}

		$idERUser = $this->session->userdata('login');
		$data['estudios'] = $this->EstudiosRealizados_model->getEstudios(/*$idERUser*/2);
		$data['titulo'] = 'SAPTC - Estudios Realizados';
		$this->load->view('User/estudiosRealizados', $data);
	}

	public function perfil()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else
		{
			$datos = $this->Perfil_model->getData($this->session->userdata('login'));
			if($datos != null)
			{
				foreach($datos->result() as $res)
				{
					$data = array(
						'nombre' 		=> $res->Nombres.' '.$res->Primerapellido.' '.$res->Segundoapellido,
						'curp' 			=> $res->Curp,
						'rfc' 			=> $res->RFC,
						'sexo' 			=> $res->Sexo,
						'nacimiento' 	=> $res->Fechanacimiento,
						'nacionalidad' 	=> $res->Nacionalidad,
						'enacimiento' 	=> $res->Estadodenacimiento,
						'ecivil' 		=> $res->Estadocivil,
						'correo' 		=> $res->Correo,
						'telefonot' 	=> $res->TelefonoTrabajo,
						'telefonoc' 	=> $res->TelefonoCasa,
						'img' 			=> $res->foto,
						'telefonop' 	=> $res->TelefonoPersonal

					);
				}
			}
			$data['titulo'] = 'SAPTC - Perfil maestro';
			$this->load->view('User/Perfil', $data);
		}
	}
	// Datos laborales
	public function datosLaborales()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else if($this->session->userdata('id') == 2)
		{
			$data['titulo'] = 'SAPTC - Datos Laborales';
			$data['datos'] = $this->datosLaborales_model->obtiene($this->session->userdata('login'));
			$data['loginid']= $this->session->userdata('login');
			$this->load->view('User/datosLaborales', $data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function form_datoslaborales($id)
	{
		if ($id!=0 )
		{
			$data["user"]=$this->datosLaborales_model->tomafila($id);
			$this->load->view('User/form_datoslaborales', $data);
		}
		else
		{
			$this->load->view('User/form_datoslaborales');
		}
	}
	public function agregaDatosLaborales()
	{
		$data = $this->input->post();
    $datos = (object)array(
				'idDatoslaborales'=>'',
		        'Nombramiento'=>$data['nom'],
		        'Fechadeiniciocontrato'=>$data['fecha_init'],
		        'Fechafincontrato'=>$data['fecha_fin'],
		        'Tipo'=>$data['tipo_nom'],
				'Dedicacion'=>$data['dedicacion'],
				'NombreDependencia'=>$data['dependencia'],
				'Unidadacademica'=>$data['unidad'],
				'Cronologia'=>'',
				'Datosprofesores_idDatosprofesor'=>$data['profe']
        );
	$this->datosLaborales_model->insert_data($datos);
	}
	public function actualizaDatosLaborales()
	{
		$data = $this->input->post();
    $datos = (object)array(
				'idDatoslaborales'=>$data['id_d'],
		        'Nombramiento'=>$data['nom'],
		        'Fechadeiniciocontrato'=>$data['fecha_init'],
		        'Fechafincontrato'=>$data['fecha_fin'],
		        'Tipo'=>$data['tipo_nom'],
				'Dedicacion'=>$data['dedicacion'],
				'NombreDependencia'=>$data['dependencia'],
				'Unidadacademica'=>$data['unidad'],
				'Datosprofesores_idDatosprofesor'=>$data['profe']
        );
	$this->datosLaborales_model->updateDatoslaborales($datos);
	}
	public function deleteDatol()
	{
		$id= $this->uri->segment(3);
		$this->datosLaborales_model->delete_data($id);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	public function contratoactual()
	{
		$id= $this->uri->segment(3);
		$data = (object)array('id'=>$id,'Cronologia'=>'Contrato Actual');
		$this->datosLaborales_model->contratoactual($data);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	public function contratoprimero()
	{
		$id= $this->uri->segment(3);
		$data = (object)array('id'=>$id,'Cronologia'=>'Primer Contrato');
		$this->datosLaborales_model->contratoprimero($data);
		redirect(base_url()."index.php/User/datosLaborales");
	}

}

?>
