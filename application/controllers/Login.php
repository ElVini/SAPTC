<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('inicio');
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
				$data['titulo'] = 'SAPTC - Inicio';
				$data['nombre'] = $this->session->userdata('user');
				$this->load->view('User/inicio', $data);
				break;
		}
	}

	public function ingresar()
	{	
		$query = $this->inicio->login($this->input->post('usu'), $this->input->post('contra'));
		if($query != null)
		{	//Lógica de inicio de sesión
			foreach ($query->result() as $res) 
			{
				if($res->Tipo == 1)
				{
					$data = array(
						'user'   => $res->Usuario,
						'id'     => $res->Tipo,
						'login'  => $res->Datosprofesores_idDatosprofesor
					);
					$this->session->set_userdata($data);
					//$this->load->view('User/inicio');
				}
				else if($res->Tipo == 2)
				{
					$data = array(
						'user'   => $this->inicio->getNombre($res->Idlogin),
						'id'     => $res->Tipo,
						'login'  => $res->Datosprofesores_idDatosprofesor
					);
					$this->session->set_userdata($data);
					$datos = array(
						'titulo' => 'SAPTC - Inicio',
						'nombre' => $this->inicio->getNombre($res->Idlogin)
					);
					$this->load->view('User/inicio',$datos);
				}	
			}
		}
		else
		{	
			$data['error'] = true;
			$data['titulo'] = 'SAPTC - Iniciar sesión';
			$this->load->view('inicio', $data);
		}
	}
}
