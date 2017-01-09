<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Customer extends MY_Controller{
		function __construct(){
			parent::__construct();
		}

		public function index(){
			//customer main page
			
			$data['title'] = 'Customer';
			$data['role']= $this->session_role; //admin can see, add and edit customer grade
			$data['is_mobile'] = $this->is_mobile;
			$data['customers'] = $this->crud_model->get_data('customers')->result();
			$this->template->load($this->default,'customer/list_customer',$data);
		
		}

		public function add_customer(){
			$data['role']= $this->session_role; //admin can see, add and edit customer grade
			if($this->input->post()){
				if($data['role']=='admin'){
					$data_customer = array(
	            		'name' => $this->input->post('customer_name'),
	            		'birthday'=> $this->input->post('customer_birthday'),
	            		'type' => $this->input->post('customer_type'),
	            		'phone' => $this->input->post('customer_phone'),
	            		'email' => $this->input->post('customer_email'),
	            		'address' =>$this->input->post('customer_address'),
	            		'grade'=> $this->input->post('customer_grade'),
	            		'outlet_id' => $this->session->user_outlet
	            	);	
				}else{
					$data_customer = array(
	            		'name' => $this->input->post('customer_name'),
	            		'birthday'=> $this->input->post('customer_birthday'),
	            		'type' => $this->input->post('customer_type'),
	            		'phone' => $this->input->post('customer_phone'),
	            		'email' => $this->input->post('customer_email'),
	            		'address' =>$this->input->post('customer_address'),
	            		'outlet_id' => $this->session->user_outlet
	            	);
				}
	            

	            if($this->crud_model->insert_data('customers',$data_customer)){
	            	$this->session->set_flashdata('customer', "$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Customer berhasil dibuat!',
				 		sticky: false
				 	});");	
	            }else{
	            	$this->session->set_flashdata('customer', "$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Customer gagal dibuat!',
				 		sticky: false
				 	});");
	            }
	            
	            redirect('customer/add_customer');

			}else{
				$data['title'] = 'Customer';
				$data['is_mobile'] = $this->is_mobile;
				$this->template->load($this->default,'customer/add_customer',$data);
			}
		}

		public function edit_customer($cust_id = ''){
			$data['role']= $this->session_role; //admin can see, add and edit customer grade
			if($this->input->post()){
	            if($data['role']=='admin'){
					$data_customer = array(
	            		'name' => $this->input->post('customer_name'),
	            		'birthday'=> $this->input->post('customer_birthday'),
	            		'type' => $this->input->post('customer_type'),
	            		'phone' => $this->input->post('customer_phone'),
	            		'email' => $this->input->post('customer_email'),
	            		'address' =>$this->input->post('customer_address'),
	            		'grade'=> $this->input->post('customer_grade'),
	            		'outlet_id' => $this->session->user_outlet
	            	);	
				}else{
					$data_customer = array(
	            		'name' => $this->input->post('customer_name'),
	            		'birthday'=> $this->input->post('customer_birthday'),
	            		'type' => $this->input->post('customer_type'),
	            		'phone' => $this->input->post('customer_phone'),
	            		'email' => $this->input->post('customer_email'),
	            		'address' =>$this->input->post('customer_address'),
	            		'outlet_id' => $this->session->user_outlet
	            	);
				}

	            if($this->crud_model->update_data('customers',$data_customer,array('id' => $cust_id))){
	            	$this->session->set_flashdata('customer', "$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Customer berhasil diubah!',
				 		sticky: false
				 	});");
	            }else{
	            	$this->session->set_flashdata('customer', "$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Gagal!',
				 		text:	'Customer gagal diubah!',
				 		sticky: false
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
				$this->session->set_flashdata('customer',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Customer berhasil dihapus!',
				 		sticky: false
				 	});");
			}else{
				$this->session->set_flashdata('customer',"$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Customer gagal dihapus!',
				 		sticky: false
				 	});");
			}
			
			redirect('customer');
		}

		

	}

?>