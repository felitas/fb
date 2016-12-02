<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Product extends MY_Controller{
		function __construct(){
			parent::__construct();
		}

		public function index(){
			//customer main page
			
			$data['title'] = 'Product';
			$data['is_mobile'] = $this->is_mobile;
			$this->template->load($this->default,'product/list_product',$data);
		
		}

		public function add_product(){
			if($this->input->post()){
	            $data_product = array(

	            		'name' => $this->input->post('product_name'),
	            		'type' => $this->input->post('product_type'),

	            	);

	            if($this->crud_model->insert_data('products',$data_product)){
	            	$this->session->set_flashdata('product',"$.Notify({
					    caption: 'Berhasil',
					    content: 'Berhasil tambah produk',
					    type: 'success'
					});");	
	            }else{
	            	$this->session->set_flashdata('product',"$.Notify({
					    caption: 'Gagal',
					    content: 'Gagal menambah produk',
					    type: 'alert'
					});");
	            }
	            
	            redirect('product/add_product');

			}else{
				$data['title'] = 'Product';
				$data['is_mobile'] = $this->is_mobile;
				
				$this->template->load($this->default,'product/add_product',$data);
			}
		}

		public function edit_customer($cust_id = ''){
			if($this->input->post()){
	            $data_customer = array(

	            		'name' => $this->input->post('customer_name'),
	            		'type' => $this->input->post('customer_type'),
	            		'phone' => $this->input->post('customer_phone'),
	            		'email' => $this->input->post('customer_email'),
	            		'address' =>$this->input->post('customer_address')

	            	);

	            if($this->crud_model->update_data('customers',$data_customer,array('id' => $cust_id))){
	            	$this->session->set_flashdata('customer',"$.Notify({
					    caption: 'Berhasil',
					    content: 'Berhasil edit customer',
					    type: 'success'
					});");
	            }else{
	            	$this->session->set_flashdata('Customer',"$.Notify({
					    caption: 'Gagal',
					    content: 'Gagal edit customer',
					    type: 'success'
					});");
	            }
	            
	            redirect('customer');

			}else{
				$data['title'] = 'Customer';
				$data['is_mobile'] = $this->is_mobile;
				$data['customer'] = $this->crud_model->get_by_condition('customers',array('id' => $cust_id))->row();
				$this->template->load($this->default,'customer/edit_customer',$data);
			}
		}

		public function delete_customer($cust_id = ''){
		
			if($this->crud_model->delete_data('customers',array('id' => $cust_id))){
				$this->session->set_flashdata('customer', "$.Notify({caption: 'Berhasil !', content: 'Customer berhasil dihapus', type: 'info'});");
			}else{
				$this->session->set_flashdata('customer', "$.Notify({caption: 'Gagal !', content: 'Customer gagal dihapus', type: 'alert'});");
			}
			
			redirect('customer');
		}

		

	}

?>