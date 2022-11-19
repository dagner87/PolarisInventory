<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Persona_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}
	
    public function get_persona()
	{
		$this->db->select("p.*,u.first_name,u.last_name,u.email,u.phone,r.id_rol as rol");
        $this->db->from("persona p");
		$this->db->join("users u","u.id_user = p.id_persona");
		$this->db->join("persona_rol pr","pr.id_persona = p.id_persona");
		$this->db->join("rol r","r.id_rol = pr.id_rol");
		$query = $this->db->get();
		return $query->result();
	}

	public function post_persona($data)
	{
		$this->db->insert('persona', $data);
 		$id = $this->db->insert_id();		
		$this->db->where('id_persona',$id);		
		$query = $this->db->get('persona');		
		return $query->row();
	}

   public function put_persona($data)
	{
		$this->db->where('id_persona',$data['id_persona']);
        $this->db->update('persona',$data);
        $this->db->where('id_persona',$data['id_persona']);
        $query = $this->db->get('persona');		
		if($this->db->affected_rows() > 0){
          return $query->row();
        }else{
          return false;
        }

	}

	public function update_user($data)
	{
		$this->db->where('id_user',$data['id_user']);
        $this->db->update('users',$data);
        $query = $this->db->get('users');
        if($this->db->affected_rows() > 0){
          return $query->row();
        }else{
          return false;
        }

	}

		

   public function existencia_cuit($cuit)
   {
     $this->db->where('cuit_cuil',$cuit);
	 $this->db->get('persona');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

   public function existencia_email($email)
   {
     $this->db->where('email',$email);
	 $this->db->get('users');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

   public function existencia_idPersona($id_persona)
   {
     $this->db->where('id_persona',$id_persona);
	 $this->db->get('persona');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

   public function existencia_idRol($id_rol)
   {
     $this->db->where('id_rol',$id_rol);
	 $this->db->get('rol');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

   public function existencia_PersonaRol($id_persona_rol)
   {
     $this->db->where('id_persona_rol',$id_persona_rol);
	 $this->db->get('persona_rol');
     if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
   }

   public function insert_user($data)
	{
		$this->db->insert('users', $data);
 		
	}

	public function insert_persona_rol($data)
	{
		$this->db->insert('persona_rol', $data);
 		
	}

	public function update_persona_rol($data)
	{
		$this->db->select('id_persona_rol');
		$this->db->where('id_persona',$data['id_persona']);    
        $this->db->where('id_rol',$data['id_rol']);	
        $query = $this->db->get('persona_rol');		
        $id_persona_rol =  $query->row();

        $this->db->where('id_persona_rol',$id_persona_rol);    
        $this->db->update('persona_rol',$data);
        
	}

   public function update_persona($data)
	{
		
		$this->db->where('id_persona',$data['id_persona']);    
        $this->db->update('persona',$data);
        $this->db->where('id_persona',$data['id_persona']);		
		$query = $this->db->get('persona');	
	    return $query->row();
	}
    
    public function delete_persona($id)
	{
		$this->db->where('id_persona',$id);
		$this->db->delete('persona');
		$this->db->where('id_user',$id);
		$this->db->delete('users');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
