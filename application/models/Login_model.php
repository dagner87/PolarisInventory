<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct(); 
		$this->load->database();
	}


	public function get_user($data)
	{
		$this->db->select("e.*,u.username,r.descripcion perfil");
        $this->db->join('empleado e','e.id = u.id_empleado');
		$this->db->join('rol r', 'r.id  = u.id_rol');
        $this->db->where('u.username',$data['username']);
		$this->db->where('u.password_hash',$data['password']);
		$query = $this->db->get('user u');
		if($query->num_rows() == 1)
		{
		   return $query->row();
		}else{
			  $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			   redirect(base_url(),'refresh');
		     }
	}



   public function verificar_datos($username)
	{
	   $this->db->where('username',$username);    
        $query = $this->db->get('user');	
        if($query->num_rows() > 0){
	        return true;
	      }else{
	        return false;
	      } 
	}


	public function update_emp($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('user',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}


	public function delete_emp($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
