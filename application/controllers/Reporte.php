<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('ventas_model');
        $this->load->model('entrada_model');
        $this->load->model('gasto_model');
        $this->load->model('reporte_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	public function view_reportes()
	{
	   $data['titulo']    = 'Reportes';
	   $data['crud']      = '';
	   $data['camino']    = '';
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("reportes/reportes",$data);
	   $this->load->view("layout/footer");
    }  


	public function view_moreSell()
	{
	   $data['titulo']    = 'Productos Mas Vendidos';
	   $data['crud']      = '';
	   $data['camino']    = '';
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("reportes/mas_vendidos",$data);
	   $this->load->view("layout/footer");
    } 

	
	public function reportex_genero()
	{
	   
	   $data['x_genero']  =   $this->reporte_model->stock_genero();

	   echo json_encode($data);

    }

	public function getData(){
		$year = date('Y');
		//$year = $this->input->post("year");
		$resultados = $this->ventas_model->montos($year);
		echo json_encode($resultados);
	}


	function getMoreSell()
	{
	    $result = $this->reporte_model->getMoreSell();			
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre_producto.'</td>';
	        $output .= '<td>'.$row->genero.' </td>';
	        $output .= '<td>'.$row->cantidad.' </td>';	        
			$output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}








	



	





}
