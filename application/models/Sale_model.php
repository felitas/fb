<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Sale_model extends MY_Model
{
	protected $_table	= 'sale';
 
	protected $primary_key	= 'id';

	public function __construct()
	{
		parent::__construct();
	}
	
    /**
     * Fetch all the records in the table. Can be used as a generic call
     * to $this->_database->get() with scoped methods.
     */
    public function get_all()
    {
        $this->trigger('before_get');

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key, (bool)$this->_temporary_only_deleted);
        }

		$this->_database->select($this->_table.'.*, s1.name as sales_name, o1.name as outlet_name, c1.name as cashier, c2.name as customer');
		$this->_database->join('accounts as s1',$this->_table.'.sales_id = s1.id','left');
		$this->_database->join('accounts as c1',$this->_table.'.cashier_id = c1.id','left');
		$this->_database->join('customers as c2',$this->_table.'.customer_code = c2.code','left');
		$this->_database->join('outlets as o1',$this->_table.'.outlet_id = o1.id','left');
		$this->_database->join('sale_detail as sd',$this->_table.'.sale_code = sd.sale_code','left');
		$this->_database->join('products','products.product_code = sd.product_code','left');
		$this->_database->order_by($this->_table.'.date','desc');
        $result = $this->_database->get($this->_table)
                           ->{$this->_return_type(1)}();
        $this->_temporary_return_type = $this->return_type;

        foreach ($result as $key => &$row)
        {
            $row = $this->trigger('after_get', $row, ($key == count($result) - 1));
        }

        $this->_with = array();
        return $result;
    }

	function get_sale_by_outlet($outlet_id = ''){
		$this->db->select('sale.*, s1.name as sales_name, o1.name as outlet_name, c1.name as cashier, c2.name as customer');
		$this->db->from('sale');
		$this->db->join('accounts as s1','sale.sales_id = s1.id','left');
		$this->db->join('accounts as c1','sale.cashier_id = c1.id','left');
		$this->db->join('customers as c2','sale.customer_code = c2.code','left');
		$this->db->join('outlets as o1','sale.outlet_id = o1.id','left');
		if($outlet_id != ''){
			$this->db->where('sale.outlet_id',$outlet_id);	
		}
		$this->db->order_by('sale.date','desc');
		return $this->db->get()->result();
	}

	function get_sale_by_type($type_id = '',$type_name = ''){
		$this->db->select('sale_detail.*,products.name, products.photo, products.real_weight, products.rounded_weight, s1.name as sales_name, c1.name as cashier, c2.name as customer');
		$this->db->from('sale_detail');
		$this->db->join('sale','sale.sale_code = sale_detail.sale_code','left');
		$this->db->join('products','products.product_code = sale_detail.product_code','left');
		$this->db->join('accounts as s1','sale.sales_id = s1.id','left');
		$this->db->join('accounts as c1','sale.cashier_id = c1.id','left');
		$this->db->join('customers as c2','sale.customer_code = c2.code','left');
		$this->db->where('products.type_id',$type_id);	
		$this->db->or_where('products.type',$type_name);	
		$this->db->order_by('sale.date','desc'); 
		return $this->db->get()->result();
	}

	function get_sale_detail($outlet_id = '',$sale_code = ''){
		$this->db->select('sale_detail.*,products.name, products.photo, products.real_weight, products.rounded_weight, s1.name as sales_name, c1.name as cashier, c2.name as customer');
		$this->db->from('sale_detail');
		$this->db->join('sale','sale.sale_code = sale_detail.sale_code','left');
		$this->db->join('products','products.product_code = sale_detail.product_code','left');
		$this->db->join('accounts as s1','sale.sales_id = s1.id','left');
		$this->db->join('accounts as c1','sale.cashier_id = c1.id','left');
		$this->db->join('customers as c2','sale.customer_code = c2.code','left');
		if($outlet_id != 0){
			$this->db->where('sale.outlet_id',$outlet_id);
		}
		$this->db->where('sale.sale_code',$sale_code);
		$this->db->order_by('sale.date','desc');
		return $this->db->get()->result();
	}

}
