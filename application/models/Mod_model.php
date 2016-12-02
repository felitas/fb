<?php 

	class Mod_model extends CI_Model{

		function get_model($type_id = ''){
			$this->db->select('model.*, category.name as category_name, type.name as type_name');
			$this->db->from('model');
			$this->db->join('category','model.category_id = category.id');
			$this->db->join('type','type.id = category.type_id');
			$this->db->where('type.id',$type_id);
			return $this->db->get()->result();

		}


	}




 ?>