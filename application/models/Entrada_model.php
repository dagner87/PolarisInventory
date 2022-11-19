<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Entrada_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

   public function get_entradaes()
	{
	 $resultados = $this->db->get("entrada");	
     return $resultados->result();
	}

	

	public function getDatos($id)
    {
     $this->db->where('id',$id);
     $query  = $this->db->get('entrada_productos');
     return $query->row();
    }


	
	public function insert($data)
	{

       $this->db->insert('entrada_productos',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('entrada_productos',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('entrada_productos');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	public function verificar_existencia($data)
	{

	   $this->db->where('nombre_prove',$data);    
	   $this->db->or_where('telefono',$data);    
        $query = $this->db->get('entrada_productos');	
        if($query->num_rows() > 0){
	        return true;
	      }else{
	        return false;
	      }
	}


	
}
