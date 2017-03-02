<?php 
	
class Loan_model extends CI_Model{
	//for admin can see all loan from any outlet
	function get_loan_all_outlet(){
		$this->db->select('loan.*,outlets.name as outlet,customers.name as customer');
		$this->db->from('loan');
		$this->db->join('outlets','outlets.id = loan.outlet_id','left');
		$this->db->join('customers','customers.customer_code = loan.customer_code');
		$this->db->order_by('loan.date_due','asc');
		return $this->db->get()->result();
	}
	//all other roles no need outlet to be told
	function get_loan_this_outlet($outlet_id = ''){
		$this->db->select('loan.*,outlets.name as outlet,customers.name as customer');
		$this->db->from('loan');
		$this->db->join('customers','customers.customer_code = loan.customer_code');
		$this->db->where('loan.outlet_id',$outlet_id);		
		$this->db->order_by('loan.date_due','asc');
		return $this->db->get()->result();
	}

	//to get customer and sales data
	function get_loan_data($code = ''){
		$this->db->select('loan.*, customers.name as customer_name, customers.phone as customer_phone, customers.address as customer_address, customers.email as customer_mail, customers.birthday as customer_birthday, customers.email as customer_email, customers.ktp as customer_ktp, accounts.name as sales_name');
		$this->db->from('loan');
		$this->db->join('customers','customers.customer_code = loan.customer_code');
		$this->db->join('accounts','accounts.workers_code = loan.workers_code');
		$this->db->where('loan.loan_code',$code);
		return $this->db->get()->row();
	}

	//to get item within loan
	function get_loan_details($code = ''){
		$this->db->select('loan_detail.*');
		$this->db->from('loan_detail');
		$this->db->where('loan_detail.loan_code',$code);
		return $this->db->get()->result();
	}

	//loan history, to see when is the previous due and the sales that do the update
	function get_loan_history($code = ''){
		$this->db->select('loan_history.*,accounts.name as sales_name');
		$this->db->from('loan_history');
		$this->db->join('accounts','accounts.workers_code=loan_history.workers_code');
		$this->db->where('loan_history.loan_code',$code);
		$this->db->order_by('loan_history.date','desc');
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