<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library(array('session'));
	}

	public function index()
	{
    $this->load->view('Admin/inicio');
	}

  public function incio_sesion()
	{
    $this->load->view('Admin/inicio_sesion');
	}


}
?>
