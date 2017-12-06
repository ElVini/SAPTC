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
		$this->load->model('ProduccionAca_model');
		$this->load->model('premiosoDistinciones_model');
		$this->load->model('CuerpoAcademico_model');
		$this->load->library(array('session'));
	}
//Inicio
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
// Fin  de inicio
//Tutorías
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
	//Fin de tutorías

//Docencias
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
	//Fin de docencias

	//Estudios Realizados
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
	//Fin de estudios realizados

	//produccion academica - scott
	public function produccion_academica(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['titulo'] = 'SAPTC - Producción Académica';
			$data['query'] = $this->ProduccionAca_model->getData();
			$this->load->view('User/produccion_academica',$data);
		}
	}

	public function produccion_form(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else
		{
			$data['query'] = $this->ProduccionAca_model->getLineasGeneracion();
			$this->load->view('forms/produccion_academica',$data);
		}
	}

	public function addProduccion(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		//tome un valor random para saber si se enviaron todos los elementos es decir, que se quiere modificar o añadir por lo cual requiere todos
		//los elementos
		else if(isset($_POST['Titulo'])){
			$data = array(
			'idProduccionacademica' => isset($_POST['id'])? $_POST['id']: null,
			'Titulo' => $_POST['Titulo'],
			'Ano'=> $_POST['Ano'],
			'Numcitada' => $_POST['Citas'],
			'Tipoproduccion' => $_POST['tipoproduccion'],
			'Numlineasind' => $_POST['Ind'],
			'MiembrosCA' => $_POST['Miembros'],
			'NumlineasCA' => $_POST['CA'],
			'HorasSemanales' => $_POST['Horas'],
			'ParaCA' => $_POST['Para'],
			'Lineageneracion_idLineageneracion' => 1,//$_POST['idAModificar']);
			'Datosprofesores_idDatosprofesor' => $this->session->userdata('login')
			);
			$this->ProduccionAca_model->agregarProduccion($data);
		}
		else
		{
			$id = $_POST['id'];
			$this->ProduccionAca_model->agregarProduccion($id);
		}
	}
	//Fin de producción académica

