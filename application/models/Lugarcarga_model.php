<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Lugarcarga_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}
	
    public function get_lugarcarga()
	{
		$query = $this->db->get('lugares_carga');
		return $query->result();
	}

	public function post_lugarcarga($data)
	{
		$this->db->insert('lugares_carga', $data);
 		$id = $this->db->insert_id();		
		$this->db->where('id_lugar_carga',$id);		
		$query = $this->db->get('lugares_carga');		
		return $query->row();
	}

	public function update_lugarCarga($data)
	{
		$this->db->where('id_lugar_carga',$data['id_lugar_carga']);    
        $this->db->update('lugares_carga',$data);
        $this->db->where('id_lugar_carga',$data['id_lugar_carga']);		
		$query = $this->db->get('lugares_carga');	
	  return $query->row();
	}


	public function existencia_lugarCarga($descripcion)
   {
     $this->db->where('descripcion',$descripcion);
	 $this->db->get('lugares_carga');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

	public function delete_lugarCarga($id)
	{
		$this->db->where('id_lugar_carga',$id);
		$this->db->delete('lugares_carga');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
