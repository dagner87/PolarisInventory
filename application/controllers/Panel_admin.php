<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel_admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->model('empleado_model');
        $this->load->model('entrada_model');
        $this->load->model('gasto_model');
        $this->load->model('ventas_model');
        $this->load->model('reporte_model');
        $this->load->model('objetivo_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('perfil') === false || $this->session->userdata('perfil') !== 'administrador') {
            redirect(base_url() . 'login');
       }
    }

	
	public function index()
	{
	   $data['crud'] = '';
	   $data['titulo']   = 'Administrador';
	   $data['totalGastos']       =   $this->gasto_model->totalGastos();
	   $data['totalInventario']   =   $this->entrada_model->totalInventario();
	   $data['totalVentas']       =   $this->ventas_model->totaVentas();
	   $data['total_stock']       =   $this->entrada_model->cantidadInventario();

	   $data['ganaciasBrutas']   =  $data['totalVentas'] - ($data['totalGastos'] +   $data['totalInventario']);

	   //var_dump($data['x_genero']);
	   
		$this->load->view("layout/head",$data);
		$this->load->view("layout/menu",$data);
		$this->load->view("layout/dashboard",$data);
		$this->load->view("reportes/graficas",$data);
	    $this->load->view("layout/footer");
    }


    function load_emp_a()
	{
	 
	    $id = $this->input->get('id');
	    if ($id) {
		   $result = $this->empleado_model->get_emp_are($id);
		 }else {
		     $result = $this->empleado_model->get_empleados();
		    } 

	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      { 
	        $incial  =  substr($row->nombre, 0,3);
	        $output .= '<tr>';
	        $output .= '<td><span class="round round-success">'.$incial.'</span></td>';
	        $output .= ' <td><h6>'.$row->nombre.' '.$row->apellidos.' </h6><small class="text-muted">'.$row->cargo.'</small></td>';
	       	$output .= '<td>'.$row->dni.'</td>';
			$output .= '<td>'.$row->area.'</td>';
			$output .= '<td>'.$row->fecha_ingreso.'</td>';
	        $output .= ' <td><button type="button" data="'.$row->id.'*'.$row->nombre.'*'.$row->apellidos.' "data-toggle="tooltip" data-original-title="Evaluar"  
	                         class="btn btn-outline-primary eva-row-btn">
	                        <i class="fa fa-check"></i> Evaluar</button>';
            $output .= ' <button type="button" data="'.$row->id.'*'.$row->nombre.'*'.$row->apellidos.' "data-toggle="tooltip" data-original-title="Objetivos"  
	                         class="btn btn-outline-success obj-row-btn">
	                        <i class="fa fa-suitcase"></i> Objetivos</button> '; 
           /* $output .= ' <button type="button" data="'.$row->id.'*'.$row->nombre.'*'.$row->apellidos.' "data-toggle="tooltip" data-original-title="Competencias"  
	                         class="btn btn-outline-secondary comp-row-btn">
	                        <i class="fa fa-address-card-o"></i> Competencias</button>
                         </td>';*/  

		    $output .= '</td>';
		    $output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}





	function get_obj_emp()
	{

		$id = $this->input->get('id');
		$result = $this->objetivo_model->get_obj_emp($id);
		$output = '';

		if ($result) {
			foreach($result as $row):
	    	$output .= '<div class="card">
	            <div class="card-header" role="tab" id="headingOne">
	                <h5 class="mb-0">
	                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row->id.'" aria-expanded="true" aria-controls="collapseOne">
	                 '.$row->nombre.'                                                      
	                </a>
	                </h5> 
	                <div class="row">
	                  <div class="col-sm-6">
	                        <div class="form-group">
	                            <label class="control-label">Ponderación</label>
	                            <input id="ponderacion" type="number" value="10" name="ponderacion[]"  class="col-md-3 form-control"
	                            data-bts-button-down-class="btn btn-secondary btn-outline" 
	                            data-bts-button-up-class="btn btn-secondary btn-outline"> 
	                        </div>
	                    </div>
	                     <div class="col-sm-6">
	                        <div class="form-group">
	                            <label class="control-label">Evaluación</label>
	                            <input id="" type="number" value="10" name="evaluacion[]"  class="col-md-3 form-control evaluacion"
	                            data-bts-button-down-class="btn btn-secondary btn-outline" 
	                            data-bts-button-up-class="btn btn-secondary btn-outline"> 
	                        </div>
	                     </div>
	                 </div>
	           </div>

	            <div id="collapse'.$row->id.'" class="collapse" role="tabpanel" aria-labelledby="headingOne">
	                <div class="card-body slimtest1">
	                 <p align="center">
	                    
                       '.$row->descripcion.'
	                    
	                </p>  
	                </div>
	            </div>
	                </div>';	    	
		endforeach; 
			
		} else {

			$output.= '<div class="alert alert-warning"  id="msg_tbl"> 
	                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
	                        <p>Aún no tiene objetivos asociados </p>
	                    </div> ';


		}

	    

      echo $output;
   }
 

	function load_emp_obj()
	{
	   
		 $id = $this->input->get('id');
	    if ($id) {
		   $result = $this->empleado_model->get_emp_are($id);
		 }else {
		      $result = $this->objetivo_model->get_objetivo(); 
		    } 	

	    
	    $count = 0;
	    $output = '';
	    if(!empty($result))
	    {
	      foreach($result as $row)
	      {  
	        $output .= '<tr class="unread">';
	        $output .= '<td style="width:40px">
					      <div class="checkbox">
					          <input type="checkbox" id="checkbox'.$row->id.'" checked  class="item-select" value="'.$row->id.'">
					          <label for="checkbox'.$row->id.'"></label>
					      </div>
					    </td>';

	        $output .= '<td>'.$row->nombre.'</td>';
	        $output .= '<td>'.$row->descripcion.'</td>';
	       	$output .= '</tr>';
	       }
		       
	  		}
	    echo $output;
	}


	 public function asoc_obj()
    {
        $msg['comprobador'] = false;
        if($this->input->post('id_emp'))
          {
            $data['id_empleado']  = $this->input->post('id_emp');
            $data['id_objetivo']  = $this->input->post('obj');

             for ($i=0; $i < count($data['id_objetivo']); $i++):
                  $param = array(
                      'id_empleado'   => $data['id_empleado'], 
                      'id_objetivo'   => $data['id_objetivo'][$i] 
                  );
                 $result = $this->objetivo_model->asoc_obj_emp($param);
             endfor;
              $msg['comprobador'] = $result;
          } else {
            $msg['comprobador'] = false;

          }
          echo json_encode($msg);
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
