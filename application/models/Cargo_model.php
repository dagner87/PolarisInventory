<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Cargo_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

    public function get_cargos()
	{
	   $this->db->select("c.id,c.nombre,c.descripcion,a.descripcion area");
       $this->db->join('area a', 'a.id  = c.id_area');
       $resultados = $this->db->get("cargo c");
     return $resultados->result();
	}	

	public function getCargoArea($id_area){
		$this->db->where("id_area",$id_area);
		$resultados = $this->db->get("cargo");
		return $resultados->result();
	}

/* Obtener los datos dado un id de cargo */

	public function getdatos_carg($id){
		 $this->db->where('id',$id);
        $query_emp  = $this->db->get('cargo');
        return $query_emp->row();
	}



	public function insert_carg($data)
	{
	  $this->db->insert('cargo',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	


    public function update_carg($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('cargo',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
		
	public function delete_carg($id)
	{
	 $this->db->where('id',$id);
	 $this->db->delete('cargo');
	 if($this->db->affected_rows() > 0){
		return true;
	  }else{
		return false;
	  }
	}

	public function asoc_comp_cargo($data)
	 {
	  $this->db->insert('competencias_cargo',$data);
	  if($this->db->affected_rows() > 0){
	        return true;
	    }else{
	           return false;
	          }      
	}	



	
}
