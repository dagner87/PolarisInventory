<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('proveedor_model');
        $this->load->model('producto_model');
        $this->load->model('entrada_model');       
        $this->load->library('form_validation');
       
         if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	
/*----------- CRUD Funcions-----------------------*/ 
    public function add()
	{
	   $data['titulo']    = 'Administar Entradas';
	   $data['crud']      = 'entradas';
	   $data['camino']    = 'insertar';
		 $data['proveedores']     = $this->proveedor_model->get_proveedores();
		 $data['productos']  = $this->producto_model->get_productos();

	 
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("entradas/v_addEntrada",$data);
	   $this->load->view("layout/footer");
    }  


    public function getEntradas()
	{
	   $data['titulo']    = 'Lista Entradas';
	   $data['crud']      = 'entradas';
		  
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("entradas/v_lista_entradas",$data);
	   $this->load->view("layout/footer");
    }  

	function load_entradas()
	{
	    $result = $this->entrada_model->getAll();			
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->fecha_entrada.'</td>';
	        $output .= '<td>'.$row->id_producto.' </td>';
	        $output .= '<td>'.$row->cantidad.' </td>';
	        $output .= '<td>'.$row->precios_costo.' </td>';
	        $output .= '<td> 
					<button data="'.$row->doc_respaldo.'" class="btn btn-success btn-circle" type="button"><span class="btn-label"><i class="fa fa-file-pdf-o"></i></span></button>
					
					 </td>';
	        $output .= ' <td class="text-nowrap">	                       
	                        <a href="javascript:void(0)"  class="eliminar-row-btn" data="'.$row->id.'" data-toggle="tooltip" data-original-title="Eliminar"> 
	                        <i class="fa fa-close text-danger"></i> </a>
                        </td>';
			$output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}



	public function adjunto_entrada()
	{
			$config['upload_path']   = 'assets/respaldos';
			$config['allowed_types'] = 'pdf|jpg|png|docx';
			$config['max_size']      = 4048;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('doc_respaldo')) {
				#Aquí me refiero a "foto", el nombre que pusimos en FormData
				$msg['success']= false;
				$msg['error']= $this->upload->display_errors();
			echo json_encode($msg);

		} else {
				$datos_img     = array('upload_data' => $this->upload->data());
				$msg['imagen'] = $datos_img['upload_data']['file_name'];

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
		        $result                  = $this->entradas_model->update_are($param);
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
        $result = $this->entrada_model->getdatos_are($id);
        echo json_encode($result);      
    }

    /* insertar */

    public function insert()
	{

		if ($this->input->is_ajax_request()) 
        {

					$this->form_validation->set_rules('fecha_entrada', 'fecha', 'required');
					$this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
					$this->form_validation->set_rules('nombre_archivo', 'Doc Respaldo', 'required');
					$this->form_validation->set_rules('cantidades[]', 'Cantidades', 'required');
					$this->form_validation->set_rules('precios_costo[]', 'Precio costo', 'required');

           if ($this->form_validation->run() === TRUE) 
            {
							$msg['comprobador']      = FALSE;
							$param['fecha']          = $this->input->post('fecha_entrada');
							$param['cantidades']     = $this->input->post('cantidades');
							$param['productos']      = $this->input->post('idproductos');
							$param['proveedor']      = $this->input->post('proveedor');
							$param['precios_costo']  = $this->input->post('precios_costo');
							$param['doc_respaldo']   = $this->input->post('nombre_archivo');

							for ($i = 0; $i < count($param['productos']); $i++) :

							$data_detalle = array(
									'fecha_entrada' => $param['fecha'],
									'id_producto'   => $param['productos'][$i],
									'cantidad'      => $param['cantidades'][$i],
									'precios_costo' => $param['precios_costo'][$i],
									'id_proveedor'  => $param['proveedor'],
									'doc_respaldo'  => $param['doc_respaldo'],
							);

								$result = $this->entrada_model->insert($data_detalle);					
							endfor;
							if($result)
		             {
		               $msg['comprobador'] = TRUE;
		             }
		         echo json_encode($msg);

				    } else{
							$msg['validacion'] =  validation_errors('<li>','</li>');
							echo json_encode($msg);
						 }
	      }     

	}


	/* Eliminar */

    public function delete()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->entrada_model->delete($id);
	    $msg['comprobador'] = false;
	    if($result)
	    {
	     $msg['comprobador'] = TRUE;
	    }
	 echo json_encode($msg);

	}






    public function verificar_obj($str)
    {
    	$respuesta = $this->entradas_model->verificar_obj($str);
        if($respuesta)
         {
           $this->form_validation->set_message('verificar_obj', 'Este Objetivo ya existe en la bd');
           return FALSE;
        } else {
                return TRUE;
               }	
    }

    


}
