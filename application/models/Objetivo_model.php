<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Objetivo_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}


	public function get_objetivo()
	{
	 $resultados = $this->db->get("objetivo");
     return $resultados->result();
	}

	public function getdatos_obj($id)
    {
     $this->db->where('id',$id);
     $query_emp  = $this->db->get('objetivo');
     return $query_emp->row();
    }


    public function get_obj_emp($id)
    {
   	 $this->db->select("o.id,o.nombre,o.descripcion"); 	
     $this->db->join('objetivo o', 'o.id  = eo.id_objetivo');
     $this->db->where('eo.id_empleado',$id);
     $query_emp  = $this->db->get('empleado_objetivo eo');
      if($query_emp->num_rows() > 0){
            return $query_emp->result();
	    }else{
	             return false;
	           }
    } 

 public function insert_obj($data)
  {
    $this->db->insert('objetivo',$data);
    if($this->db->affected_rows() > 0){
          return true;
        
        }else{
          return false;
        }      
  }	 
	
  	public function update_obj($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('objetivo',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
	}

	public function asoc_obj_emp($data)
	 {
	  $this->db->insert('empleado_objetivo',$data);
	  if($this->db->affected_rows() > 0){
	        return true;
	    }else{
	           return false;
	          }      
	}	



	public function delete_obj($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('objetivo');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
