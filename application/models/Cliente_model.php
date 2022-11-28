<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Cliente_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

   public function get_clientes()
	{
	 $resultados = $this->db->get("cliente");	
     return $resultados->result();
	}

	

	public function getDatos($id)
    {
     $this->db->where('id',$id);
     $query  = $this->db->get('cliente');
     return $query->row();
    }

  


	
	public function insert($data)
	{
	  $this->db->insert('cliente',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('cliente',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('cliente');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	public function verificar_existencia($data)
	{

	   $this->db->where('nombre_cliente',$data);    
	   $this->db->or_where('telefono',$data);    
        $query = $this->db->get('cliente');	
        if($query->num_rows() > 0){
	        return true;
	      }else{
	        return false;
	      }
	}


	public function searchCliente($cliente){
		$this->db->or_like('telefono', $cliente);
		$query = $this->db->like('nombre_cliente', $cliente);
		$query  = $this->db->get('cliente');
		   return $query->row();
	}


	
}
