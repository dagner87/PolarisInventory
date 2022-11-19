<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('area_model');
        $this->load->model('empleado_model');
        $this->load->model('cargo_model');
        $this->load->model('competencia_model');
        $this->load->library('form_validation');
       
         if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	
/*----------- CRUD Cargo-----------------------*/ 
    public function Get_cargos()
	{
	   $data['titulo']       = 'Administar Cargos';
	   $data['crud']         = 'Cargo';
	   $data['camino']       = 'insertar';
	   $data['areasSJ']      = $this->area_model->get_areasSinJefe();
	   $data['areas']        = $this->area_model->get_areas();
	   $data['cargos']       = $this->cargo_model->get_cargos();
	   $data['competencias'] = $this->competencia_model->get_competencias();
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("rh/v_cargos",$data);
	   $this->load->view("layout/footer");
    }  

	function load_carg()
	{
	    $result = $this->cargo_model->get_cargos();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
          $output .= '<td>'.$row->nombre.'</td>';
	        $output .= '<td>'.$row->descripcion.'</td>';
	        $output .= '<td>'.$row->area.'</td>';
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
	
	 public function insert_carg()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('nombre', 'Nombre Cargo', 'required');
          $this->form_validation->set_rules('descripcion', 'Descripcion del Puesto', 'required');
          $this->form_validation->set_rules('area', 'Area', 'required');
           if ($this->form_validation->run() === TRUE) 
            {
	            $param['nombre']         = $this->input->post('nombre');
              $param['descripcion']    = $this->input->post('descripcion');
              $param['id_area']        = $this->input->post('area');
			        $result                  = $this->cargo_model->insert_carg($param);
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


    /*------------- Editar ------------------*/
     public function update_carg()
    {
      if ($this->input->is_ajax_request()) 
        {
          $this->form_validation->set_rules('area', 'Area', 'required');
          $this->form_validation->set_rules('nombre', 'Nombre Cargo', 'required');
          $this->form_validation->set_rules('descripcion', 'Descripcion del Puesto', 'required');
           if ($this->form_validation->run() === TRUE) 
            {
              $param['id']             = $this->input->post('id');
              $param['nombre']         = $this->input->post('nombre');
              $param['descripcion']    = $this->input->post('descripcion');
              $param['id_area']        = $this->input->post('area');
              $result                  = $this->cargo_model->update_carg($param);
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

   /*--------------asociar competencias---------------------*/
    public function asoc_comp()
    {
        $msg['comprobador'] = false;
        if($this->input->post('id_cargo'))
          {
            $data['id_cargo']        = $this->input->post('id_cargo');
            $data['id_competencia']  = $this->input->post('comp');

             for ($i=0; $i < count($data['id_competencia']); $i++):
                  $param = array(
                      'id_cargo'       => $data['id_cargo'], 
                      'id_competencia' => $data['id_competencia'][$i] 
                  );
                $result = $this->cargo_model->asoc_comp_cargo($param);
             endfor;
              $msg['comprobador'] = $result;
          } else {
            $msg['comprobador'] = false;

          }
          echo json_encode($msg);
    }

    /* Obtener Datos */
      public function getdatos_carg()
    {
        $id     = $this->input->get('id');
        $result = $this->cargo_model->getdatos_carg($id);
        echo json_encode($result);      
    }

    /* Eliminar */

    public function delete_carg()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->cargo_model->delete_carg($id);
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
