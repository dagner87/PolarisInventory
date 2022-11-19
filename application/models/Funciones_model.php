<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Funciones_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}

	public function get_funciones()
	{
	 $resultados = $this->db->get("funciones");
     return $resultados->result();
	}


	public function getdatos_fun($id)
    {
     $this->db->where('id',$id);
     $query_emp  = $this->db->get('funciones');
     return $query_emp->row();
    }

 

 public function insert_fun($data)
  {
    $this->db->insert('funciones',$data);
    if($this->db->affected_rows() > 0){
          return true;
        
        }else{
          return false;
        }      
  }	 
	
  	public function update_fun($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('funciones',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete_fun($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('funciones');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
