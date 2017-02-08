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
			//FOR ADMIN. SHORTENED NAME CAUSE ADMIN SENT TRANSACTION IS TOO LONG FOR VARIABLE
			$data['all_sents'] = $this->mutation_model->get_all_sent_transactions();
			$data['all_receiveds'] = $this->mutation_model->get_all_received_transactions();
			
			$data['sent_transactions'] = $this->mutation_model->get_sent_transactions($this->session_outlet);
			$data['received_transactions'] = $this->mutation_model->get_received_transactions($this->session_outlet);
			$data['role']=$this->session_role;
			$this->template->load($this->default,'mutation/list_mutation',$data);
		}

		public function list_receiving(){
			$data['title'] = 'Daftar Penerimaan Barang';
			//FOR ADMIN. SHORTENED NAME CAUSE ADMIN SENT TRANSACTION IS TOO LONG FOR VARIABLE
			$data['all_receiveds'] = $this->mutation_model->get_all_pending_received();

			$data['received_transactions'] = $this->mutation_model->get_pending_received($this->session_outlet);
			$data['role']=$this->session_role;
			$this->template->load($this->default,'mutation/list_receiving',$data);
		}

		public function send_item(){
			if($this->session_role == 'sales'){
				redirect('home');	
			}
			if ($this->input->post()) {

				$data_mutation = array(
						'product_qty' 	=> count($this->input->post('product_code')),
						'from_outlet' 	=> $this->input->post('from_outlet'),
						'to_outlet'		=> $this->input->post('to_outlet'),
						'status'		=> 'Pending',
						'date'			=> date('Y-m-d H:i:s')
					);

				$outlet_code = $this->db->get_where('outlets',array('id' => $this->session_outlet))->row('code');
				$code = $this->db->get_where('code',array('code' => $outlet_code.'MUT'))->row();

				if($code){
					$data_mutation['code'] = $code->code.sprintf("%05d", $code->count);
					$this->db->update('code',array('count' => $code->count+1),array('code' => $code->code));
					
				}else{
					$this->db->insert('code',array('code' => $outlet_code.'MUT','count' => 1));
					$data_mutation['code'] = $outlet_code.'MUT'.sprintf("%05d", 1);
					$this->db->update('code',array('count' => 2),array('code' => $outlet_code.'MUT'));
				}

				$this->db->insert('mutation',$data_mutation);

				foreach($this->input->post('product_code') as $product_code){
					$data_product = array(
							'product_code' => $product_code,
							'mutation_code' => $data_mutation['code'],
							'status'		=> 'OK'
						);
					$this->db->insert('mutation_product',$data_product);
					$this->db->update('products',array('status' => 'pending'),array('product_code' => $product_code));
				}

				$this->session->set_flashdata('mutation',"$.gritter.add({
					class_name : 'gritter-light'
				    title: 'Berhasil',
				    text: 'Berhasil mengirim barang',
				    time : 1200
				});");	

				redirect('mutation');
			

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

		public function receive_item($mutation_code = ''){
			$this->load->model('configuration_model');
			//sales cannot access
			if($this->session_role == 'sales'){
				redirect('home');	
			}
			else{
				$mutation = $this->db->get_where('mutation',array('code' => $mutation_code))->row();
			
				if ($this->input->post()) {

					for($i = 0; $i < count($this->input->post('checked_code')); $i++){
						$data_update = array(
								'tray_id' => $this->input->post('tray')[$i],
								'outlet_id' => $this->session_outlet,
								'status'	=> 'available'
							);
						$this->db->update('products',$data_update,array('product_code' => $this->input->post('checked_code')[$i]));
					}

					if($this->db->update('mutation',array('status' => 'Diterima'),array('code' => $this->input->post('mutation_code')))){
						$this->session->set_flashdata('success',"$.gritter.add({
							class_name : 'gritter-light',
						    title: 'Berhasil',
						    text: 'Barang berhasil diterima',
						    time: 1200
						});");	

						redirect('mutation');
					}
				}
				else{
					//EACH STORE CAN ONLY RECEIVE MUTATION TO THEIR OWN OUTLET, UNLESS ADMIN
					if($mutation->to_outlet == $this->session_outlet){
						$data['title'] = "Penerimaan Barang";
						$data['trays'] = $this->configuration_model->get_tray($this->session_outlet);
						$data['mutation'] = $this->mutation_model->get_mutation_location($mutation_code);
						$data['received_items'] = $this->mutation_model->get_received_items($mutation_code);
						$this->template->load($this->default,'mutation/receive_item',$data);
					}
					else if($this->session_role=='admin'){

						$data['title'] = "Penerimaan Barang";
						$admin_outlet = $mutation->to_outlet;
						$data['trays'] = $this->configuration_model->get_tray($admin_outlet);
						$data['mutation'] = $this->mutation_model->get_mutation_location($mutation_code);
						$data['received_items'] = $this->mutation_model->get_received_items($mutation_code);
						$this->template->load($this->default,'mutation/receive_item',$data);
					}
					else{
						redirect('mutation');
					}	
				}
			}
		}

		public function get_product_from_mutation($product_code = '',$mutation_code = ''){
			$product = $this->mutation_model->get_mutation_product($product_code, $mutation_code);
			if($product == NULL){
				echo 'not found';
			}else{
				$product = (Object) $product;
				echo json_encode($product);	
			}
		}
	}
?>