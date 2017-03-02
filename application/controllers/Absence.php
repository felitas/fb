<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Absence extends MY_Controller{
		function __construct(){
			parent::__construct();
			if($this->session_role == 'sales'){
				redirect('home');
			}
		}

		public function index(){
			//customer main page
			
			$data['title'] = 'Absensi';
			$data['role']= $this->session_role;
			$data['is_mobile'] = $this->is_mobile;
			$data['customers'] = $this->customer_model->get_all_customers();
			$this->template->load($this->default,'customer/list_customer',$data);
		
		}

		public function new_absence(){
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
            		'ktp'=>$this->input->post('customer_ktp'),
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
				$data['grades'] = $this->crud_model->get_data('customer_grade')->result();
				$data['is_mobile'] = $this->is_mobile;
				$this->template->load($this->default,'customer/add_customer',$data);
			}
		}

		
	}

?>