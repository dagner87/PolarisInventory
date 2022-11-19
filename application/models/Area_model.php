<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Area_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

   public function get_areas()
	{
	 $resultados = $this->db->get("area");
     return $resultados->result();
	}

	 public function get_areasSinJefe()
	{
	 $this->db->where('id_jefe', null);		
	 $resultados = $this->db->get("area");
     return $resultados->result();
	}

	public function getdatos_are($id)
    {
     $this->db->where('id',$id);
     $query_emp  = $this->db->get('area');
     return $query_emp->row();
    }

    public function get_areas_jef()
	{
     $this->db->select("a.*,e.nombre, e.apellidos");
	 $this->db->join('empleado e', 'e.id  = a.id_jefe','left');
	 $resultados = $this->db->get("area a");
     return $resultados->result();
	}


	
	public function insert_are($data)
	{
	  $this->db->insert('area',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update_are($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('area',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete_are($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('area');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
