<?php 

	class Configuration_Model extends CI_Model{

		function get_currency_history(){
			$this->db->select('currency_history.*, currency.name');
			$this->db->from('currency_history');
			$this->db->join('currency','currency_history.currency_id=currency.id');
			return $this->db->get()->result();
		} 
		//obtain category according to the types
		function get_category($type_id=''){
			$this->db->select('category.*,type.name as type_name');
			$this->db->from('category');
			$this->db->join('type','category.type_id=type.id');
			$this->db->where('category.type_id',$type_id);
			return $this->db->get()->result();
		}

		function get_tray($outlet_id = ''){
			$this->db->select('tray.*');
			$this->db->from('tray');
			$this->db->where('tray.outlet_id',$outlet_id);
			$this->db->order_by('tray.code','asc');
			return $this->db->get()->result();
		}

	}

 ?>