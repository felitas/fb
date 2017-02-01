<?php 
	
class Product_model extends CI_Model{
	//TO GET PRODUCT DETAIL ALONG WITH TRAY AND OUTLET NAME AND TYPE
	function get_product_all_outlet(){
		$this->db->select('products.*,outlets.name as outlet, tray.code as tray,type.name as type,category.name as category');
		$this->db->from('products');
		$this->db->join('outlets','outlets.id = products.outlet_id');
		$this->db->join('tray','tray.id = products.tray_id');
		$this->db->join('type','type.code = products.product_type');
		$this->db->join('category','category.code = products.product_category');
		$this->db->where('products.status','available');
		$this->db->order_by('products.status','asc');
		return $this->db->get()->result();
	}

	function get_product_outlet($outlet_id = '',$status=''){
		$this->db->select('products.*,outlets.name as outlet, tray.code as tray');
		$this->db->from('products');
		$this->db->join('outlets','outlets.id = products.outlet_id');
		$this->db->join('tray','tray.id = products.tray_id');
		$this->db->join('type','type.code = products.product_type');
		if($outlet_id != 0){
			$this->db->where('products.outlet_id',$outlet_id);	
		}
		if($status == ''){
			$this->db->where('products.status','available');	
		}elseif($status !=''){
			$this->db->where('products.status',$status);
		}
		
		$this->db->order_by('products.status','asc');
		return $this->db->get()->result();
	}

	function get_product_by_code($product_code = '', $outlet_id = ''){
		$this->db->select('products.*,outlets.name as outlet, tray.code as tray, type.name as type, category.name as category');
		$this->db->from('products');
		$this->db->join('outlets','outlets.id = products.outlet_id');
		$this->db->join('tray','tray.id = products.tray_id');
		$this->db->join('type','type.code = products.product_type');
		$this->db->join('category','category.code = products.product_category');
		$this->db->where('products.product_code',$product_code);
		if($outlet_id != 0){
			$this->db->where('products.outlet_id',$outlet_id);	
		}
		$this->db->where('products.status','available');
		$this->db->order_by('products.status','asc');
		return $this->db->get()->row();
	}

	function get_product_detail($product_code = ''){
		$this->db->select('products.*,outlets.name as outlet, tray.code as tray');
		$this->db->from('products');
		$this->db->join('outlets','outlets.id = products.outlet_id');
		$this->db->join('tray','tray.id = products.tray_id');
		$this->db->join('gold_amount','gold_amount.id = products.gold_amount');
		$this->db->where('products.product_code',$product_code);
		$this->db->order_by('products.product_code','asc');
		return $this->db->get()->row();
	}

	
}

?>