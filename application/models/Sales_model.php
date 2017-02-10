<?php 
	
class Sales_model extends CI_Model{

	function get_all_sales(){
		$this->db->select('accounts.*,outlets.name AS outlet_name');
		$this->db->from('accounts');
		$this->db->join('outlets','outlets.id = accounts.outlet_id');
		$this->db->where('accounts.role','sales');
		return $this->db->get()->result();
	}

	function get_outlet_sales($outlet_id = ''){
		$this->db->select('accounts.*,outlets.name AS outlet_name');
		$this->db->from('accounts');
		$this->db->join('outlets','outlets.id = accounts.outlet_id');
		$this->db->where('accounts.role','sales');
		if($outlet_id != 0){
			$this->db->where('accounts.outlet_id',$outlet_id);	
		}
		
		return $this->db->get()->result();
	}

}

?>