<?php 
	
class Customer_model extends CI_Model{

	function get_all_customers(){
		$this->db->select('customers.*,customer_grade.name as customer_grade');
		$this->db->from('customers');
		$this->db->join('customer_grade','customers.grade = customer_grade.id');
		return $this->db->get()->result();
	}

	function get_customer_detail($code = ''){
		$this->db->select('customers.*');
		$this->db->from('customers');
		$this->db->where('customers.code',$code);
		return $this->db->get()->row();
	}


}

?>