<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inicio_model');
		$this->load->helper('url');
		$this->load->library(array('session'));
		$this->load->helper('string');
	}

	public function index()
	{
		switch($this->session->userdata('id'))
		{
			case '':
				$data['titulo'] = 'SAPTC - Iniciar sesión';
				$data['token'] = $this->token();
				$data['correo_e'] = $this->session->flashdata('correo_e');
				$data['error'] = $this->session->flashdata('error');
				$this->load->view('inicio', $data);
				break;

			case '1':
				$data['titulo'] = 'SAPTC - Administrador | Inicio';
				$this->load->view('Admin/inicio', $data);
				break;

			case '2':
				$this->load->model('Usuario_model');
				$data['titulo'] = 'SAPTC - Inicio';
				$data['nombre'] = $this->session->userdata('user');
				$data['query'] = $this->Usuario_model->obtenerRecordatorios($this->session->userdata('login'));
				$this->load->view('User/inicio', $data);
				break;
		}
	}

	public function token()
	{
			$token = md5(uniqid(rand(),true));
			$this->session->set_userdata('token',$token);
			return $token;
		}

	public function ingresar()
	{
		if($this->input->post('usu') != NULL and $this->input->post('contra') !=NULL)
		{
			//$query = $this->Inicio_model->login($this->input->post('usu'), md5($this->input->post('contra')));
			//comentado pq estamos en prueba
			$query = $this->Inicio_model->login($this->input->post('usu'), $this->input->post('contra'));
			if($query != null)
			{	//Lógica de inicio de sesión
				foreach ($query->result() as $res)
				{
					//1-Administrador 2-Profesor
					if($res->Tipo == 1)
					{
						$data = array(
							'user'   => $res->Usuario,
							'id'     => $res->Tipo,
							'login'  => $res->Datosprofesores_idDatosprofesor
						);
						$this->session->set_userdata($data);
						redirect(base_url());
					}
					else if($res->Tipo == 2)
					{
						$data = array(
							'user'   => $this->Inicio_model->getNombre($res->Idlogin),
							'id'     => $res->Tipo,
							'login'  => $res->Datosprofesores_idDatosprofesor
						);
						$this->session->set_userdata($data);
						$this->load->model('Usuario_model');
						$datos['titulo']="SAPTC - Inicio";
						$datos['nombre']=$this->Inicio_model->getNombre($res->Idlogin);
						$datos['query']=$this->Usuario_model->obtenerRecordatorios();
						redirect(base_url());
					}
				}
			}
			else
			{
				$a = "Usuario o contraseña incorrecta.";
			}
		}
		else{
			$a = "Complete todos los campos.";
		}
		$this->session->set_flashdata('error',$a);
		redirect(base_url());
	}

	public function logout()
	{
		$data = array(
			'user'   => '',
			'id'     => '',
			'login'  => ''
		);
		$this->session->set_userdata($data);
		$this->session->sess_destroy();
		$this->index();
		redirect(base_url());
	}

	public function recordarContra(){
		$correo = $_POST['correoR'];
		if(!$this->Inicio_model->getContra($correo)){
			$a=1;
		}
		else{
				$contra = $this->Inicio_model->getContra($correo);
				echo $correo;
				echo $contra;
			//Load email library
			$this->load->library('email');

			//SMTP & mail configuration
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'soporte.saptc@gmail.com',
				'smtp_pass' => 'soporte.saptc',
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
			);
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");


			$titulo = 'Recuperar contraseña.';
			$detalles = '<br>Se ha recibido una solicitud de renvío de contraseña.';
			$c = '<br>Correo: '.$correo;
			$co = '<br>Contraseña: '.$contra;
			$htmlContent = $titulo.$detalles.$c.$co;
			echo $htmlContent;

			$this->email->to($correo);
			$this->email->from('soporte.saptc@gmail.com','Soporte SAPTC');
			$this->email->subject('Recuperar contraseña.');
			$this->email->message($htmlContent);

		 //Send mail
		 $this->load->library('encrypt');
		 if($this->email->send()){
			 //2 - se envió el correo
			 $a=2;
 	 		}
		 else{
			 //3 - no se envió el correo
			 $a=3;
		 }
	 	}
		$this->session->set_flashdata('correo_e',$a);
		redirect(base_url());
	}
}
