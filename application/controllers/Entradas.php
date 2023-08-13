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
		$this->load->model('gasto_model');   

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
	   $data['productos']       = $this->producto_model->get_productos();

	 
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


    public function stock()
	{
	   $data['titulo']    = 'Lista Stocks';
	   $data['crud']      = 'stock';
		  
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("stock/v_stocks",$data);
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
	        $output .= '<td>'.$row->fecha.'</td>';
	        $output .= '<td>'.$row->invoice.' </td>';
	        $output .= '<td>'.$row->nombre_prove.' </td>';
	        $output .= '<td> $'.$row->total.' </td>';
	        $output .= '<td> 
					<button data="'.$row->doc_respaldo.'" class="attach btn btn-success btn-circle" type="button"><span class="btn-label "><i class="fa fa-file-pdf-o"></i></span></button>
					
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


	function getStocks()
	{
	    $result = $this->entrada_model->getStocks();			
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
			$count++;
	        $output .= '<tr>'; 
	        $output .= '<td><span class="round"><img src="assets/images/no-image.png" alt="avatar" width="50"></span></td>';
	        $output .= '<td>'.$row->nombre_producto.'</td>';
	        $output .= '<td>'.$row->genero.' </td>';
	        $output .= '<td ><input style="width: 77px;" type="number"  min="0" name="stock" value="'.$row->stock.'" > </td>';	        
			if($row->estado == 'activo'){
				$output .='<td><span class="label label-success">Activo</span></td>';
			}else {
				$output .='<td><span class="label label-danger">Inactivo</span></td>';
			}	
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
		        $result                  = $this->entradas_model->update($param);
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
    /* insertar */

    public function insert()
	{

		if ($this->input->is_ajax_request()) 
        {

					$this->form_validation->set_rules('fecha_entrada', 'fecha', 'required');
					$this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
					
					$this->form_validation->set_rules('shipping', 'Costo envio', 'required');
					$this->form_validation->set_rules('invoice', '# Factura Proveedor', 'required');
					
					$this->form_validation->set_rules('nombre_archivo', 'Doc Respaldo', 'required');
					$this->form_validation->set_rules('cantidades[]', 'Cantidades', 'required');
					$this->form_validation->set_rules('precios_costo[]', 'Precio costo', 'required');
					

					

           if ($this->form_validation->run() === TRUE) 
            {
							$msg['comprobador']      = FALSE;

							$param['fecha']          = $this->input->post('fecha_entrada');
							$param['proveedor']      = $this->input->post('proveedor');
							$param['cantidades']     = $this->input->post('cantidades');
							$param['productos']      = $this->input->post('idproductos');
							$param['total']          = $this->input->post('total');
							
							$param['invoice']       = $this->input->post('invoice');
							$param['shipping']      = $this->input->post('shipping');
							
							$param['importes']       = $this->input->post('importes');
							$param['precio_costo']  = $this->input->post('precios_costo');
							$param['doc_respaldo']  = $this->input->post('nombre_archivo');

                            if ($param['shipping'] > 0) {

								$row = $this->proveedor_model->getDatos($param['proveedor']);
								$concepto = "(SHIPPING) ({$row->nombre_prove})Invoice - {$param['invoice']}";
	
									$gastos_envio  = array(
										'concepto'  => $concepto,
										'monto'     => $param['shipping'],
										'fecha'     => $param['fecha'],
									);
	
									/* Gastos de envio */
								$resp = 	$this->gasto_model->insert($gastos_envio);	
							}

						// Entrada 
						      $new_entrada = array (
								'fecha'         => $param['fecha'],
								'id_proveedor'  => $param['proveedor'],
								'doc_respaldo'  => $param['doc_respaldo'],
								'invoice'       => $param['invoice'],
								'total'          => $param['total']
								
							  );
							  
							  if ($this->entrada_model->insert($new_entrada)) {
								$id_entrada  = $this->entrada_model->lastID();
							}



							for ($i = 0; $i < count($param['productos']); $i++) :

								$data_detalle = array(
									    'id_entrada'    => $id_entrada,
										'id_producto'   => $param['productos'][$i],
										'cantidad'      => $param['cantidades'][$i],
										'precio_costo'  => $param['precio_costo'][$i],
										'importe'       => $param['importes'][$i],
										
								);								
								
								$updateStock = array(
									'id_producto' => $param['productos'][$i],
									'stock'       => $param['cantidades'][$i],
								);

								 /* Actualizo el stock */
								 $this->entrada_model->updateStock($updateStock);
								$result = $this->entrada_model->save_detalle($data_detalle);					


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
