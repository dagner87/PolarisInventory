<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Tractor_model extends CI_Model {
	
	public function __construct() {
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		parent::__construct();
		$this->load->database();
	}
	
    public function get_tractores()
	{
		$query = $this->db->get('tractor');
		return $query->result();
	}

	public function post_tractores($data)
	{
		$this->db->insert('tractor', $data);

		$id = $this->db->insert_id();		
		$this->db->where('id_tractor',$id);		
		$query = $this->db->get('tractor');		
		return $query->row();
	}

	public function update_tractor($data)
	{
		$this->db->where('id_tractor',$data['id_tractor']);    
        $this->db->update('tractor',$data);
        $this->db->where('id_tractor',$data['id_tractor']);		
		$query = $this->db->get('tractor');	
			
      return $query->row();
	}

	public function delete_tractor($id)
	{
		$this->db->where('id_tractor',$id);
		$this->db->delete('tractor');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
