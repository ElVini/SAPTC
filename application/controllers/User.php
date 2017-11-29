<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->usuario->agregar($data);
		redirect(base_url('index.php/User/tutorias'));
	}
	public function eliminarTutoria()
	{
		$this->usuario->eliminarTutoria($this->input->get('id'));
		redirect(base_url('index.php/User/tutorias'));
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
