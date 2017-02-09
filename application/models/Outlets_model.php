<?php 
	
class Outlets_model extends CI_Model{

	function get_outlet($id = ''){
		$this->db->select('outlets.*,accounts.username,accounts.password');
		$this->db->from('outlets');
		$this->db->join('accounts','accounts.outlet_id = outlets.id');
		$this->db->where('outlets.id',$id);
		return $this->db->get()->row();
	}
	function get_all_outlet_except($id = ''){
		$this->db->select('outlets.*');
		$this->db->from('outlets');
		$this->db->where(array('outlets.id !=' => $id));
		return $this->db->get()->result();
	}
	function get_outlet_code($id = ''){
		$this->db->select('code');
		$this->db->from('outlets');
		$this->db->where(array('id'=>$id));
		return $this->db->get()->row();
	}

}

?>