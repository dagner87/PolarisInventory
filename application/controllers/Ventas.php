<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');

        $this->load->library('form_validation');

        $this->load->model('proveedor_model');
        $this->load->model('producto_model');
        $this->load->model('entrada_model');       
        $this->load->model('cliente_model');       
        $this->load->model('ventas_model');       
       
         if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }



	
/*----------- CRUD Funcions-----------------------*/ 
    public function addVenta()
	{
	   $data['titulo']    = 'Administar ventas';
	   $data['crud']      = 'venta';
	   $data['camino']    = 'insertar';
	   $data['proveedores']     = $this->proveedor_model->get_proveedores();
	   $data['productos']       = $this->producto_model->get_productos();
	   $data['clientes']        = $this->cliente_model->get_clientes();

	 
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("ventas/v_addVenta",$data);
	   $this->load->view("layout/footer");
    }  


    public function getventas()
	{
	   $data['titulo']    = 'Lista ventas';
	   $data['crud']      = 'ventas';
		  
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("ventas/v_lista_ventas",$data);
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



	 /* insertar */

	 public function insert()
	 {
 
		 if ($this->input->is_ajax_request()) 
		 {
 
			$this->form_validation->set_rules('fecha', 'fecha', 'required');
			$this->form_validation->set_rules('medio_pago', 'Medio de Pago', 'required');
			//$this->form_validation->set_rules('producto', 'Producto', 'required');
			$this->form_validation->set_rules('cliente', 'Cliente', 'required');

			$this->form_validation->set_rules('cantidades[]', 'Cantidades', 'required');
			$this->form_validation->set_rules('precios_venta[]', 'Precio costo', 'required');
 
			if ($this->form_validation->run() === TRUE) 
			 {
					$msg['comprobador']      = FALSE;
					
					/* venta */
					$param['fecha']        = $this->input->post('fecha');
					$param['id_cliente']   = $this->input->post('cliente');
					$param['medio_pago']   = $this->input->post('medio_pago');
					$param['total']        = $this->input->post('total');

					if ($this->ventas_model->save_venta($param)) {
						$venta_id  = $this->ventas_model->lastID();
					}	
					

                    /* Detalle de venta */
					$param['productos']      = $this->input->post('idproductos');
					$param['cantidades']     = $this->input->post('cantidades');
					$param['precios_venta']  = $this->input->post('precios_venta');
					$param['importes']       = $this->input->post('importes');
					
					for ($i = 0; $i < count($param['productos']); $i++) :

						$detalle_venta = array(

							    'producto_id '  => $param['productos'][$i],
							    'venta_id'      => $venta_id,
								'precio'        => $param['precios_venta'][$i],
								'cantidad'      => $param['cantidades'][$i],
								'importe'       => $param['importes'][$i],
								
						);
						
						$updateStock = array(
							'id_producto' => $param['productos'][$i],
							'stock'       => $param['cantidades'][$i],
						);

								  $this->ventas_model->restarStock($updateStock);
						$result = $this->ventas_model->save_detalle($detalle_venta);					


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

	function load_ventas()
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





	function getStocks()
	{
	    $result = $this->entrada_model->getStocks();			
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->nombre_producto.'</td>';
	        $output .= '<td>'.$row->nombre.' </td>';
	        $output .= '<td>'.$row->stock.' </td>';	        
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
		        $result                  = $this->ventas_model->update_are($param);
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
    	$respuesta = $this->ventas_model->verificar_obj($str);
        if($respuesta)
         {
           $this->form_validation->set_message('verificar_obj', 'Este Objetivo ya existe en la bd');
           return FALSE;
        } else {
                return TRUE;
               }	
    }

    


}
