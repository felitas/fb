<?php

	defined('BASEPATH') or exit('No direct script access allowed');

	class Mutation extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('mutation_model');
		}

		public function index(){
			$data['title'] = 'Mutasi';
			$data['is_mobile'] = $this->is_mobile;
			$data['sent_transactions'] = $this->mutation_model->get_sent_transactions($this->session_outlet);
			$data['received_transactions'] = $this->mutation_model->get_received_transactions($this->session_outlet);
			$data['role']=$this->session_role;
			$this->template->load($this->default,'mutation/list_mutation',$data);
		}

		public function send_item(){
			if($this->session_role == 'sales'){
				redirect('home');	
			}
			if ($this->input->post()) {

				$data_mutation = array(
						'product_qty' 	=> count($this->input->post('product_code')),
						'from_outlet' 	=> $this->session_outlet,
						'to_outlet'		=> $this->input->post('to_outlet'),
						'status'		=> 'Pending',
						'date'			=> date('Y-m-d H:i:s')
					);

				$outlet_code = $this->db->get_where('outlets',array('id' => $this->session_outlet))->row('code');
				$code = $this->db->get_where('code',array('code' => $outlet_code.'MUT'))->row();

				if($code){
					$data_mutation['mutation_code'] = $code->code.sprintf("%05d", $code->count);
					$this->db->update('code',array('count' => $code->count+1),array('code' => $code->code));
					
				}else{
					$this->db->insert('code',array('code' => $outlet_code.'MUT','count' => 1));
					$data_mutation['mutation_code'] = $outlet_code.'MUT'.sprintf("%05d", 1);
					$this->db->update('code',array('count' => 2),array('code' => $outlet_code.'MUT'));
				}

				$this->db->insert('mutation',$data_mutation);

				foreach($this->input->post('product_code') as $product_code){
					$data_product = array(
							'product_code' => $product_code,
							'mutation_code' => $data_mutation['mutation_code'],
							'status'		=> 'OK'
						);
					$this->db->insert('mutation_product',$data_product);
					$this->db->update('products',array('status' => 'pending'),array('product_code' => $product_code));
				}

				$this->session->set_flashdata('success',"$.Notify({
				    caption: 'Berhasil',
				    content: 'Berhasil mengirim barang',
				    type: 'success'
				});");	

				redirect('home');
			

			}else{
				$this->load->model('outlets_model');
				//admin has freedom to choose from which outlet to receive and send
				$data['outlets_admin'] = $this->crud_model->get_data('outlets')->result();
				$data['session_outlet']=$this->session_outlet;
				$data['role'] = $this->session_role;
				
				$data['outlets'] = $this->outlets_model->get_all_outlet_except($this->session_outlet);
				$data['title'] = 'Kirim Barang';	
				$this->template->load($this->default,'mutation/send_item',$data);
			}
			
		}

	}
?>