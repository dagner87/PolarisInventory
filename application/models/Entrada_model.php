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
		$data['year'] = date('Y');
		$this->db->select("ent.*,prov.nombre_prove");
		$this->db->where('YEAR(fecha)', $data['year']);
		$this->db->join("proveedor prov","prov.id = ent.id_proveedor");	
		//$this->db->order_by("ent.fecha", "desc");
	    $resultados = $this->db->get("entrada ent");	
     return $resultados->result();
	}


   public function getStocks()
	{
		
		$this->db->select("p.nombre_producto,p.genero,stk.stock,stk.estado,stk.id");
		$this->db->join("categoria c","stk.id_categoria = c.id");
		$this->db->join("producto p","stk.id_producto = p.id");
		$this->db->where('stk.stock >',0);
		$this->db->where('stk.estado','activo');
	    $this->db->order_by("stk.stock", "desc");
	    $resultados = $this->db->get("productos_stock stk");	

		//var_dump($resultados->result());
	 
     return $resultados->result();
	}

	

	public function getDatos($id)
    {
     $this->db->where('id',$id);
     $query  = $this->db->get('entrada');
	 
     return $query->row();
    }


	public function lastID(){
		return $this->db->insert_id();
	}

	
	public function insert($data)
	{

       $this->db->insert('entrada',$data);
	    if($this->db->affected_rows() > 0){
	        return true;
	       }else{
	             return false;
	            }      
	}	
	
	public function save_detalle($data){
		return $this->db->insert("detalle_entrada",$data);
	}

	
  	public function update($data)
	{
		$this->db->where('id',$data['id']);    
        $this->db->update('entrada',$data);
        if($this->db->affected_rows() > 0){
          return true;        
        }else{
          return false;
        } 
    
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('entrada');
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


	public function totalInventario()
	{
		$data['year'] = date('Y');
		
		$this->db->select_sum('total');       
        $this->db->where('YEAR(fecha)', $data['year']);        
        $this->db->from('entrada');

        $query = $this->db->get();
        if ($query->row()->total == null) {
            return 0;
        }
        return $query->row()->total;
		
	}

	/* SELECT sum(`stock`) total FROM `productos_stock` WHERE estado ='activo';  */
	public function cantidadInventario()
	{
		
		$this->db->select_sum('stock');       
        $this->db->where('estado', 'activo');        
        $this->db->from('productos_stock');

        $query = $this->db->get();
        if ($query->row()->stock == null) {
            return 0;
        }
        return $query->row()->stock;
		
	}

	public function ajuste_stock($data){

		//var_dump($data);

		//TODO
		/** Insertar en la tabla de ajuste_stock
		 *  actualizar la cantidad de stock
		 */
      
		 $data_insert = array( 
			'id_stock'    => $data['id_stock'],
			'cantidad'    => $data["cantidad"],			
			'motivo'      => $data["motivo"]
		 );
     $this->db->insert("ajuste_stock",$data_insert);


	 // Restar la cantidad en la tabla productos_stock
     $this->db->set('stock', 'stock - '.$data["cantidad"], FALSE);
	 $this->db->where("id",$data['id_stock']);
	 $this->db->update("productos_stock");
       
        // Finalizar la transacción
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Si la transacción falla, puedes manejar el error aquí
            return false;
        } else {
            return true;
        }   
	}


	
}
