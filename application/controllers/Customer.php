<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Customer extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('customer_model');
		}

		public function index(){
			//customer main page
			
			$data['title'] = 'Customer';
			$data['role']= $this->session_role;
			$data['is_mobile'] = $this->is_mobile;
			$data['customers'] = $this->customer_model->get_all_customers();
			$this->template->load($this->default,'customer/list_customer',$data);
		
		}

		public function add_customer(){
			$data['role']= $this->session_role; 
			if($this->input->post()){
				$year = date('y');
				$code = $this->db->get_where('code',array('code' => 'FBC'.$year))->row();
				
				if($code){
					$customer_code = $code->code.sprintf("%06d", $code->count);
					$this->db->update('code',array('count' => $code->count+1),array('code' => $code->code));

					
				}else{
					$this->db->insert('code',array('code' =>'FBC'.$year,'count' => 1));
					$customer_code = 'FBC'.$year.sprintf("%06d", 1);
					$this->db->update('code',array('count' => 2),array('code' => 'FBC'.$year));
				}

				$data_customer = array(
					'customer_code' =>$customer_code,
            		'name' => $this->input->post('customer_name'),
            		'birthday'=> $this->input->post('customer_birthday'),
            		'type' => $this->input->post('customer_type'),
            		'phone' => $this->input->post('customer_phone'),
            		'email' => $this->input->post('customer_email'),
            		'address' =>$this->input->post('customer_address'),
            		'grade'=> $this->input->post('customer_grade'),
            		'outlet_id' => $this->session->user_outlet
            	);	
				
	            if($this->crud_model->insert_data('customers',$data_customer)){
	            	$this->session->set_flashdata('customer', "$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Customer berhasil dibuat!',
				 		time: 2000
				 	});");	
	            }else{
	            	$this->session->set_flashdata('customer', "$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Customer gagal dibuat!',
				 		time: 2000
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
				 		time: 2000
				 	});");
	            }else{
	            	$this->session->set_flashdata('customer', "$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Gagal!',
				 		text:	'Customer gagal diubah!',
				 		time: 2000
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
				 		time: 2000
				 	});");
				redirect('customer');
			}else{
				$this->session->set_flashdata('customer',"$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Customer gagal dihapus!',
				 		time: 2000
				 	});");
				redirect('customer');
			}
			
			
		}

		
		//used in new sale ajax
		public function get_customer($code = ''){
			$customer = $this->db->get_where('customers',array('customer_code' => $code))->row();
			if($customer == NULL){
				echo 'not found';
			}else{
				$customer = (Object) $customer;
				echo json_encode($customer);	
			}
		}

		public function get_new_customer_code(){
			$code = $this->db->get_where('code',array('code' => 'FBC'))->row();
			if($code){
				$data['customer_code'] = $code->code.sprintf("%07d", $code->count);
				$data['hidden_customer_code'] = $code->code;
				$data['hidden_customer_count'] = $code->count;
			}else{
				$this->db->insert('code',array('code' => 'FBC','count' => 1));
				$data['customer_code'] = 'FBC'.sprintf("%07d", 1);
				$data['hidden_customer_code'] = 'FBC';
				$data['hidden_customer_count'] = 1;
			}
			$data = (Object) $data;
			echo json_encode($data);
		}

	}

?>