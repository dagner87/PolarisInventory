<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competencia extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('competencia_model');
        $this->load->model('empleado_model');
        $this->load->model('cargo_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
       
    }
	
/*----------- CRUD Funcions-----------------------*/ 
    public function Get_comp()
	{
	   $data['titulo']    = 'Administar Competencias';
	   $data['crud']      = 'Competencia';
	   $data['camino']    = 'insertar';
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("rh/v_competencia",$data);
	   $this->load->view("layout/footer");
    }  

	function load_comp()
	{
	    $result = $this->competencia_model->get_competencias();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre.'</td>';
	        $output .= '<td>'.$row->descripcion.'</td>';
	        $output .= ' <td class="text-nowrap">
	                        <a href="javascript:void(0)" class="edit-row-btn" data="'.$row->id.'" data-toggle="tooltip" data-original-title="Editar"> 
	                        <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
	                        <a href="javascript:void(0)" class="eliminar-row-btn" disabled data="'.$row->id.'" data-toggle="tooltip" data-original-title="Eliminar"> 
	                        <i class="fa fa-close text-danger"></i> </a>
                        </td>';
			$output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}
	
	 public function insert_comp()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('nombre', 'Nombre', 'required');
          $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
           if ($this->form_validation->run() === TRUE) 
            {
	            $param['nombre']         = $this->input->post('nombre');
	            $param['descripcion']    = $this->input->post('descripcion');
			    $result                  = $this->competencia_model->insert_comp($param);
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

     public function update_comp()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('nombre', 'Nombre', 'required');
          $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']             = $this->input->post('id');
	            $param['nombre']         = $this->input->post('nombre');
	            $param['descripcion']    = $this->input->post('descripcion');
		        $result                  = $this->competencia_model->update_comp($param);
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
      public function getdatos_comp()
    {
        $id     = $this->input->get('id');
        $result = $this->competencia_model->getdatos_comp($id);
        echo json_encode($result);      
    }

    /* Mostrar competencias asociadas */

    public function comp_asoc()
    {
        $id     = $this->input->get('id');
        $result = $this->competencia_model->getcomp_asoc($id);
        $msg['resultado']  = FALSE;
        if($result){
        	$msg['resultado']  = $result;
        	
        }else{
        	   $msg['resultado']  = FALSE;
              }

        echo json_encode($msg);
              
    }


    

	 function load_compAsoc()
	{
	    $result = $this->competencia_model->get_competencias();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row):
	        
	        $output .= '<tr class="unread">';
	        $output .= '<td style="width:40px">
					      <div class="checkbox">
					          <input type="checkbox" id="checkbox'.$row->id.'" class="item-select" value="'.$row->id.'">
					          <label for="checkbox'.$row->id.'"></label>
					      </div>
					    </td>';
	        $output .= ' <td class="hidden-xs-down">'.$row->nombre.'</td>';
	        $output .= '<td class="text-nowrap">
	                        <a href="javascript:void(0)" class="eliminar-rel-btn" data="'.$row->id.'" data-toggle="tooltip" data-original-title="Eliminar"> 
	                        <i class="fa fa-close text-danger"></i> </a>
                        </td>';
			$output .= '</tr>';
	       endforeach;
		}

	    echo $output;
	}   

    

    /* Eliminar */

    public function delete_comp()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->competencia_model->delete_comp($id);
	    $msg['comprobador'] = false;
	    if($result)
	    {
	     $msg['comprobador'] = TRUE;
	    }
	 echo json_encode($msg);

	}


    public function verificar_obj($str)
    {
    	$respuesta = $this->competencia_model->verificar_obj($str);
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
