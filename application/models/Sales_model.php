<?php 
	
class Sales_model extends CI_Model{

	function get_all_sales(){
		$this->db->select('accounts.*,outlets.name AS outlet_name');
		$this->db->from('accounts');
		$this->db->join('outlets','outlets.id = accounts.outlet_id');
		$this->db->where('accounts.role','sales');
		return $this->db->get()->result();
	}

}

?>