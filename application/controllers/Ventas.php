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
	   $data['productos']       = $this->producto_model->get_productosStock();
	   $data['clientes']        = $this->cliente_model->get_clientes();
	   $data['numero_correlativo']   = $this->ventas_model->getCorrelativo();
					
	   

	 
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
					$param['fecha']                = $this->input->post('fecha');
					$param['id_cliente']           = $this->input->post('cliente');
					$param['medio_pago']           = $this->input->post('medio_pago');
					$param['numero_correlativo']   = $this->ventas_model->getCorrelativo();
					$param['total']                = $this->input->post('total');

					if ($this->ventas_model->save_venta($param)) {
						$venta_id  = $this->ventas_model->lastID();
						//aumtento el correlativo						
						$this->ventas_model->updateDocificacion();

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
	    $result = $this->ventas_model->getAll();			
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td><a href="javascript:void(0)">'.$row->fecha.'</a></td>';
	        $output .= '<td>'.$row->nombre_cliente.' </td>';
	        $output .= '<td>'.$row->medio_pago.' </td>';
	        $output .= '<td>'.$row->total.' </td>';
	        $output .= '<td> 
					<button title="Detalle de venta" data="'.$row->id.'*'.$row->nombre_cliente.'" data-toggle="modal"  class="btn btn-success btn-circle btn-detalle" type="button"><span class="btn-label"><i class="fa fa-paperclip m-r-10 m-b-10"></i></span></button>
					
					 </td>';
	        $output .= ' <td class="text-nowrap">	                       
	                        <a href="javascript:void(0)"  class="anular-row-btn" data="'.$row->id.'" data-toggle="tooltip" data-original-title="Anular Venta"> 
	                        <i title="Anular Venta" class="fa fa-minus-circle text-danger"></i> </a>
                        </td>';
			$output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}


	function getDetalleVenta()
	{   $id        = $this->input->get('id');
	    $result = $this->ventas_model->getDetalleVentas($id);			
	    $total = 0;
	    $output = '';
	    if(!empty($result))
	    {
			foreach($result as $row):
			  
				$output .='<tr>';
				$output .='<td><a href="javascript:void(0)">'.$row->nombre_producto.'</a></td>';
				$output .='<td>'.$row->cantidad.'</td>';
				$output .='<td>$'.$row->precio.'</td>';
				$output .='<td>$'.$row->importe.'</td>';
				$output .='</tr>';
                $total += $row->importe;
			endforeach;
			$output .='<tr style="color:black;font-weight:bold">';
			$output .='<td>Total</td>';
			$output .='<td></td>';
			$output .='<td></td>';
			$output .='<td > $'.number_format($total,2,",",".").'</td>';
			
			$output .='<tr>';

		       
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

     public function update()
    {
      
		$param['id']        = $this->input->get('id');
		$param['estado']    = 'anulado';
		$result             = $this->ventas_model->updateVenta($param);
		$msg['comprobador']      = FALSE;

		if($result)
				{
				$msg['comprobador'] = TRUE;
				}
			echo json_encode($msg);

		    
    }
   


	/* Eliminar */





    


}
