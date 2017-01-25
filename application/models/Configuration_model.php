<?php 

	class Configuration_Model extends CI_Model{

		function get_currency_history(){
			$this->db->select('currency_history.*, currency.name');
			$this->db->from('currency_history');
			$this->db->join('currency','currency_history.currency_id=currency.id');
			return $this->db->get()->result();
		} 
		//obtain category according to the types
		function get_category($type_code=''){
			$this->db->select('category.*,type.name as type_name');
			$this->db->from('category');
			$this->db->join('type','category.type_code=type.code');
			$this->db->where('category.type_code',$type_code);
			return $this->db->get()->result();
		}

		function get_tray($outlet_id = ''){
			$this->db->select('tray.*');
			$this->db->from('tray');
			$this->db->where('tray.outlet_id',$outlet_id);
			$this->db->order_by('tray.code','asc');
			return $this->db->get()->result();
		}
		//ajax to check type uniqueness in database
		function check_type_code($type_code){
			if($this->db->get_where('type',array('code' => $type_code))->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		//ajax to check category uniqueness in each type in database
		function check_category_code($category_code){
			if($this->db->get_where('category',array('code'=>$category_code))->num_rows()>0 ){
				return true;
			}else{
				return false;
			}
		}

		function check_model_code($model_code){
			if($this->db->get_where('model',array('code'=>$model_code))->num_rows()>0 ){
				return true;
			}else{
				return false;
			}	
		}

	}

 ?>