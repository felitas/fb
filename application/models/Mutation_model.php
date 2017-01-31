<?php 
	
class Mutation_model extends CI_Model{

	function get_sent_items($id = ''){
		$this->db->select('mutation.*, o1.name as from_outlet, o2.name as to_outlet');
		$this->db->from('mutation');
		$this->db->join('outlets as o1','mutation.from_outlet = o1.id');
		$this->db->join('outlets as o2','mutation.to_outlet = o2.id');
		$this->db->where('mutation.from_outlet',$id);
		return $this->db->get()->result();
	}

	function get_received_transactions($id = ''){
		$this->db->select('mutation.*, o1.name as from_outlet, o2.name as to_outlet');
		$this->db->from('mutation');
		$this->db->join('outlets as o1','mutation.from_outlet = o1.id');
		$this->db->join('outlets as o2','mutation.to_outlet = o2.id');
		$this->db->where('mutation.to_outlet',$id);
		$this->db->order_by('mutation.status','desc');
		return $this->db->get()->result();
	}

	function get_received_items($code = ''){
		$this->db->select('mutation_product.*, p.name, p.real_weight, p.rounded_weight, p.photo');
		$this->db->from('mutation_product');
		$this->db->join('products as p','mutation_product.product_code = p.product_code','left');
		$this->db->where('mutation_product.mutation_code',$code);
		return $this->db->get()->result();
	}

	function get_mutation_product($product_code = '', $mutation_code = ''){
		$this->db->select('mutation_product.*');
		$this->db->from('mutation_product');
		$this->db->where('mutation_product.product_code',$product_code);
		$this->db->where('mutation_product.mutation_code',$mutation_code);
		return $this->db->get()->row();
	}

	function get_mutation_detail($outlet_id = '',$mutation_code = ''){
		$this->db->select('mutation_product.*, products.name, products.photo, products.real_weight, products.rounded_weight');
		$this->db->from('mutation_product');
		$this->db->join('mutation','mutation.mutation_code = mutation_product.mutation_code','left');
		$this->db->join('products','products.product_code = mutation_product.product_code','left');
		$this->db->where('mutation.mutation_code',$mutation_code);
		$this->db->order_by('mutation.date','desc');
		return $this->db->get()->result();
	}
}

?>