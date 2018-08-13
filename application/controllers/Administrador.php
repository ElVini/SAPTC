<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Admin_Usuarios');
		$this->load->model('Perfil_model');
		$this->load->library(array('session'));
	}

	public function index()
	{
		//holaaa como estan
		$this->load->view('Admin/inicio');
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
		$datos = $this->Admin_Usuarios->getUsuario($this->input->get('id'));
		foreach($datos->result() as $res)
		{
			$data = array(
				'id'			=> $res->idDatosprofesor,
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
		$data['titulo'] = 'SAPTC | Detalles';
		$this->load->view('Admin/detallesUsuario', $data);
	}

	//Para activar o desactivar un perfil
	public function modPerfil()
	{
		$this->Admin_Usuarios->modificarEstado($this->input->get('id'));
		redirect(base_url('index.php/Administrador/Usuarios'));
	}

	public function cambiarImagen()
	{
		$config['upload_path'] = './assets/img/users/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto'))
		{
			$data = $this->upload->data();
			$this->Perfil_model->imagen($data['file_name'], $this->input->get('id'));
			echo $data['file_name']. ' '. $this->session->userdata('login');
			redirect(base_url('index.php/Administrador/Usuarios'));
		}
		else
		{
			echo $this->upload->display_errors();
		}
	}




}
?>
