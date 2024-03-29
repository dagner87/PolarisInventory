<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('producto_model');
        $this->load->model('proveedor_model');
        $this->load->model('categoria_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }	
	public function index()
	{
	    $data['crud'] = 'Producto';
		$data['camino']   = 'insertar';
	    $data['titulo']   = 'Sistema de Inventario Polaris';
		
		$data['proveedores']   = $this->proveedor_model->get_proveedores();
		$data['categorias']    = $this->categoria_model->get_categorias();

		$this->load->view("layout/head",$data);
		$this->load->view("layout/menu",$data);
		$this->load->view("producto/v_productos",$data);
	    $this->load->view("layout/footer");
    }

/*----------- CRUD productos-----------------------*/ 


	function load_productos()
	{
	    $result = $this->producto_model->get_listproductos();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre_producto.'</td>'; 
			$output .= '<td>'.$row->peso_neto.' Lb</td>';
			if($row->estado == 'activo'){
				$output .='<td><span class="label label-success">Activo</span></td>';
			}else {
				$output .='<td><span class="label label-danger">Inactivo</span></td>';
			}			
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

          $this->form_validation->set_rules('nombre_producto', 'Nombre Producto', 'required');
          $this->form_validation->set_rules('nombre_producto', 'Nombre del Producto', 'callback_producto_check');
         // $this->form_validation->set_rules('proveedor', 'proveedor', 'required');
          $this->form_validation->set_rules('categoria', 'Categoria', 'required');
          $this->form_validation->set_rules('peso_neto', 'Peso Neto', 'required');
          $this->form_validation->set_rules('genero', 'genero', 'required');
          

          if ($this->form_validation->run() === TRUE) 
            {
	          $param['nombre_producto']  = $this->input->post('nombre_producto');
			  //$param['id_proveedor']     = $this->input->post('proveedor');
			  $param['id_categoria']     = $this->input->post('categoria');
			  $param['description']      = $this->input->post('description');
			  $param['peso_neto']        = $this->input->post('peso_neto');
			  $param['estado']           = $this->input->post('estado');
			  $param['genero']           = $this->input->post('genero');
		      $result                    = $this->producto_model->insert($param);

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

     public function update()
    {
      if ($this->input->is_ajax_request()) 
        {

			$this->form_validation->set_rules('nombre_producto', 'Nombre Producto', 'required');
			$this->form_validation->set_rules('nombre_producto', 'Nombre del Producto', 'callback_producto_check');
			//$this->form_validation->set_rules('proveedor', 'proveedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');
			$this->form_validation->set_rules('peso_neto', 'Peso Neto', 'required');
			$this->form_validation->set_rules('genero', 'genero', 'required');
			

          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']               = $this->input->post('id');
				$param['nombre_producto']  = $this->input->post('nombre_producto');
				//$param['id_proveedor']     = $this->input->post('proveedor');
				$param['id_categoria']     = $this->input->post('categoria');
				$param['description']      = $this->input->post('description');
				$param['peso_neto']        = $this->input->post('peso_neto');
				$param['estado']           = $this->input->post('estado');
				$param['genero']           = $this->input->post('genero');
		        $result                    = $this->producto_model->update($param);
		        $msg['comprobador']        = FALSE;

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
      public function getdatos()
    {
        $id     = $this->input->get('id');
        $result = $this->producto_model->getdatos($id);
        echo json_encode($result);      
    }

    /* Eliminar */

    public function delete()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->producto_model->delete($id);
	    $msg['comprobador'] = false;
	    if($result)
	    {
	     $msg['comprobador'] = TRUE;
	    }
	 echo json_encode($msg);

	}


    public function producto_check($str)
	{

		$exit = $this->producto_model->verificar_existencia($str);
		if ($exit)
		{
		$this->form_validation->set_message('producto_check', 'El %s ya existe en la bd '.$str.'');
		return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

    public function getCargoArea() 
    {
      $id_area = $this->input->get("id_area");
      $data = $this->cargo_model->getCargoArea($id_area);
       echo json_encode($data);
    }


	public function upload_image()
	{
			$config['upload_path']   = 'assets/images';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']      = 4048;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('input-file-events')) {
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

}
