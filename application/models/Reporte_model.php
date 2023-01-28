<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Reporte_model extends CI_Model {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		

	}


	/* SELECT p.genero,sum(pstk.stock) AS 'total' FROM productos_stock pstk JOIN producto p ON pstk.id_producto = p.id GROUP BY p.genero; */

	public function stock_genero(){
		$this->db->select('p.genero, sum(pstk.stock) as total');
		$this->db->from('productos_stock as pstk');
		$this->db->join("producto p","pstk.id_producto = p.id");
		$this->db->group_by("p.genero");
		$query = $this->db->get();		
		
	  return $query->result();
	}


	/* SELECT p.nombre_producto, COUNT(dv.cantidad)
	 FROM `detalle_venta` dv 
	 JOIN producto p 
	 ON p.id = dv.producto_id 
	 GROUP BY dv.producto_id; */

	public function getMoreSell(){
		$this->db->select('p.nombre_producto,p.genero, sum(dv.cantidad) as cantidad');
		$this->db->from('detalle_venta as dv');
		$this->db->join("producto p","dv.producto_id = p.id");
		$this->db->group_by("dv.producto_id");
		$query = $this->db->get();		
		
	  return $query->result();
	}


	


	public function totalGastos()
	{
		$data['year'] = date('Y');
		
		$this->db->select_sum('monto');       
        $this->db->where('YEAR(fecha)', $data['year']);        
        $this->db->from('gastos');

        $query = $this->db->get();
        if ($query->row()->monto == null) {
            return 0;
        }
        return $query->row()->monto;
		
	}

	



	
}
