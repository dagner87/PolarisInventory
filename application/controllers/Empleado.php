<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('empleado_model');
        $this->load->model('cargo_model');
        $this->load->model('area_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }	
	public function index()
	{
	    $data['crud'] = '';
	    $data['titulo']   = 'Sistema de Evaluacion de desempeño';
		$this->load->view("layout/head",$data);
		$this->load->view("layout/menu",$data);
		$this->load->view("rh/v_empleados",$data);
	    $this->load->view("layout/footer");
    }

/*----------- CRUD empleados-----------------------*/ 
    public function Get_empleados()
	{
	   $data['titulo']   = 'Administar Empleado';
	   $data['crud']     = 'Empleado';
	   $data['camino']   = 'insertar';
	   $data['areas']    = $this->area_model->get_areas();
		$this->load->view("layout/head",$data);
		$this->load->view("layout/menu");
		$this->load->view("rh/v_empleados",$data);
	    $this->load->view("layout/footer");
    }  

	function load_empleados()
	{
	    $result = $this->empleado_model->get_empleados();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre.'</td>';
	        $output .= '<td>'.$row->apellidos.'</td>';
	       	$output .= '<td>'.$row->dni.'</td>';
			$output .= '<td>'.$row->area.'</td>';
			$output .= '<td>'.$row->cargo.'</td>';
			$output .= '<td>'.$row->fecha_ingreso.'</td>';
            $output .= ' <td class="text-nowrap">
	                        <a href="javascript:void(0)" class="edit-row-btn" data="'.$row->id.'" data-toggle="tooltip" data-original-title="Editar"> 
	                        <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
	                        <a href="javascript:void(0)" class="eliminar-row-btn" data="'.$row->id.'" data-toggle="tooltip" data-original-title="Eliminar"> 
	                        <i class="fa fa-close text-danger"></i> </a>
                        </td>';
			$output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}




	 public function insert_emp()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('nombre', 'Nombre', 'required');
          $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
          $this->form_validation->set_rules('dni', 'DNI', 'required');
          $this->form_validation->set_rules('dni','...', 'callback_verificar_dni');
          $this->form_validation->set_rules('area', 'Area', 'required');
          $this->form_validation->set_rules('cargo', 'Cargo', 'required');
          $this->form_validation->set_rules('fecha_ingreso', 'Fecha Ingreso', 'required');

          if ($this->form_validation->run() === TRUE) 
            {
	            $param['nombre']         = $this->input->post('nombre');
				$param['apellidos']      = $this->input->post('apellidos');
				$param['dni']            = $this->input->post('dni');
				$param['id_area']        = $this->input->post('area');
				$param['id_cargo']       = $this->input->post('cargo');
				$param['fecha_ingreso']  = $this->input->post('fecha_ingreso');
		        $result                  = $this->empleado_model->insert_emp($param);
		        $msg['comprobador']      = FALSE;

		        if($result)
		             {
		               $msg['comprobador'] = TRUE;
		             }
		         echo json_encode($msg);

		     }else{
                   $msg['validacion'] =  validation_errors('<li>','</li>');
                   echo json_encode($msg);
                  }
        }              
    }

    /* Editar */

     public function update_emp()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('nombre', 'Nombre', 'required');
          $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
          $this->form_validation->set_rules('dni', 'DNI', 'required');
          $this->form_validation->set_rules('dni','...', 'callback_verificar_dni');
          $this->form_validation->set_rules('area', 'Area', 'required');
          $this->form_validation->set_rules('cargo', 'Cargo', 'required');
          $this->form_validation->set_rules('fecha_ingreso', 'Fecha Ingreso', 'required');

          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']             = $this->input->post('id');
	            $param['nombre']         = $this->input->post('nombre');
				$param['apellidos']      = $this->input->post('apellidos');
				$param['dni']            = $this->input->post('dni');
				$param['id_area']        = $this->input->post('area');
				$param['id_cargo']       = $this->input->post('cargo');
				$param['fecha_ingreso']  = $this->input->post('fecha_ingreso');
		        $result                  = $this->empleado_model->update_emp($param);
		        $msg['comprobador']      = FALSE;

		        if($result)
		             {
		               $msg['comprobador'] = TRUE;
		             }
		         echo json_encode($msg);

		     }else{
                   $msg['validacion'] =  validation_errors('<li>','</li>');
                   echo json_encode($msg);
                  }
        }              
    }




    /* Obtener Datos */
      public function getdatos_emp()
    {
        $id     = $this->input->get('id');
        $result = $this->empleado_model->getdatos_emp($id);
        echo json_encode($result);      
    }

    /* Eliminar */

    public function delete_emp()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->empleado_model->delete_emp($id);
	    $msg['comprobador'] = false;
	    if($result)
	    {
	     $msg['comprobador'] = TRUE;
	    }
	 echo json_encode($msg);

	}


    public function verificar_dni($str) 
    {
    	$respuesta = $this->empleado_model->verificar_dni($str);
        if($respuesta)
         {
           $this->form_validation->set_message('verificar_dni', 'Este DNI ya existe en la bd');
           return FALSE;
        } else {
                return TRUE;
               }	
    }

    public function getCargoArea() 
    {
      $id_area = $this->input->get("id_area");
      $data = $this->cargo_model->getCargoArea($id_area);
       echo json_encode($data);
    }




	public function process()
	{
     $this->load->view('vendor/autoload.php');

	  $options = array(
	    'cluster' => 'us2',
	    'useTLS' => true
	  );
	  $pusher = new Pusher\Pusher(
	    '65b03e0e93aaecc887ae',
	    '05c993f7b25a91af88ad',
	    '885928',
	    $options
	  );

	  $data['message'] = $this->input->post('nombre');
	  $pusher->trigger('rrhhv2', 'my-event', $data);

	}
}
