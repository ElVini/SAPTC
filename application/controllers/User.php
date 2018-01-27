<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//hola Chuy
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->model('DatosLaborales_model');
		$this->load->model('EstudiosRealizados_model');
		$this->load->model('Perfil_model');
		$this->load->model('ProduccionAca_model');
		$this->load->model('PremiosoDistinciones_model');
		$this->load->model('CuerpoAcademico_model');
		$this->load->model('Docencia_model');
		$this->load->model('LineaGeneracion_model');
		$this->load->model('Inicio_model');
		$this->load->model('Publico_model');
		$this->load->model('Participacion_model');
		$this->load->library(array('session'));
	}

	/**
	* Función que verificará que el usuario no halla sido dado de baja mientras su sesión
	* estaba activa, si la cuenta del usuario es desactivada mientras está ingresado en
	* el sistema, éste cerrará su sesión automaticamente y notificará sobre esto al usuario.
	* Debe mandarse llamar por primera vez al inicio de cada nueva función que se declare,
	* y validar que la sesión siga disponible o no.
	* Retorna un valor true si el perfil ha sido desactivado.
	* La función es privada debido a que sólo será utilizada dentro de este controlador
	*/
	private function acceso($id)
	{
		if($this->Inicio_model->verificarEstado($id) == 0)
		{
			$this->load->view('errors/error');
			$this->session->sess_destroy();
			redirect(base_url());
			return true;
		}
	}
