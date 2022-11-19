<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Destino_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}
	
    public function get_destino()
	{
		$query = $this->db->get('destino');
		return $query->result();
	}

	public function post_destino($data)
	{
		$this->db->insert('destino', $data);
 		$id = $this->db->insert_id();		
		$this->db->where('id_destino',$id);		
		$query = $this->db->get('destino');		
		return $query->row();
	}

	public function update_destino($data)
	{
		$this->db->where('id_destino',$data['id_destino']);    
        $this->db->update('destino',$data);
        $this->db->where('id_destino',$data['id_destino']);		
		$query = $this->db->get('destino');	
	  return $query->row();
	}


	public function existencia_destino($descripcion)
   {
     $this->db->where('descripcion',$descripcion);
	 $this->db->get('destino');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

	public function delete_destino($id)
	{
		$this->db->where('id_destino',$id);
		$this->db->delete('destino');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
