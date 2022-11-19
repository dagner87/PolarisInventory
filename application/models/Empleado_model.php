<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Empleado_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}


	public function get_empleados()
	{
	   $this->db->select("e.id,e.nombre, e.apellidos,e.dni,a.descripcion area, c.nombre cargo,e.fecha_ingreso");
       $this->db->join('area a', 'a.id  = e.id_area');
       $this->db->join('cargo c','c.id = e.id_cargo');
       $resultados = $this->db->get("empleado e");
     return $resultados->result();
	}


	 public function get_emp_are($id_area)
	{
	    
       $this->db->select("e.id,e.nombre, e.apellidos,e.dni,a.descripcion area, c.nombre cargo,e.fecha_ingreso");
       $this->db->join('area a', 'a.id  = e.id_area');
       $this->db->join('cargo c','c.id = e.id_cargo');
       $this->db->where('e.id_area',$id_area);  
       $resultados = $this->db->get("empleado e");	
       if($resultados->num_rows() > 0){
	         return $resultados->result();
	    }else{
	        return false;
	     }
	}



	

	public function getdatos_emp($id)
    {
     $this->db->where('id',$id);
     $query_emp            = $this->db->get('empleado');
     $data['datos_emp']    = $query_emp->row();
     $this->db->where('id_area',$query_emp->row()->id_area);
     $query_cargos         = $this->db->get('cargo');
     $data['datos_emp']    = $query_emp->row();
     $data['datos_cargos'] = $query_cargos->result();
     return $data;
    }




   public function listar_areas()
	 {
	     $query = $this->db->get('cargos');
	      if($query->num_rows() > 0){
	        return $query->result();
	      }else{
	        return false;
	      }
	 }

 public function insert_emp($data)
  {
    $this->db->insert('empleado',$data);
    if($this->db->affected_rows() > 0){
          return true;
        
        }else{
          return false;
        }      
  }	 
	
   public function listar_cargos()
	{
	     $query = $this->db->get('cargos');
	      if($query->num_rows() > 0){
	        return $query->result();
	      }else{
	        return false;
	      }
	}

	public function update_emp($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('empleado',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}

	
	public function verificar_dni($dni)
	{
	   $this->db->where('dni',$dni);    
        $query = $this->db->get('empleado');	
        if($query->num_rows() > 0){
	        return true;
	      }else{
	        return false;
	      }
	}

	public function delete_emp($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('empleado');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
