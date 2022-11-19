<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('area_model');
        $this->load->model('empleado_model');
        $this->load->model('cargo_model');
        $this->load->library('form_validation');
       
         if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	
/*----------- CRUD Funcions-----------------------*/ 
    public function Get_areas()
	{
	   $data['titulo']    = 'Administar Areas';
	   $data['crud']      = 'Areas';
	   $data['camino']    = 'insertar';
	   $data['areas']     = $this->area_model->get_areasSinJefe();
	   $data['empleados'] = $this->empleado_model->get_empleados();
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("rh/v_areas",$data);
	   $this->load->view("layout/footer");
    }  

	function load_areas()
	{
	    $result = $this->area_model->get_areas_jef();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->descripcion.'</td>';
	        $output .= '<td>'.$row->nombre.' '.$row->apellidos.'</td>';
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
	
	 public function insert_are()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
           if ($this->form_validation->run() === TRUE) 
            {
	            $param['descripcion']    = $this->input->post('descripcion');
			    $result                  = $this->area_model->insert_are($param);
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


    /*Asociar Jefe a Areas*/

    public function asoc_jefearea()
    {
        $data['id_area']  = $this->input->post('idareas');
        $msg['comprobador'] = false;
        if($data['id_area'])
             {
              $data['id_area']  = $this->input->post('idareas');
              $data['id_jefe']  = $this->input->post('idjefes');
             for ($i=0; $i < count($data['id_area']); $i++) { 
                  $param = array(
                      'id'      => $data['id_area'][$i], 
                      'id_jefe' => $data['id_jefe'][$i] 
                  );
                $result = $this->area_model->update_are($param);
            }
              $msg['comprobador'] = $result;
             }
        echo json_encode($msg);
    }

    /* Editar */

     public function update_are()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']             = $this->input->post('id');
	            $param['descripcion']    = $this->input->post('descripcion');
		        $result                  = $this->area_model->update_are($param);
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
      public function getdatos_are()
    {
        $id     = $this->input->get('id');
        $result = $this->area_model->getdatos_are($id);
        echo json_encode($result);      
    }

    /* Eliminar */

    public function delete_are()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->area_model->delete_are($id);
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
