<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Gasto_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		

	}

   public function getAll()
	{
		
	 $this->db->select("g.*,DATE_FORMAT(g.fecha,'%b,%d/%Y') as fecha");
	 $resultados = $this->db->get("gastos g");
     return $resultados->result();
	}

	/* me devuelve todas las gastos que tiene un cargo */
	public function getcomp_asoc($id)
	{
			
	  $this->db->select("c.id,c.nombre,c.descripcion");
	  $this->db->from("gastos_cargo cc");
      $this->db->join("gastos c","c.id = cc.id_gasto");
      $this->db->where("cc.id_cargo",$id);
      $query = $this->db->get();
	  if($query->num_rows() > 0){
            return $query->result();
	    }else{
	             return false;
	           }
    }



	public function getdatos($id)
    {
     $this->db->where('id',$id);
     $query_emp  = $this->db->get('gastos');
     return $query_emp->row();
    }


	
	public function insert($data)
	{
	  $this->db->insert('gastos',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('gastos',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('gastos');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	public function verificar_datos($data)
	{
		$this->db->where('concepto',$data);
		$query = $this->db->get('gastos');	
		if($query->num_rows() > 0){
			return true;
			}else{
			return false;
			}
	}



	public function totalGastos()
	{
		$data['year'] = date('Y');
		
		$this->db->select_sum('monto');       
        $this->db->where('YEAR(fecha)', $data['year']);        
        $this->db->from('gastos');

        $query = $this->db->get();
        if ($query->row()->monto == null) {
            return 0;
        }
        return $query->row()->monto;
		
	}



	
}
