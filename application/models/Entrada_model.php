<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Entrada_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();

	}

   public function getAll()
	{
		
		$this->db->join("producto p","ent.id_producto = p.id");	
	   $resultados = $this->db->get("entrada_productos ent");	
     return $resultados->result();
	}


   public function getStocks()
	{
		$this->db->join("categoria c","stk.id_categoria = c.id");
		$this->db->join("producto p","stk.id_producto = p.id");
	    $resultados = $this->db->get("productos_stock stk");	
	 
     return $resultados->result();
	}

	

	public function getDatos($id)
    {
     $this->db->where('id',$id);
     $query  = $this->db->get('entrada_productos');
     return $query->row();
    }


	
	public function insert($data)
	{

       $this->db->insert('entrada_productos',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	 
	
  	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('entrada_productos',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('entrada_productos');
		if($this->db->affected_rows() > 0){
			return true;
		  }else{
			return false;
		  }
	}


	public function updateStock($data){
		
		$this->db->where("id_producto",$data['id_producto']);
		$this->db->from("productos_stock");
		$resultados = $this->db->get();
		
		if($resultados->num_rows() > 0){

          $this->db->where("id_producto",$data['id_producto']);
          $this->db->set('stock', 'stock + "'.$data["stock"].'"', FALSE);
		  $this->db->update("productos_stock");

        }else{

         $row =	$this->datosproducto($data['id_producto']);

        	$data_insert = array( 
		        		           'id_producto' => $data['id_producto'],
		        		           'stock'       => $data["stock"],
		        		           'id_categoria'=> $row->id_categoria,
		        		           'estado'      => 'activo'
        		                );

         
          	$this->db->insert("productos_stock",$data_insert);
        }
	}


	public function datosproducto($id_producto){
        $this->db->where('id', $id_producto);
        $query = $this->db->get('producto');
        if($query->num_rows() > 0){
          return $query->row();
        }else{
          return false;
        }
    } 


	
}
