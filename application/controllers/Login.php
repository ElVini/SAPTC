<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inicio_model');
		$this->load->helper('url');
		$this->load->library(array('session'));
	}

	public function index()
	{
		switch($this->session->userdata('id'))
		{
			case '':
				$data['titulo'] = 'SAPTC - Iniciar sesión';
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

	public function ingresar()
	{
		if($this->input->post('usu') != NULL and $this->input->post('contra') !=NULL)
		{
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
				$data['error'] = "Usuario o contraseña incorrectos.";
			}
		}
		else{
			$data['error'] = "Complete todos los campos.";
		}
		$data['titulo'] = 'SAPTC - Iniciar sesión';
		$this->load->view('inicio', $data);
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

}
