<?php 
	
class Crud_model extends CI_Model{

	function insert_data($table,$data){
		if($this->db->insert($table,$data)){
			return true;
		}else{
			return false;
		}
	}

	function update_data($table,$data,$condition){
		if($this->db->update($table,$data,$condition)){
			return true;
		}else{
			return false;
		}
	}

	function get_data($table){
		return $this->db->get($table);
	}

	function get_by_condition($table,$condition){
		return $this->db->get_where($table,$condition);
	}

	function delete_data($table,$condition){
		if($this->db->delete($table,$condition)){
			return true;
		}else{
			return false;
		}
	}

	

}

?>