//Inicio
	public function index()
	{
		if($this->acceso($this->session->userdata('login')));
		else
		{
			if($this->session->userdata('tipo') !='2')
			{
				redirect(base_url());
			}
			$data['titulo'] = 'SAPTC - Inicio';
			$data['query'] = $this->Usuario_model->obtenerRecordatorios();
			$this->load->view('User/inicio',$data);
		}
	}
	public function funcionRecordatorio()
	{
		//primer parametro de la funcion para identificar si se va agregar o editar valor
		// -1 para agregar
		// cualquier otro valor para modificar

		//ultimo parametro de la funcion define funcionalidad
		// 0 - agregar/Modificar
		// 1 - eliminar
		if($this->acceso($this->session->userdata('login')));
		else
		{
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
	}

	//VISTA PUBLICA
	public function publico(){

		$result = $this->Publico_model->getProfesores();
		$data = array('consulta'=>$result);
		$this->load->view('Public/publico_view',$data);
	}

	public function	mostrar(){
		if($this->input->is_ajax_request()) {
			$buscar = $this->input->post("buscar");
			$datos = $this->Publico_model->mostrar($buscar);
			echo json_encode($datos);
		}
		else{
			show_404();
		}
	}
// Fin  de inicio
//Tutorías
	public function tutorias()
	{
		if($this->acceso($this->session->userdata('login')));
		else
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
		if($this->acceso($this->session->userdata('login')));
		else
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
	//Fin de docencias

	//Estudios Realizados
	public function estudiosRealizados()
	{
		if($this->acceso($this->session->userdata('login')));
		else
		{
			if($this->session->userdata('id') != 2)
			{
				redirect(base_url());
			}

			$idERUser = $this->session->userdata('login');
			$data['estudios'] = $this->EstudiosRealizados_model->getEstudios($idERUser);
			$data['titulo'] = 'SAPTC - Estudios Realizados';
			$this->load->view('User/estudiosRealizados', $data);
		}
	}
	public function ERform($id,$disabled)
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		if($id > 0)
		{
			$data['datos'] = $this->EstudiosRealizados_model->getEstudio($id);
			$data['datos'] = $data['datos']->result()[0];
		}
		else {
			$data['datos'] = null;
		}
		$data['instituciones'] = $this->EstudiosRealizados_model->getInstituciones();
		if($disabled == 1)
		{
			$data['disabled'] = 1;
		}else {
			$data['disabled'] = 0;
		}
		$this->load->view('forms/estudiosRealizados', $data);
	}
	public function ERAgregar()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		$datos = $this->input->post();

		// print_r($datos);

		$nombreDoc = $_FILES['PDFInputModal']['name'];
	  $tamDoc = $_FILES['PDFInputModal']['size'];
	  $tipoDoc = $_FILES['PDFInputModal']['type'];
	  $tmpDoc = $_FILES['PDFInputModal']['tmp_name'];
	  $errorDoc = $_FILES['PDFInputModal']['error'];
	  $extensionDoc = strtolower(substr($nombreDoc,strpos($nombreDoc,'.')+1));


		$idProfesor = $this->session->userdata('login');

		if(isset($datos['estadoER']) && $datos['estadoER'] == 'Obtenido')
		{
				if(isset($nombreDoc))
				{
						if(
							($extensionDoc == 'pdf' || $extensionDoc == 'png' || $extensionDoc == 'jpeg' || $extensionDoc == 'jpg')
							&& ($tipoDoc == 'application/pdf' || $tipoDoc == 'image/jpeg' || $tipoDoc == 'image/png')
						)
						{
							if(
									isset($datos['nivel']) &&
									isset($datos['siglas']) &&
									isset($datos['estudiosen']) &&
									isset($datos['area']) &&
									isset($datos['disciplina']) &&
									isset($datos['otrainstit']) &&
									isset($datos['BInstit']) &&
									isset($datos['fechainicio']) &&
									isset($datos['fechafin']) &&
									isset($datos['fechaobt']) &&
									isset($datos['pais'])
							){
										//Se inserta la institucion en la tabla instit

										$instit = '';
										$noinstit = '';

										if($datos['BInstit'] == 1)
										{
											$instit = 'Otra';
											$noinstit = $datos['otrainstit'];
											$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
										}
										if($datos['BInstit'] == 0)
										{
											$instit = $datos['otrainstit'];
											$noinstit = '';
										}
										$dats = (object)array(
											'Nivelestudios' => $datos['nivel'],
											'Siglas' => $datos['siglas'],
											'Estudiosen' => $datos['estudiosen'],
											'Area' => $datos['area'],
											'Disciplina' => $datos['disciplina'],
											'Institucionnoconsiderada' => $noinstit,
											'Institucion' => $instit,
											'EstadoEstudio' => $datos['estadoER'],
											'Fechadeinicio' => $datos['fechainicio'],
											'Fechadefin' => $datos['fechafin'],
											'Fechadeobtencion' => $datos['fechaobt'],
											'Pais' => $datos['pais'],
											'Datosprofesores_idDatosprofesor' => $idProfesor,
											'PDF' => null,
											'status' => 1
										);
										$arreglo = $this->EstudiosRealizados_model->insertarEstudioRealizado($dats);
										if($arreglo['error']['message'] == '')
										{
											//si no hubo error al insertar el estudio
											//se sube el documento
											//crear carpeta
											if(!is_dir('assets/documentos/EstudiosRealizados/'.$idProfesor))
											 	mkdir('assets/documentos/EstudiosRealizados/'.$idProfesor, 0777, TRUE);

											$ubicaDoc = 'assets/documentos/EstudiosRealizados/'.$idProfesor.'/';
											if(!move_uploaded_file($tmpDoc, $ubicaDoc.$arreglo['lastID'].'.'.$extensionDoc))
											{
												//si erro al subir, borro lo de la tabla
												$this->EstudiosRealizados_model->eliminarEstudioRealizado($arreglo['lastID']);
											}
											else
											{
												//update al pdf para ponerle la ruta
												$this->EstudiosRealizados_model->cambiarRuta($arreglo['lastID'],$ubicaDoc.$arreglo['lastID'].'.'.$extensionDoc);
												redirect(base_url('index.php/User/estudiosRealizados'));
											}
										}
							}
							else
								redirect(base_url('index.php/User/estudiosRealizados?E=1'));//algun error, pq no un dato esta vacio-
						}
						else
							redirect(base_url('index.php/User/estudiosRealizados?E=1'));//mando algun archivo que no es aceptado
				}
				else
					redirect(base_url('index.php/User/estudiosRealizados?E=1'));//no mando archivo
		}
		else {
			// para cuando no sea OBTENIDO
			if(isset($datos['estadoER']) && $datos['estadoER'] == 'Finalizado\Por obtener')
			{
				if(
						isset($datos['nivel']) &&
						isset($datos['siglas']) &&
						isset($datos['estudiosen']) &&
						isset($datos['area']) &&
						isset($datos['disciplina']) &&
						isset($datos['otrainstit']) &&
						isset($datos['BInstit']) &&
						isset($datos['fechainicio']) &&
						isset($datos['fechafin']) &&
						isset($datos['pais'])
				){

							//Se inserta la institucion en la tabla instit
							//si BInstit es 1

							$instit = '';
							$noinstit = '';

							if($datos['BInstit'] == 1)
							{
								$instit = 'Otra';
								$noinstit = $datos['otrainstit'];
								$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
							}
							if($datos['BInstit'] == 0)
							{
								$instit = $datos['otrainstit'];
								$noinstit = '';
							}

							$dats = (object)array(
								'Nivelestudios' => $datos['nivel'],
								'Siglas' => $datos['siglas'],
								'Estudiosen' => $datos['estudiosen'],
								'Area' => $datos['area'],
								'Disciplina' => $datos['disciplina'],
								'Institucionnoconsiderada' => $noinstit,
								'Institucion' => $instit,
								'EstadoEstudio' => $datos['estadoER'],
								'Fechadeinicio' => $datos['fechainicio'],
								'Fechadefin' => $datos['fechafin'],
								'Pais' => $datos['pais'],
								'Datosprofesores_idDatosprofesor' => $idProfesor,
								'PDF' => null,
								'status' => 1
							);
							$arreglo = $this->EstudiosRealizados_model->insertarEstudioRealizado($dats);
							// print_r($arreglo['error']['message']);

							redirect(base_url('index.php/User/estudiosRealizados'));
				}
				else
					redirect(base_url('index.php/User/estudiosRealizados?E=1'));//algun error, pq no un dato esta vacio

			}

			if(isset($datos['estadoER']) && $datos['estadoER'] == 'En Progreso')
			{
				if(
						isset($datos['nivel']) &&
						isset($datos['siglas']) &&
						isset($datos['estudiosen']) &&
						isset($datos['area']) &&
						isset($datos['disciplina']) &&
						isset($datos['otrainstit']) &&
						isset($datos['BInstit']) &&
						isset($datos['fechainicio']) &&
						isset($datos['pais'])
				){

							//Se inserta la institucion en la tabla instit
							//si BInstit es 1

							$instit = '';
							$noinstit = '';

							if($datos['BInstit'] == 1)
							{
								$instit = 'Otra';
								$noinstit = $datos['otrainstit'];
								$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
							}
							if($datos['BInstit'] == 0)
							{
								$instit = $datos['otrainstit'];
								$noinstit = '';
							}

							$dats = (object)array(
								'Nivelestudios' => $datos['nivel'],
								'Siglas' => $datos['siglas'],
								'Estudiosen' => $datos['estudiosen'],
								'Area' => $datos['area'],
								'Disciplina' => $datos['disciplina'],
								'Institucionnoconsiderada' => $noinstit,
								'Institucion' => $instit,
								'EstadoEstudio' => $datos['estadoER'],
								'Fechadeinicio' => $datos['fechainicio'],
								'Pais' => $datos['pais'],
								'Datosprofesores_idDatosprofesor' => $idProfesor,
								'PDF' => null,
								'status' => 1
							);
							$arreglo = $this->EstudiosRealizados_model->insertarEstudioRealizado($dats);
							// print_r($arreglo['error']['message']);

							redirect(base_url('index.php/User/estudiosRealizados'));
				}
				else
					redirect(base_url('index.php/User/estudiosRealizados?E=1'));//algun error, pq no un dato esta vacio

			}
		}
	}
	public function ERModificar()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		$datos = $this->input->post();

		print_r($datos);

		$nombreDoc = $_FILES['PDFInputModal']['name'];
	  $tamDoc = $_FILES['PDFInputModal']['size'];
	  $tipoDoc = $_FILES['PDFInputModal']['type'];
	  $tmpDoc = $_FILES['PDFInputModal']['tmp_name'];
	  $errorDoc = $_FILES['PDFInputModal']['error'];
	  $extensionDoc = strtolower(substr($nombreDoc,strpos($nombreDoc,'.')+1));

		echo '<br>$nombreDoc: '.$nombreDoc;
		echo '<br>$tamDoc: '.$tamDoc;
		echo '<br>$tipoDoc: '.$tipoDoc;
		echo '<br>$tmpDoc: '.$tmpDoc;
		echo '<br>$errorDoc: '.$errorDoc;
		echo '<br>$extensionDoc: '.$extensionDoc;

		$idProfesor = $this->session->userdata('login');

		if(isset($datos['estadoER']) && $datos['estadoER'] == 'En Progreso')
		{

			if(
					isset($datos['nivel']) &&
					isset($datos['siglas']) &&
					isset($datos['estudiosen']) &&
					isset($datos['area']) &&
					isset($datos['disciplina']) &&
					isset($datos['otrainstit']) &&
					isset($datos['BInstit']) &&
					isset($datos['fechainicio']) &&
					isset($datos['pais']) &&
					isset($datos['id'])
			)
			{
				$instit = '';
				$noinstit = '';

				if($datos['BInstit'] == 1)
				{
					$instit = 'Otra';
					$noinstit = $datos['otrainstit'];
					$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
				}
				if($datos['BInstit'] == 0)
				{
					$instit = $datos['otrainstit'];
					$noinstit = '';
				}
				$dats = (object)array(
					'Nivelestudios' => $datos['nivel'],
					'Siglas' => $datos['siglas'],
					'Estudiosen' => $datos['estudiosen'],
					'Area' => $datos['area'],
					'Disciplina' => $datos['disciplina'],
					'Institucionnoconsiderada' => $noinstit,
					'Institucion' => $instit,
					'EstadoEstudio' => $datos['estadoER'],
					'Fechadeinicio' => $datos['fechainicio'],
					'Fechadefin' => '',
					'Fechadeobtencion' => '',
					'Pais' => $datos['pais'],
					'PDF' => null
				);
				$ruta = $this->EstudiosRealizados_model->getRuta($datos['id']);
				echo $ruta->result()[0]->Datosprofesores_idDatosprofesor;
				echo $this->session->userdata('login');
				if($ruta != null && $ruta->result()[0]->Datosprofesores_idDatosprofesor == $this->session->userdata('login'))
				{
					echo 'se actualizan los datos';
					if($ruta->result()[0]->PDF != '')
					{
						unlink($ruta->result()[0]->PDF);
					}
					$error = $this->EstudiosRealizados_model->modificarEstudioRealizado($dats,$datos['id']);
					print_r($error);
					redirect(base_url('index.php/User/estudiosRealizados'));
				}


			}
		}
		if(isset($datos['estadoER']) && $datos['estadoER'] == 'Finalizado\Por obtener')
		{

			if(
					isset($datos['nivel']) &&
					isset($datos['siglas']) &&
					isset($datos['estudiosen']) &&
					isset($datos['area']) &&
					isset($datos['disciplina']) &&
					isset($datos['otrainstit']) &&
					isset($datos['BInstit']) &&
					isset($datos['fechainicio']) &&
					isset($datos['fechafin']) &&
					isset($datos['pais']) &&
					isset($datos['id'])
			)
			{
				$instit = '';
				$noinstit = '';

				if($datos['BInstit'] == 1)
				{
					$instit = 'Otra';
					$noinstit = $datos['otrainstit'];
					$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
				}
				if($datos['BInstit'] == 0)
				{
					$instit = $datos['otrainstit'];
					$noinstit = '';
				}
				$dats = (object)array(
					'Nivelestudios' => $datos['nivel'],
					'Siglas' => $datos['siglas'],
					'Estudiosen' => $datos['estudiosen'],
					'Area' => $datos['area'],
					'Disciplina' => $datos['disciplina'],
					'Institucionnoconsiderada' => $noinstit,
					'Institucion' => $instit,
					'EstadoEstudio' => $datos['estadoER'],
					'Fechadeinicio' => $datos['fechainicio'],
					'Fechadefin' => $datos['fechafin'],
					'Fechadeobtencion' => '',
					'Pais' => $datos['pais'],
					'PDF' => null
				);
				$ruta = $this->EstudiosRealizados_model->getRuta($datos['id']);

				if($ruta != null && $ruta->result()[0]->Datosprofesores_idDatosprofesor == $this->session->userdata('login'))
				{

					if($ruta->result()[0]->PDF != '')
					{
						unlink($ruta->result()[0]->PDF);
					}
					$error = $this->EstudiosRealizados_model->modificarEstudioRealizado($dats,$datos['id']);
					print_r($error);
					redirect(base_url('index.php/User/estudiosRealizados'));
				}

			}

		}
		if(isset($datos['estadoER']) && $datos['estadoER'] == 'Obtenido')
		{

			if(!isset($datos['sustituir']))
			{
				if(isset($nombreDoc))
				{
					if(
						($extensionDoc == 'pdf' || $extensionDoc == 'png' || $extensionDoc == 'jpeg' || $extensionDoc == 'jpg')
						&& ($tipoDoc == 'application/pdf' || $tipoDoc == 'image/jpeg' || $tipoDoc == 'image/png')
					)
					{
						if(
								isset($datos['nivel']) &&
								isset($datos['siglas']) &&
								isset($datos['estudiosen']) &&
								isset($datos['area']) &&
								isset($datos['disciplina']) &&
								isset($datos['otrainstit']) &&
								isset($datos['BInstit']) &&
								isset($datos['fechainicio']) &&
								isset($datos['fechafin']) &&
								isset($datos['fechaobt']) &&
								isset($datos['pais']) &&
								isset($datos['id'])
						)
						{
							$instit = '';
							$noinstit = '';

							if($datos['BInstit'] == 1)
							{
								$instit = 'Otra';
								$noinstit = $datos['otrainstit'];
								$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
							}
							if($datos['BInstit'] == 0)
							{
								$instit = $datos['otrainstit'];
								$noinstit = '';
							}
							$dats = (object)array(
								'Nivelestudios' => $datos['nivel'],
								'Siglas' => $datos['siglas'],
								'Estudiosen' => $datos['estudiosen'],
								'Area' => $datos['area'],
								'Disciplina' => $datos['disciplina'],
								'Institucionnoconsiderada' => $noinstit,
								'Institucion' => $instit,
								'EstadoEstudio' => $datos['estadoER'],
								'Fechadeinicio' => $datos['fechainicio'],
								'Fechadefin' => $datos['fechafin'],
								'Fechadeobtencion' => $datos['fechaobt'],
								'Pais' => $datos['pais'],
								'Datosprofesores_idDatosprofesor' => $idProfesor,
								'PDF' => null,
								'status' => 1
							);
							$arreglo = $this->EstudiosRealizados_model->modificarEstudioRealizado($dats,$datos['id']);
							if($arreglo['error']['message'] == '')
							{
								//crear carpeta
								if(!is_dir('assets/documentos/EstudiosRealizados/'.$idProfesor))
									mkdir('assets/documentos/EstudiosRealizados/'.$idProfesor, 0777, TRUE);

								$ubicaDoc = 'assets/documentos/EstudiosRealizados/'.$idProfesor.'/';
								if(move_uploaded_file($tmpDoc, $ubicaDoc.$datos['id'].'.'.$extensionDoc))
								{
									$this->EstudiosRealizados_model->cambiarRuta($datos['id'],$ubicaDoc.$datos['id'].'.'.$extensionDoc);
								}
							}


						}
					}
				}
			}

			if(isset($datos['sustituir']) && $datos['sustituir'] == "No")
			{
				if(!isset($nombreDoc))
				{
					if(
							isset($datos['nivel']) &&
							isset($datos['siglas']) &&
							isset($datos['estudiosen']) &&
							isset($datos['area']) &&
							isset($datos['disciplina']) &&
							isset($datos['otrainstit']) &&
							isset($datos['BInstit']) &&
							isset($datos['fechainicio']) &&
							isset($datos['fechafin']) &&
							isset($datos['fechaobt']) &&
							isset($datos['pais']) &&
							isset($datos['id'])
					)
					{
						$instit = '';
						$noinstit = '';

						if($datos['BInstit'] == 1)
						{
							$instit = 'Otra';
							$noinstit = $datos['otrainstit'];
							$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
						}
						if($datos['BInstit'] == 0)
						{
							$instit = $datos['otrainstit'];
							$noinstit = '';
						}
						$dats = (object)array(
							'Nivelestudios' => $datos['nivel'],
							'Siglas' => $datos['siglas'],
							'Estudiosen' => $datos['estudiosen'],
							'Area' => $datos['area'],
							'Disciplina' => $datos['disciplina'],
							'Institucionnoconsiderada' => $noinstit,
							'Institucion' => $instit,
							'EstadoEstudio' => $datos['estadoER'],
							'Fechadeinicio' => $datos['fechainicio'],
							'Fechadefin' => $datos['fechafin'],
							'Fechadeobtencion' => $datos['fechaobt'],
							'Pais' => $datos['pais'],
							'Datosprofesores_idDatosprofesor' => $idProfesor,
							'status' => 1
						);
						$arreglo = $this->EstudiosRealizados_model->modificarEstudioRealizado($dats,$datos['id']);
					}
				}
			}

			if(isset($datos['sustituir']) && $datos['sustituir'] == "Sí")
			{
				if(isset($nombreDoc))
				{
					if(
						($extensionDoc == 'pdf' || $extensionDoc == 'png' || $extensionDoc == 'jpeg' || $extensionDoc == 'jpg')
						&& ($tipoDoc == 'application/pdf' || $tipoDoc == 'image/jpeg' || $tipoDoc == 'image/png')
					)
					{
						if(
								isset($datos['nivel']) &&
								isset($datos['siglas']) &&
								isset($datos['estudiosen']) &&
								isset($datos['area']) &&
								isset($datos['disciplina']) &&
								isset($datos['otrainstit']) &&
								isset($datos['BInstit']) &&
								isset($datos['fechainicio']) &&
								isset($datos['fechafin']) &&
								isset($datos['fechaobt']) &&
								isset($datos['pais']) &&
								isset($datos['id'])
						)
						{
							$instit = '';
							$noinstit = '';

							if($datos['BInstit'] == 1)
							{
								$instit = 'Otra';
								$noinstit = $datos['otrainstit'];
								$this->EstudiosRealizados_model->setInstitucionER($datos['otrainstit']);
							}
							if($datos['BInstit'] == 0)
							{
								$instit = $datos['otrainstit'];
								$noinstit = '';
							}
							$dats = (object)array(
								'Nivelestudios' => $datos['nivel'],
								'Siglas' => $datos['siglas'],
								'Estudiosen' => $datos['estudiosen'],
								'Area' => $datos['area'],
								'Disciplina' => $datos['disciplina'],
								'Institucionnoconsiderada' => $noinstit,
								'Institucion' => $instit,
								'EstadoEstudio' => $datos['estadoER'],
								'Fechadeinicio' => $datos['fechainicio'],
								'Fechadefin' => $datos['fechafin'],
								'Fechadeobtencion' => $datos['fechaobt'],
								'Pais' => $datos['pais'],
								'Datosprofesores_idDatosprofesor' => $idProfesor,
								'status' => 1
							);

							$ruta = $this->EstudiosRealizados_model->getRuta($datos['id']);

							if($ruta != null && $ruta->result()[0]->Datosprofesores_idDatosprofesor == $this->session->userdata('login'))
							{
								echo 'se actualizan los datos';
								if($ruta->result()[0]->PDF != '')
								{
									unlink($ruta->result()[0]->PDF);
								}
								$error = $this->EstudiosRealizados_model->modificarEstudioRealizado($dats,$datos['id']);
								print_r($error);
								$ubicaDoc = 'assets/documentos/EstudiosRealizados/'.$idProfesor.'/';
								if(move_uploaded_file($tmpDoc, $ubicaDoc.$datos['id'].'.'.$extensionDoc))
								{
									$this->EstudiosRealizados_model->cambiarRuta($datos['id'],$ubicaDoc.$datos['id'].'.'.$extensionDoc);
									redirect(base_url('index.php/User/estudiosRealizados'));
								}
							}
						}
					}
				}
			}

		}
		redirect(base_url('index.php/User/estudiosRealizados?E=1'));

		redirect(base_url('index.php/User/estudiosRealizados'));
	}
	public function EREliminar()
	{
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		$datos = $this->input->post();

		if(
				isset($datos['id'])
		){
			$ruta = $this->EstudiosRealizados_model->getRuta($datos['id']);
			unlink($ruta->result()[0]->PDF);
			$error = $this->EstudiosRealizados_model->eliminarEstudioRealizado($datos['id']);
			//print_r($error);
		}
	}
	public function descargarEstudio($id)
	{
		$ruta = $this->EstudiosRealizados_model->getRuta($id);
		if($ruta!=null && $ruta->result()[0]->Datosprofesores_idDatosprofesor == $this->session->userdata('login'))
		{
			$ruta = $ruta->result()[0]->PDF;
			$data['ruta'] = base_url().$ruta;
			$this->load->view('User/estudiosRealizadosArchivo',$data);
		}
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
				$data['lineasInd'] = $this->ProduccionAca_model->getLineas();
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
				$data['miembro'] = $this->ProduccionAca_model->getCA();
				$data['query'] = $this->ProduccionAca_model->getLineasGeneracion();
				if(isset($data['miembro'])) {
					$data['MiembrosCA'] = $this->ProduccionAca_model->getMiembros($data['miembro']);
					$data['lineaCA'] = $this->ProduccionAca_model->getLineasGeneracionCA($data['miembro']);
				}
				if(isset($_POST['id'])){
					$data['id'] = $_POST['id'];
				}
				$this->load->view('forms/produccion_academica',$data);
			}
		}
		public function mostrarDetalles(){
			$data['miembro'] = $this->ProduccionAca_model->getCA();
			$data['lineas'] = $this->ProduccionAca_model->getLineasInd($_GET['lineas']);
			if(isset($data['miembro'])) {
				$data['MiembrosCA'] = $this->ProduccionAca_model->getMiembrosProduccion($_GET['miembros']);
				$data['lineaCA'] = $this->ProduccionAca_model->getLineasGeneracionCA($data['miembro']);
			}
			//$_POST['lineas'];
			//$_POST['miembros'];
			$this->load->view('Detalles/produccion_detalles',$data);
		}
		public function addProduccion(){
			if($this->session->userdata('id') != 2)
			{
				redirect(base_url());
			}
			//tome un valor random para saber si se enviaron todos los elementos es decir, que se quiere modificar o añadir por lo cual requiere todos
			//los elementos
			else if(isset($_POST['Titulo'])){
				//Por si se selecciono otra en el select de tipo de produccion
				if($_POST['tipoproduccion'] == "Otra"){
					$tipoProduccion = $_POST['OtraProduccion'];
				}
				else{
					$tipoProduccion = $_POST['tipoproduccion'];
				}
				$data = array(
				'idProduccionacademica' => isset($_POST['id'])? $_POST['id']: null,
				'Titulo' => isset($_POST['Titulo'])? $_POST['Titulo']: "",
				'Ano'=> $_POST['Ano'],
				'Tipoproduccion' => $tipoProduccion,
				'ParaCA' => $_POST['Para'],
				'Datosprofesores_idDatosprofesor' => $this->session->userdata('login')
				);

				$lgac = explode( ',', $_POST['LgacInd']);
				if($data['ParaCA']==1){
					$data['Lineageneracion_idLineageneracion'] = $_POST['idLgac'];
					$data['MiembrosCA'] = $_POST['Miembros'];
				}
				else{
					$data['Lineageneracion_idLineageneracion'] = 'NULL';
					$data['MiembrosCA'] = '';
				}
				$this->ProduccionAca_model->agregModProduccion($data,$lgac);
			}
			else
			{
				$id = $_POST['id'];
				$this->ProduccionAca_model->eliminarProduccion($id);
			}
		}
		public function getCitas(){
			$idProd =$_GET['id'];
			$data['citas']=$this->ProduccionAca_model->getCitas($idProd,0);
			$data['idProd'] = $idProd;
			$this->load->view('forms/citas',$data);
		}
		public function form_citas(){
			$data['id_prod'] =$_GET['id'];
			$this->load->view('forms/citas_form',$data);
		}
		public function addCita(){
			$data = array(
			'Nombrepublicacion' => $_POST['Titulo'],
			'Ano' => $_POST['ano_cita'],
			'Infadicional' => $_POST['infAdic'],
			'Datosprofesores_idDatosprofesor' => $this->session->userdata('login'));

			if($_POST['tipoproduccion'] == "Otra"){
				$data['Tipoproduccion'] = $_POST['otraProduccion_cita'];
			}
			else{
				$data['Tipoproduccion'] = $_POST['tipoproduccion'];
			}
			var_dump($_POST);
			if($_POST['id_cita']!=-1){
				$idCita = $_POST['id_cita'];
				$this->ProduccionAca_model->editCita($data,$_GET['id'],$idCita);
			}
			else{
				$this->ProduccionAca_model->addCita($data,$_GET['id']);
			}
		}
		public function deleteCita(){
			$this->ProduccionAca_model->deleteCita($_POST['id'],$_POST['idProd']);
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
		$this->acceso($this->session->userdata('login'));
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

	//Para modificar la imagen de usuario
	public function Imagen()
	{
		$config['upload_path'] = './assets/img/users/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto'))
		{
			$data = $this->upload->data();
			$this->Perfil_model->imagen($data['file_name'], $this->session->userdata('login'));
			echo $data['file_name']. ' '. $this->session->userdata('login');
			redirect(base_url('index.php/User/perfil'));
		}
		else
		{
			echo $this->upload->display_errors();
		}
	}

	// Datos laborales
	public function datosLaborales()
	{
		if($this->acceso($this->session->userdata('login')));
		else
		{
			if($this->session->userdata('id') != 2)
			{
				redirect(base_url());
			}
			else if($this->session->userdata('id') == 2)
			{
				$data['titulo'] = 'SAPTC - Datos Laborales';
				$data['datos'] = $this->DatosLaborales_model->obtiene($this->session->userdata('login'));
				$this->load->view('User/datosLaborales', $data);
			}
			else
			{
				redirect(base_url());
			}
		}
	}
	public function form_datoslaborales($id, $el)
	{

		if($el==0)
		{
			$data['es']=0;
			$data["user"]=$this->DatosLaborales_model->tomafila($id);
		}
		elseif ($id!=0 )
		{
			$data["user"]=$this->DatosLaborales_model->tomafila($id);
			$data['dec']=true;
		}
		else
		{
			$data['dec']=null;
		}
		$this->load->view('forms/datoslaborales', $data);
	}
	public function agregaDatosLaborales()
	{		$datos = (object)array(
        'Nombramiento'=>$this->input->post('nom'),
        'Fechadeiniciocontrato'=>$this->input->post('fecha_init'),
        'Fechafincontrato'=>$this->input->post('fecha_fin'),
        'Tipo'=>$this->input->post('tipo_nom'),
				'Dedicacion'=>$this->input->post('dedicacion'),
				'NombreDependencia'=>$this->input->post('dependencia'),
				'Unidadacademica'=>$this->input->post('unidad'),
				'Cronologia'=>'',
				'Datosprofesores_idDatosprofesor'=>$this->session->userdata('login')
        );
				$this->DatosLaborales_model->insert_data($datos);
	}
	public function actualizaDatosLaborales($id)
	{
		$datos = (object)array(
					'idDatoslaborales'=>$id,
	        'Nombramiento'=>$this->input->post('nom'),
	        'Fechadeiniciocontrato'=>$this->input->post('fecha_init'),
	        'Fechafincontrato'=>$this->input->post('fecha_fin'),
	        'Tipo'=>$this->input->post('tipo_nom'),
					'Dedicacion'=>$this->input->post('dedicacion'),
					'NombreDependencia'=>$this->input->post('dependencia'),
					'Unidadacademica'=>$this->input->post('unidad'),
	        );
				$this->DatosLaborales_model->updateDatoslaborales($datos);
	}
	public function deleteDatol()
	{
		$id= $this->uri->segment(3);
		$this->DatosLaborales_model->delete_data($id);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	public function contratoactual()
	{
		$id= $this->uri->segment(3);
		$data = (object)array('id'=>$id,'Cronologia'=>'Contrato Actual','profeid'=>$this->session->userdata('login'));
		$this->DatosLaborales_model->contratoactual($data);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	public function contratoprimero()
	{
		$id= $this->uri->segment(3);
		$data = (object)array('id'=>$id,'Cronologia'=>'Primer Contrato','profeid'=>$this->session->userdata('login'));
		$this->DatosLaborales_model->contratoprimero($data);
		redirect(base_url()."index.php/User/datosLaborales");
	}
	//Fin de datos Laborales

	// Premios o distinciones
	public function premiosoDisticiones()
	{
		if($this->acceso($this->session->userdata('login')));
		else
		{
			if($this->session->userdata('id') != 2)
			{
				redirect(base_url());
			}
			else if($this->session->userdata('id') == 2)
			{
				$data['titulo'] = 'SAPTC - Premios o Distinciones';
				$data['datos'] = $this->PremiosoDistinciones_model->obtiene($this->session->userdata('login'));
				$data["inst"]=$this->PremiosoDistinciones_model->obtienei();
				$this->load->view('User/premiosoDistinciones', $data);
			}
			else
			{
				redirect(base_url());
			}
		}
	}
	public function formu_premios($id)
	{
		$data["inst"]=$this->PremiosoDistinciones_model->obtienei();
		if ($id!=0 )
		{
			$data["user"]=$this->PremiosoDistinciones_model->tomafila($id);
			$this->load->view('forms/premiosoDistinciones', $data);
		}
		else
		{
			$this->load->view('forms/premiosoDistinciones', $data);
		}
	}
	public function agregaPremiosoDistinciones()
	{
		if ( $this->input->post('io')==0)
		{ $dato = (object)array('Nombre'=>$this->input->post('oio'));
			$dec=$this->PremiosoDistinciones_model->insert_ins($dato);
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
	$this->PremiosoDistinciones_model->insert_data($datos);
	}
	public function deletePremios()
	{
		$id= $this->uri->segment(3);
		$this->PremiosoDistinciones_model->delete_data($id);
		redirect(base_url()."index.php/User/premiosoDisticiones");
	}
	public function actualizaPremios($id)
	{	if ( $this->input->post('io')==0)
		{
			$dato = (object)array('Nombre'=>$this->input->post('oio'));
			$dec= $this->PremiosoDistinciones_model->insert_ins($dato);
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
		$this->PremiosoDistinciones_model->updatePremios($datos);
	}
//fin de premiosoDisticiones

	//Datos del cuerpo académico
	public function cuerpoAcademico(){
		if($this->acceso($this->session->userdata('login')));
		else
		{
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
					$this->CuerpoAcademico_model->chkCA($_POST['nombre'],$_POST['clave'],$_POST['accion']);
		}
	}
//fin de datos del cuerpo academico

//Docencia
	public function docencia(){
		if($this->acceso($this->session->userdata('login')));
		else
		{
			if($this->session->userdata('id') != 2)
			{
				redirect(base_url());
			}
			else{
				$data['titulo'] = 'SAPTC - Docencia';
				$data['docencias'] = $this->Docencia_model->obtenerDocencias();
				$this->load->view('User/docencia',$data);
			}
		}
	}

	public function formDocencia(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['dependencias'] = $this->Docencia_model->obtenerDependencia();
			$this->load->view('forms/docencia',$data);
		}
	}

	public function agrDocencia(){
		$nombre = $_POST['nombre'];
		$pre = $_POST['pre'];
		$fei = $_POST['fei'];
		$noa = $_POST['noa'];
		$dus = $_POST['dus'];
		$ham = $_POST['ham'];
		$hos = $_POST['hos'];
		$np = $_POST['otrainstit'];
		$this->Docencia_model->agreDocencica($nombre, $pre, $fei, $noa, $dus, $ham, $hos, $np);
		redirect(base_url('index.php/User/docencia'));
	}

	public function mdDocencia(){
		$id = $_POST['idd'];
		$nombre = $_POST['nombre'];
		$pre = $_POST['pre'];
		$fei = $_POST['fei'];
		$noa = $_POST['noa'];
		$dus = $_POST['dus'];
		$ham = $_POST['ham'];
		$hos = $_POST['hos'];
		$np = $_POST['otrainstit'];
		$this->Docencia_model->modDocencica($id,$nombre, $pre, $fei, $noa, $dus, $ham, $hos, $np);
		redirect(base_url('index.php/User/docencia'));
	}

	public function elimDocencia(){
		$id = $this->uri->segment(3);
		$this->Docencia_model->elimiDocencica($id);
		redirect(base_url('index.php/User/docencia'));
	}

	public function formDocenciaDetalles(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['dependencias'] = $this->Docencia_model->obtenerDependencia();
			$this->load->view('Detalles/docencia',$data);
		}
	}

//Fin de docencia
	//Linea de Generación
	public function linea_generacion(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['titulo'] = 'SAPTC - Línea de Generación';
			$data['query'] = $this->LineaGeneracion_model->ObtenerLineas();
			$this->load->view('User/linea_generacion',$data);
		}
	}

	public function buscarLinea($descripcion){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data['titulo'] = 'SAPTC - Línea de Generación';
			$data['busqueda'] = $this->LineaGeneracion_model->BuscarLineas($descripcion);
			$this->load->view('User/linea_busqueda',$data);
		}
	}

	public function agregarLinea(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data = $this->input->post();
			$info = (object)array(
	                'idLineageneracion'     =>      '',
	                'Nombre'        		=>      $data['nombre'],
	                'Actividades'   		=>      $data['actividades'],
	                'HorasSemana'           =>      $data['horas'],
	                'Datosprofesores_idDatosprofesor'  =>  $this->session->userdata('login')
	        );
			$this->LineaGeneracion_model->agregarLinea($info);
		}
	}

	public function eliminarLinea(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data = $this->input->post();
			$info = (object)array(
	                'idLineageneracion'     =>      $data['id']
	        );
			$this->LineaGeneracion_model->eliminarlinea($info);
			//redirect(base_url()."index.php/User/linea_generacion");
		}
	}

	public function modificarLinea(){
		if($this->session->userdata('id') != 2)
		{
			redirect(base_url());
		}
		else{
			$data = $this->input->post();
			$info = (object)array(
	                'idLineageneracion'     =>      $data['id'],
	                'Nombre'        		=>      $data['nombre'],
	                'Actividades'   		=>      $data['actividades'],
	                'HorasSemana'           =>      $data['horas']
	        );
			$this->LineaGeneracion_model->modificarlinea($info);
		}
	}
	// Participación en Programas Educativos
	public function participacionEnProgramas()
	{
		if($this->acceso($this->session->userdata('login')));
		else
		{
			if($this->session->userdata('id') != 2)
			{
				redirect(base_url());
			}
			else if($this->session->userdata('id') == 2)
			{
				$data['titulo'] = 'SAPTC - Participación en Programas Educativos';
				$data['data'] = $this->Participacion_model->obtiene($this->session->userdata('login'));
				$data['grado'] = $this->Participacion_model->obtieneg();
				$this->load->view('User/participacionEnProgramas', $data);
			}
			else
			{
				redirect(base_url());
			}
		}
	}
	public function participacion($id)
	{
			$data['grado'] = $this->Participacion_model->obtieneg();
			if($id!=0)
			{
				$data["user"]=$this->Participacion_model->tomafila($id);
				$this->load->view('forms/participacion', $data);
			}
			else
			{
				$this->load->view('forms/participacion', $data);
			}
	}
	public function agregarParticipacion()
	{
		$nombreDoc = $_FILES['archivo']['name'];
		$tamDoc = $_FILES['archivo']['size'];
		$tipoDoc = $_FILES['archivo']['type'];
		$tmpDoc = $_FILES['archivo']['tmp_name'];
		$errorDoc = $_FILES['archivo']['error'];
		$idProfesor = $this->session->userdata('login');
		if ( $this->input->post('grado')==0)
		{ $dato = (object)array('nombre'=>$this->input->post('og'));
			$dec= $this->Participacion_model->insert_grado($dato);
		}
 		else
			$dec = $this->input->post('grado');
 		$datos = (object)array(
 	        'Fechaimplementacion'=>$this->input->post('fechacambio'),
 	        'Grado'=>$this->input->post('og'),
 	        'Descripcion'=>$this->input->post('des'),
 	        'PDF'=>0,
 					'Programaeducativo'=>$this->input->post('programa'),
 					'Datosprofesores_idDatosprofesor'=>$idProfesor,
 					'Grado_idGrado'=>$dec
 	        );
 		$lastID = $this->Participacion_model->insert_participacion($datos);
		if(!is_dir('assets/documentos/participacion/'.$idProfesor))
		  mkdir('assets/documentos/participacion/'.$idProfesor, 0777, TRUE);
		$ubicaDoc = 'assets/documentos/participacion/'.$idProfesor.'/';
		if(move_uploaded_file($tmpDoc, $ubicaDoc.$lastID.'.'.'pdf'))
		{
			$this->Participacion_model->cambiarRuta($lastID,$ubicaDoc.$lastID.'.'.'pdf');
			redirect(base_url('index.php/User/participacionEnProgramas'));
		}
	}
	public function deleteParticipacion($id)
	{
		$ruta = $this->Participacion_model->tomafila($id);
		unlink($ruta->result()[0]->PDF);
		$this->Participacion_model->deleteParticipacion($id);
		redirect(base_url()."index.php/User/participacionEnProgramas");
	}
	public function actualizaParticipacion($id)
	{	$nombreDoc = $_FILES['archivo']['name'];
		$tamDoc = $_FILES['archivo']['size'];
		$tipoDoc = $_FILES['archivo']['type'];
		$tmpDoc = $_FILES['archivo']['tmp_name'];
		$errorDoc = $_FILES['archivo']['error'];
		$profesor= $this->session->userdata('login');
		if ( $this->input->post('grado')==0)
		{ $dato = (object)array('nombre'=>$this->input->post('og'));
			$dec = $this->Participacion_model->insert_grado($dato);
		}
		else
		{	$dec = $this->input->post('grado');
		}
		$datos = (object)array(
					'idParticipacion'=>$id,
					'Fechaimplementacion'=>$this->input->post('fechacambio'),
					'Grado'=>$this->input->post('grado'),
					'Descripcion'=>$this->input->post('des'),
					'Programaeducativo'=>$this->input->post('programa'),
					'Datosprofesores_idDatosprofesor'=>$profesor,
					'Grado_idGrado'=>$dec
					);
					$this->Participacion_model->updateParticipacion($datos);
					$ubicaDoc = 'assets/documentos/participacion/'.$profesor.'/';
					move_uploaded_file($tmpDoc, $ubicaDoc.$id.'.'.'pdf');
					$this->Participacion_model->cambiarRuta($id,$ubicaDoc.$id.'.'.'pdf');
					redirect(base_url()."index.php/User/participacionEnProgramas");
	}
	public function archivo($id)
	{
		$ruta = $this->Participacion_model->tomafila($id);
		$ruta = $ruta->result()[0]->PDF;
		$data['ruta'] = base_url().$ruta;
		$this->load->view('User/participacionArchivo',$data);
	}
}

?>
