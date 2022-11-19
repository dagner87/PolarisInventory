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
	    $result = $this->producto_model->get_productos();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre_producto.'</td>';       
	        $output .= '<td>'.$row->nombre_prove.'</td>';			
			$output .= '<td>'.$row->peso_neto.' lb</td>';
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
          $this->form_validation->set_rules('proveedor', 'proveedor', 'required');
          $this->form_validation->set_rules('categoria', 'Categoria', 'required');
          $this->form_validation->set_rules('peso_neto', 'Peso Neto', 'required');
          $this->form_validation->set_rules('genero', 'genero', 'required');
          

          if ($this->form_validation->run() === TRUE) 
            {
	          $param['nombre_producto']  = $this->input->post('nombre_producto');
			  $param['id_proveedor'] = $this->input->post('proveedor');
			  $param['id_categoria'] = $this->input->post('categoria');
			  $param['description']  = $this->input->post('description');
			  $param['peso_neto']    = $this->input->post('peso_neto');
			  $param['estado']       = $this->input->post('estado');
			  $param['genero']       = $this->input->post('genero');
		        $result       = $this->producto_model->insert($param);
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
			$this->form_validation->set_rules('proveedor', 'proveedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');
			$this->form_validation->set_rules('peso_neto', 'Peso Neto', 'required');
			$this->form_validation->set_rules('genero', 'genero', 'required');
			

          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']               = $this->input->post('id');
				$param['nombre_producto']  = $this->input->post('nombre_producto');
				$param['id_proveedor']     = $this->input->post('proveedor');
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


    public function verificar_dni($str) 
    {
    	$respuesta = $this->producto_model->verificar_dni($str);
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
