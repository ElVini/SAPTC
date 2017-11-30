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
	}

	public function inicio(){
		$this->load->view('Admin/inicio');
	}




}
?>
