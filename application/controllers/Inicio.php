<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Publico_model');
    }

    public function index()
    {
        $consulta = $this->Publico_model->getProfesores();
        $datos = array(
            'consulta'   => $consulta
        );
        $this->load->view('Public/publico_view',$datos);
    }
}

?>
