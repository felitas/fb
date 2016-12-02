<?php 

	class Configuration_Model extends CI_Model{

		function get_currency_history(){
			$this->db->select('currency_history.*, currency.name');
			$this->db->from('currency_history');
			$this->db->join('currency','currency_history.currency_id=currency.id');
			return $this->db->get()->result();
		} 

	}

 ?>