//Datos profesor
	//Para modificar datos de profesores
	public function datos_profesor()
	{
		$data = array(
			'correo'		=> $this->input->post('nemail'),
			'rfc'			=> $this->input->post('nrfc'),
			'telt'			=> $this->input->post('ntelt'),
			'telc'			=> $this->input->post('ntelc'),
			'telp'			=> $this->input->post('ntelp'),
			'ecivil'		=> $this->input->post('necivil'),
			'id'			=> $this->session->userdata('login')
		);
		$this->Perfil_model->actualizar($data);
		redirect(base_url('index.php/User/Perfil'));
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
						'nombre' 		=> $res->Nombres,
						'apellidop'		=> $res->Primerapellido,
						'apellidom'		=> $res->Segundoapellido,
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
			$data['query'] = $this->Usuario_model->obtenerRecordatorios();
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
			$data['dec']=true;
			$this->load->view('User/form_datoslaborales', $data);
		}
		else
		{
			$data['dec']=null;
			$this->load->view('User/form_datoslaborales', $data);
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
		$data = (object)array('id'=>$id,
													'Cronologia'=>'Contrato Actual',
													'profeid'=>$this->session->userdata('login'));
		$this->datosLaborales_model->contratoactual($data);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	public function contratoprimero()
	{
		$id= $this->uri->segment(3);
		$data = (object)array('id'=>$id,'Cronologia'=>'Primer Contrato','profeid'=>$this->session->userdata('login'));
		$this->datosLaborales_model->contratoprimero($data);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	//Fin de datos Laborales

	// Premios o distinciones
	public function premiosoDisticiones()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else if($this->session->userdata('id') == 2)
		{
			$data['titulo'] = 'SAPTC - Premios o Distinciones';
			$data['datos'] = $this->premiosoDistinciones_model->obtiene($this->session->userdata('login'));
			$data["inst"]=$this->premiosoDistinciones_model->obtienei();
			$this->load->view('User/premiosoDistinciones', $data);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function formu_premios($id)
	{
		$data["inst"]=$this->premiosoDistinciones_model->obtienei();
		if ($id!=0 )
		{
			$data["user"]=$this->premiosoDistinciones_model->tomafila($id);
			$this->load->view('User/formulario_premios', $data);
		}
		else
		{
			$this->load->view('User/formulario_premios', $data);
		}
	}
	public function agregaPremiosoDistinciones()
	{
		if ( $this->input->post('io')==0)
		{ $dato = (object)array('Nombre'=>$this->input->post('oio'));
			$this->premiosoDistinciones_model->insert_ins($dato);
			$inst= $this->premiosoDistinciones_model->tomafilaIns($this->input->post('oio'));
			foreach ($inst as $row ) {}
			$dec = $row->idInstituciones;
		}
		else
		{	$dec = $this->input->post('io');
		}
		$datos = (object)array(
							'Nombre'=>$this->input->post('npd'),
							'Fecha'=>$this->input->post('f'),
							'Otrainstitucion'=>$this->input->post('oio'),
							'Motivo'=>$this->input->post('m'),
							'Datosprofesores_idDatosprofesor'=>$this->session->userdata('login'),
							'Instituciones_idInstituciones'=>$dec);
	$this->premiosoDistinciones_model->insert_data($datos);
	}
	public function agregaInstitucion()
	{
		$data = $this->input->post();
		$datos = (object)array(
						'Nombre'=>$data['ins']
				);
	$this->premiosoDistinciones_model->insert_ins($datos);
	}
	public function deletePremios()
	{
		$id= $this->uri->segment(3);
		$this->premiosoDistinciones_model->delete_data($id);
		redirect(base_url()."index.php/User/premiosoDisticiones");
	}
	public function actualizaPremios($id)
	{	if ( $this->input->post('io')==0)
		{
			$dato = (object)array('Nombre'=>$this->input->post('oio'));
			$this->premiosoDistinciones_model->insert_ins($dato);
			$inst= $this->premiosoDistinciones_model->tomafilaIns($this->input->post('oio'));
			foreach ($inst as $row){
			}
			$dec = $row->idInstituciones;
		}
		else
		{$dec = $this->input->post('io');
		}
		$datos = (object)array(
						'idPremios'=>$id,
						'Nombre'=>$this->input->post('npd'),
						'Fecha'=>$this->input->post('f'),
						'Otrainstitucion'=>$this->input->post('oio'),
						'Motivo'=>$this->input->post('m'),
						'Instituciones_idInstituciones'=>$dec);
		$this->premiosoDistinciones_model->updatePremios($datos);
	}
//fin de premiosoDisticiones

	//Datos del cuerpo académico
	public function cuerpoAcademico(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['titulo'] = 'SAPTC - Cuerpo Académico';
			$data['cuerpoAc'] = $this->CuerpoAcademico_model->obtenerCuerpoAcademico();
			if(is_object($data['cuerpoAc']) && (count(get_object_vars($data['cuerpoAc'])) > 0)){
				$data['cuerpoAcLi'] = $this->CuerpoAcademico_model->obtenerLineaCA($data['cuerpoAc']);
			}

			$this->load->view('User/cuerpoAcademico',$data);
		}
	}

	public function formCuerpoAcademico(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$this->load->view('forms/cuerpoAcademico');
		}
	}

	public function formCuerpoAcademicoA(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['cuerposAcademicos'] = $this->CuerpoAcademico_model->todosCA();
			$this->load->view('forms/cuerpoAcademico2',$data);
		}
	}

	public function modCuerpo(){
		$id = $_POST['idca'];
		$nombre = $_POST['nombre'];
		$grado = $_POST['grado'];
		$clave = $_POST['clave'];
		$this->CuerpoAcademico_model->modificarCuerpo($id,$nombre,$grado,$clave);
		redirect(base_url('index.php/User/cuerpoAcademico'));
	}

	public function elimCuerpo(){
		$this->CuerpoAcademico_model->eliminarCuerpo($this->session->userdata('login'));
		redirect(base_url('index.php/User/cuerpoAcademico'));
	}

	public function unirseCA(){
		$idCA = $_POST['cuerpoAcademicoE'];
		$this->CuerpoAcademico_model->unirseACA($this->session->userdata('login'),$idCA);
		redirect(base_url('index.php/User/cuerpoAcademico'));
	}

	public function agCuerpoN(){
		$nombre = $_POST['nombre'];
		$grado = $_POST['grado'];
		$clave = $_POST['clave'];
		$this->CuerpoAcademico_model->agregarCuerpo($this->session->userdata('login'),$nombre,$grado,$clave);
		redirect(base_url('index.php/User/cuerpoAcademico'));
	}

	public function checarCA(){
		if(isset($_POST['nombre']) || isset($_POST['clave'])){
					$this->CuerpoAcademico_model->chkCA($_POST['nombre'],$_POST['clave']);
		}
	}
//fin de datos del cuerpo academico
}

?>
