<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Api_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function login_user($email,$password)
	{
		$this->db->select('id_emp,perfil,email,nombre_emp,firmo_contrato');
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get('emprendedor');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url(),'refresh');
		}
	}
	public function login_user_app($email,$password)
	{
		$this->db->select('id_emp,perfil,email,nombre_emp,apellido,firmo_contrato,foto_emp');
		$this->db->where('email',$email);
		$this->db->where('password',$password);  
		$this->db->where('perfil','emprendedor');
		$query = $this->db->get('emprendedor');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			return false;
		}
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
