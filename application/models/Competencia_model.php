<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Competencia_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

   public function get_competencias()
	{
	 $resultados = $this->db->get("competencias");
     return $resultados->result();
	}

	/* me devuelve todas las competencias que tiene un cargo */
	public function getcomp_asoc($id)
	{
			
	  $this->db->select("c.id,c.nombre,c.descripcion");
	  $this->db->from("competencias_cargo cc");
      $this->db->join("competencias c","c.id = cc.id_competencia");
      $this->db->where("cc.id_cargo",$id);
      $query = $this->db->get();
	  if($query->num_rows() > 0){
            return $query->result();
	    }else{
	             return false;
	           }
    }



	public function getdatos_comp($id)
    {
     $this->db->where('id',$id);
     $query_emp  = $this->db->get('competencias');
     return $query_emp->row();
    }


	
	public function insert_comp($data)
	{
	  $this->db->insert('competencias',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update_comp($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('competencias',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete_comp($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('competencias');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
