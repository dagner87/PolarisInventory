<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Rol_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}
	
    public function get_rol()
	{
		$query = $this->db->get('rol');
		return $query->result();
	}

	public function post_rol($data)
	{
		$this->db->insert('rol', $data);
 		$id = $this->db->insert_id();		
		$this->db->where('id_rol',$id);		
		$query = $this->db->get('rol');		
		return $query->row();
	}

	public function update_rol($data)
	{
		$this->db->where('id_rol',$data['id_rol']);    
        $this->db->update('rol',$data);
        $this->db->where('id_rol',$data['id_rol']);		
		$query = $this->db->get('rol');	
			
      return $query->row();
	}

	public function delete_rol($id)
	{
		$this->db->where('id_rol',$id);
		$this->db->delete('rol');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
