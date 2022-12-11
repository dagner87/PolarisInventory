<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Producto_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}


	public function get_productos()
	{  
		//$this->db->select_max('ent.precios_costo', 'precios_costo');
		/* $this->db->select("p.id,p.nombre_producto,p.estado ,p.peso_neto, stk.stock stock, ent.precio_costo precios_costo");
		$this->db->join('productos_stock stk', 'stk.id_producto  = p.id');
		$this->db->join('detalle_entrada ent', 'ent.id_producto  = p.id');
		$this->db->where('stock >', 0); */
		$this->db->where('p.estado', 'activo');		
	   $resultados = $this->db->get("producto p");
     return $resultados->result();
	}


	public function get_listproductos()
	{  
	  $resultados = $this->db->get("producto p");
     return $resultados->result();
	}





	 public function get_emp_are($id_area)
	{
	    
       $this->db->select("e.id,e.nombre, e.apellidos,e.dni,a.descripcion area, c.nombre cargo,e.fecha_ingreso");
       $this->db->join('area a', 'a.id  = e.id_area');
       $this->db->join('cargo c','c.id = e.id_cargo');
       $this->db->where('e.id_area',$id_area);  
       $resultados = $this->db->get("producto e");	
       if($resultados->num_rows() > 0){
	         return $resultados->result();
	    }else{
	        return false;
	     }
	}



	

	public function getdatos($id)
    {
      $this->db->where('id',$id);
      $query  = $this->db->get('producto');
      return $query->row();
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

 public function insert($data)
  {
    $this->db->insert('producto',$data);
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

	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('producto',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}

	
	public function verificar_existencia($data)
	{

	   $this->db->where('nombre_producto',$data); 
        $query = $this->db->get('producto');	
        if($query->num_rows() > 0){
	        return true;
	      }else{
	        return false;
	      }
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('producto');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	
}
