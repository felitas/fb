<?php 
	
class Outlets_model extends CI_Model{

	function get_outlet($id = ''){
		$this->db->select('outlets.*,accounts.username,accounts.password');
		$this->db->from('outlets');
		$this->db->join('accounts','accounts.outlet_id = outlets.id');
		$this->db->where('outlets.id',$id);
		return $this->db->get()->row();
	}

}

?>