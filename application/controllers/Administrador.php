<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Admin_Usuarios');
		$this->load->library(array('session'));
	}

	public function index()
	{
	}

	public function inicio()
	{
		$this->load->view('Admin/inicio');
	}

	public function Usuarios()
	{
		if($this->session->userdata('id') != 1)
		{
			redirect(base_url());
		}
		else
		{
			$data['query'] = $this->Admin_Usuarios->getUsuarios();
			$data['titulo'] = 'SAPTC | Administrador - Usuarios';
			$this->load->view('Admin/Usuarios', $data);
		}
	}

	//Para detalles de usuario en la vista de control de usuarios
	public function User()
	{
		$data['query'] = $this->Admin_Usuarios->getUsuario($this->input->get('id'));
		$data['titulo'] = 'SAPTC | Detalles';
		$this->load->view('Admin/detallesUsuario', $data);
	}

	//Para activar o desactivar un perfil
	public function modPerfil()
	{
		$this->Admin_Usuarios->modificarEstado($this->input->get('id'));
		redirect(base_url('index.php/Administrador/Usuarios'));
	}




}
?>
