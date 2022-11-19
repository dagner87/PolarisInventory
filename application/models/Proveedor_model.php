<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Proveedor_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

   public function get_proveedores()
	{
	 $resultados = $this->db->get("proveedor");	
     return $resultados->result();
	}

	

	public function getDatos($id)
    {
     $this->db->where('id',$id);
     $query  = $this->db->get('proveedor');
     return $query->row();
    }

    public function get_proveedors_jef()
	{
     $this->db->select("a.*,e.nombre, e.apellidos");
	 $this->db->join('empleado e', 'e.id  = a.id_jefe','left');
	 $resultados = $this->db->get("proveedor pr");
     return $resultados->result();
	}


	
	public function insert($data)
	{
	  $this->db->insert('proveedor',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('proveedor',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('proveedor');
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
        $query = $this->db->get('proveedor');	
        if($query->num_rows() > 0){
	        return true;
	      }else{
	        return false;
	      }
	}


	
}
