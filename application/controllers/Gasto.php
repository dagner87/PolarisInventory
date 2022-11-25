<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gasto extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('gasto_model');      
        $this->load->library('form_validation');

        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
       
    }
	
/*----------- CRUD Funcions-----------------------*/ 
    public function getAll()
	{
	   $data['titulo']    = 'Administar gastos';
	   $data['crud']      = 'gasto';
	   $data['camino']    = 'insertar';
	   $this->load->view("layout/head",$data);
	   $this->load->view("layout/menu");
	   $this->load->view("gasto/v_gastos",$data);
	   $this->load->view("layout/footer");
    }  

	function load()
	{
	    $result = $this->gasto_model->getAll();
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr>';
	        $output .= '<td>'.$row->fecha.'</td>';
	        $output .= '<td>'.$row->concepto.'</td>';
	        $output .= '<td> $'.$row->monto.'</td>';
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
	
	 public function insert()
    {
      if ($this->input->is_ajax_request()) 
        {

          $this->form_validation->set_rules('fecha', 'Fecha', 'required');
          $this->form_validation->set_rules('concepto', 'Concepto', 'required');
          $this->form_validation->set_rules('monto', 'Monto', 'required');
		  $this->form_validation->set_rules('concepto', 'Concepto', 'callback_verificar_dato');
        
           if ($this->form_validation->run() === TRUE) 
            {
	            $param['fecha']         = $this->input->post('fecha');
	            $param['concepto']      = $this->input->post('concepto');
	            $param['monto']         = $this->input->post('monto');
			    $result                 = $this->gasto_model->insert($param);
		        $msg['comprobador']     = FALSE;

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

			$this->form_validation->set_rules('fecha', 'Fecha', 'required');
			$this->form_validation->set_rules('concepto', 'Concepto', 'required');
			$this->form_validation->set_rules('monto', 'Monto', 'required');
			$this->form_validation->set_rules('concepto', 'Concepto', 'callback_verificar_dato');

          if ($this->form_validation->run() === TRUE) 
            {
	            $param['id']            = $this->input->post('id');
	            $param['fecha']         = $this->input->post('fecha');
	            $param['concepto']      = $this->input->post('concepto');
	            $param['monto']         = $this->input->post('monto');
		        $result                 = $this->gasto_model->update($param);
		        $msg['comprobador']     = FALSE;

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
        $result = $this->gasto_model->getdatos($id);
        echo json_encode($result);      
    }
    
    

    /* Eliminar */

    public function delete()
	{
	    $id      = $this->input->get('id');
	    $result  =  $this->gasto_model->delete($id);
	    $msg['comprobador'] = false;
	    if($result)
	    {
	     $msg['comprobador'] = TRUE;
	    }
	 echo json_encode($msg);

	}


    public function verificar_dato($str)
    {
    	$respuesta = $this->gasto_model->verificar_datos($str);
		if ($respuesta)
		{
		$this->form_validation->set_message('verificar_dato', 'El %s  "'.$str.'" ya existe en la bd');
		return FALSE;
		}
		else
		{
			return TRUE;
		}
    }   

	
}
