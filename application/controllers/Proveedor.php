<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('proveedor_model');
        //$this->load->model('empleado_model');
       // $this->load->model('cargo_model');
        $this->load->library('form_validation');
       
         if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	
/*----------- CRUD Funcions-----------------------*/ 
    public function Get_proveedores()
	{
	   $data['titulo']    = 'Administar Proveedores';
	   $data['crud']      = 'Proveedor';
	   $data['camino']    = 'insertar';
	   $data['proveedores']     = $this->proveedor_model->get_proveedores();
	  $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("v_proveedores",$data);
	   $this->load->view("layout/footer");
    }  

	function load_proveedores()
	{
	    $result = $this->proveedor_model->get_proveedores();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre_prove.' </td>';
	        $output .= '<td>'.$row->telefono.'</td>';
	       // $output .= '<td>'.$row->direccion_prove.'</td>';
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
	
	 public function insert()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('nombre_prove', 'Nombre del Proveedor', 'required');
		  $this->form_validation->set_rules('nombre_prove', 'Nombre del Proveedor', 'callback_username_check');
          $this->form_validation->set_rules('telefono', 'Telefono', 'required');
		  $this->form_validation->set_rules('telefono', 'Telefono', 'callback_username_check');
		  
           if ($this->form_validation->run() === TRUE) 
            {
	            $param['nombre_prove']    = $this->input->post('nombre_prove');
	            $param['telefono']           = $this->input->post('telefono');
	            $param['direccion_prove']    = $this->input->post('direccion_prove');
	          
			    $result = $this->proveedor_model->insert($param);
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


	public function username_check($str)
	{

		$exit = $this->proveedor_model->verificar_existencia($str);
		if ($exit)
		{
		$this->form_validation->set_message('username_check', 'El %s ya existe en la bd '.$str.'');
		return FALSE;
		}
		else
		{
			return TRUE;
		}
	}



    /* Editar */

     public function update()
    {
      if ($this->input->is_ajax_request()) 
        {

			$this->form_validation->set_rules('nombre_prove', 'Nombre del Proveedor', 'required');
			$this->form_validation->set_rules('nombre_prove', 'Nombre del Proveedor', 'callback_username_check');
  
			$this->form_validation->set_rules('telefono', 'Telefono', 'required');
  
			$this->form_validation->set_rules('telefono', 'Telefono', 'callback_username_check');

          if ($this->form_validation->run() === TRUE) 
            {
				$param['nombre_prove']    = $this->input->post('nombre_prove');
	            $param['telefono']    = $this->input->post('telefono');
	            $param['direccion_prove']    = $this->input->post('direccion_prove');	

				$result = $this->proveedor_model->update($param);

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
      public function getDatos()
    {
	
        $id     = $this->input->get('id');
        $result = $this->proveedor_model->getDatos($id);		
        echo json_encode($result);      
    }

    /* Eliminar */

    public function delete()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->proveedor_model->delete($id);
	    $msg['comprobador'] = false;
	    if($result)
	    {
	     $msg['comprobador'] = TRUE;
	    }
	 echo json_encode($msg);

	}


    public function verificar_obj($str)
    {
    	$respuesta = $this->area_model->verificar_obj($str);
        if($respuesta)
         {
           $this->form_validation->set_message('verificar_obj', 'Este Objetivo ya existe en la bd');
           return FALSE;
        } else {
                return TRUE;
               }	
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
