<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Categoria_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

    public function get_categorias()
	{
	    $resultados = $this->db->get("categoria");	
        return $resultados->result();
	}	

	public function getcategoriaArea($id_area){
		$this->db->where("id_area",$id_area);
		$resultados = $this->db->get("categoria");
		return $resultados->result();
	}

/* Obtener los datos dado un id de categoria */

	public function getdatos($id){
		 $this->db->where('id',$id);
        $query_emp  = $this->db->get('categoria');
        return $query_emp->row();
	}



	public function insert($data)
	{
	  $this->db->insert('categoria',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	


    public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('categoria',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
		
	public function delete($id)
	{
	 $this->db->where('id',$id);
	 $this->db->delete('categoria');
	 if($this->db->affected_rows() > 0){
		return true;
	  }else{
		return false;
	  }
	}

	


	
}
