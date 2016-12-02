<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Outlets extends MY_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('outlets_model');
			if($this->session_role != 'admin'){
				redirect('home');
			}
		}

		public function index(){
			
			$data['title'] = 'Outlet';
			$data['is_mobile'] = $this->is_mobile;
			$data['outlets'] = $this->crud_model->get_data('outlets')->result();
			$this->template->load($this->default,'outlets/list_outlet',$data);
		
		}

		public function add_outlet(){
			
			//process the insertion
			if($this->input->post()){
				$data_outlet = array(
						'name'			=> $this->input->post('outlet_name'),
						'code'			=> $this->input->post('outlet_code'),
						'phone'			=> $this->input->post('outlet_phone'),
						'store_manager'	=> $this->input->post('outlet_manager'),
						'address'		=> $this->input->post('outlet_address'),
						'margin'		=> $this->input->post('outlet_margin')
					);
				
				//insert the outlet
				if($this->db->insert('outlets',$data_outlet)){

					//if success get the outlet_id
					$outlet_id = $this->db->insert_id();
					
					$data_account = array(
						'username'		=> $this->input->post('outlet_username'),
						'name'			=> $this->input->post('outlet_manager'),
						'password'		=> hash_password($this->input->post('outlet_password')),
						'role'			=> 'manager',
						'outlet_id'		=> $outlet_id
					);
					
					//insert the manager account
					$this->crud_model->insert_data('accounts',$data_account);

					//success notification
					$this->session->set_flashdata('outlet', "$.Notify({caption: 'Berhasil !', content: 'Toko berhasil dibuat', type: 'info'});");
					
				}else{
					$this->session->set_flashdata('outlet', "$.Notify({caption: 'Toko Gagal Dibuat!', content: 'Periksa kembali data toko', type: 'alert'});");
				}				

				redirect('outlets/add_outlet');
			}
			//show the form view
			else{
				$data['title'] = 'Outlet';
				$this->template->load($this->default,'outlets/add_outlet',$data);
			}
			
			
		}

		public function edit_outlet($outlet_id = ''){
			
			//process the edit if there is posts from the view
			if($this->input->post()){
				$data_outlet = array(
						'name'			=> $this->input->post('outlet_name'),
						'code'			=> $this->input->post('outlet_code'),
						'phone'			=> $this->input->post('outlet_phone'),
						'store_manager'	=> $this->input->post('outlet_manager'),
						'address'		=> $this->input->post('outlet_address'),
						'margin'		=> $this->input->post('outlet_margin')
					);

				//update the outlet information
				$this->crud_model->update_data('outlets',$data_outlet,array('id' => $outlet_id));
				
				$data_account = array(
					'username'		=> $this->input->post('outlet_username'),
					'password'		=> hash_password($this->input->post('outlet_password')),
					'name'			=> $this->input->post('outlet_manager'),
				);

				//check if user input new password or not
				if($this->input->post('outlet_password') != ''){
						//update the password
						$data_account['password'] = hash_password($this->input->post('outlet_password'));
					}

				//update the manager account
				$this->crud_model->update_data('accounts',$data_account,array('outlet_id' => $outlet_id,'role' => 'manager'));

				//success notification
				$this->session->set_flashdata('outlet', "$.Notify({caption: 'Berhasil !', content: 'Toko berhasil diedit', type: 'info'});");
					
								

				redirect('outlets/add_outlet');

			}
			//show the edit page
			else{
				$data['title'] = 'Outlet';
				$data['outlet']	= $this->outlets_model->get_outlet($outlet_id);
				$this->template->load($this->default,'outlets/edit_outlet',$data);
			}
		}

		public function delete_outlet($outlet_id = ''){
			
			//update the sales' outlet_id
			$this->crud_model->update_data('accounts',array('outlet_id' => $outlet_id, 'role' => 'sales'), array('outlet_id' => 0));
			//delete the manager acount
			$this->crud_model->delete_data('accounts',array('outlet_id' => $outlet_id,'role' => 'manager'));
			//delete the outlet
			$this->crud_model->delete_data('outlets',array('id' => $outlet_id));
			//give notification
			$this->session->set_flashdata('success',"$.Notify({caption: 'Berhasil !', content: 'Toko Berhasil Dihapus', type: 'info'});");
			redirect('outlets');
		}

		

	}

 ?>