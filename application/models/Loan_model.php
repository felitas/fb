<?php 
	
class Loan_model extends CI_Model{
	//for admin can see all loan from any outlet
	function get_loan_all_outlet(){
		$this->db->select('loan.*,outlets.name as outlet');
		$this->db->from('loan');
		$this->db->join('outlets','outlets.id = loan.outlet_id','left');
		$this->db->order_by('loan.date_due','asc');
		return $this->db->get()->result();
	}
	//all other roles
	function get_loan_this_outlet($outlet_id = ''){
		$this->db->select('loan.*,outlets.name as outlet');
		$this->db->from('loan');
		$this->db->join('outlets','outlets.id = loan.outlet_id','left');
		$this->db->where('loan.outlet_id',$outlet_id);		
		$this->db->order_by('loan.date_due','asc');
		return $this->db->get()->result();
	}

	//USED BY MUTATION
	function get_product_by_code($product_code = '', $outlet_id = ''){
		$this->db->select('products.*,outlets.name as outlet, tray.code as tray, type.name as type, category.name as category');
		$this->db->from('products');
		$this->db->join('outlets','outlets.id = products.outlet_id');
		$this->db->join('tray','tray.id = products.tray_id','left');
		$this->db->join('type','type.code = products.product_type','left');
		$this->db->join('category','category.code = products.product_category','left');
		$this->db->where('products.product_code',$product_code);
		$this->db->where('products.outlet_id',$outlet_id);
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