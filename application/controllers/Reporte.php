<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('empleado_model');
        $this->load->model('entrada_model');
        $this->load->model('gasto_model');
        $this->load->model('reporte_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }

	
	public function reportex_genero()
	{
	   
	   $data['x_genero']  =   $this->reporte_model->stock_genero();

	   echo json_encode($data);

    }



	



	





}
