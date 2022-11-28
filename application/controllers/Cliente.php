<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('cliente_model');
        //$this->load->model('empleado_model');
       // $this->load->model('cargo_model');
        $this->load->library('form_validation');
       
         if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	
/*----------- CRUD Funcions-----------------------*/ 
    public function getAll()
	{
	   $data['titulo']    = 'Administar clientes';
	   $data['crud']      = 'cliente';
	   $data['camino']    = 'insertar';
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("clientes/v_clientes",$data);
	   $this->load->view("layout/footer");
    }  

	function load_cliente()
	{
	    $result = $this->cliente_model->get_clientes();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre_cliente.' </td>';
	        $output .= '<td>'.$row->telefono.'</td>';
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

          $this->form_validation->set_rules('nombre_cliente', 'Nombre del cliente', 'required');
		  $this->form_validation->set_rules('nombre_cliente', 'Nombre del cliente', 'callback_username_check');
          $this->form_validation->set_rules('telefono', 'Telefono', 'required');
		  $this->form_validation->set_rules('telefono', 'Telefono', 'callback_username_check');
		  
           if ($this->form_validation->run() === TRUE) 
            {
	            $param['nombre_cliente']  = $this->input->post('nombre_cliente');
	            $param['telefono']        = $this->input->post('telefono');
	            $param['nota']            = $this->input->post('nota');
	          
			    $result = $this->cliente_model->insert($param);
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

		$exit = $this->cliente_model->verificar_existencia($str);
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




   public function search_clientes( )
	{

		$cliente  = $this->input->post('cliente');
		$result = $this->cliente_model->searchCliente($cliente);	
		
		if (!empty($result))
		{
			foreach ($result as $row){
				echo "<li><a href='#'>" . $row->nombre_cliente . "</a></li>";
			}     
		}
		else
		{
			echo "<li> <em> No se encuentra ... </em> </li>";
		} 
		echo json_encode($result);  
	}



    /* Editar */

     public function update()
    {
      if ($this->input->is_ajax_request()) 
        {

			$this->form_validation->set_rules('nombre_cliente', 'Nombre del cliente', 'required');
			$this->form_validation->set_rules('nombre_cliente', 'Nombre del cliente', 'callback_username_check');
  
			$this->form_validation->set_rules('telefono', 'Telefono', 'required');  
			$this->form_validation->set_rules('telefono', 'Telefono', 'callback_username_check');

          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']              = $this->input->post('id');	
				$param['nombre_cliente']  = $this->input->post('nombre_cliente');
	            $param['telefono']        = $this->input->post('telefono');
	            $param['nota']            = $this->input->post('nota');	

				$result = $this->cliente_model->update($param);

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
        $result = $this->cliente_model->getDatos($id);		
        echo json_encode($result);      
    }

    /* Eliminar */

    public function delete()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->cliente_model->delete($id);
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
		
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('nombre_cliente', 'Nombre del cliente', 'required');
			$this->form_validation->set_rules('nombre_cliente', 'Nombre del cliente', 'callback_username_check');
			$this->form_validation->set_rules('telefono', 'Telefono', 'required');
			$this->form_validation->set_rules('telefono', 'Telefono', 'callback_username_check');
			
			 if ($this->form_validation->run() === TRUE) 
			  {
				  $param['nombre_cliente']  = $this->input->post('nombre_cliente');
				  $param['telefono']        = $this->input->post('telefono');
				  $result = $this->cliente_model->searchCliente($param);
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
   
}
