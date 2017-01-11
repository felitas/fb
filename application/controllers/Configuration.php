<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Configuration extends MY_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('configuration_model');
			
			if($this->session_role != 'admin'){
				redirect('home');
			}
		}
		/*Color*/
		public function color(){

			$data['title'] = 'Ubah Warna';
			$data['configuration'] = $this->crud_model->get_data('configuration')->row();
			$this->template->load($this->default,'configuration/color',$data);
			

		}

		public function change_color($color = ''){
			if($color != ''){
				$this->crud_model->update_data('configuration',array('primary_color' => '#'.$color),array('id' => 1));
				echo 'success';
			}
		}
		/*Color ENds*/
		/*Currency*/
		public function currency(){
			$data['title'] = 'Kurs';
			$data['is_mobile'] = $this->is_mobile;
			$data['currencies'] = $this->crud_model->get_data('currency')->result();
			$data['histories'] = $this->configuration_model->get_currency_history();
			$this->template->load('default','configuration/currency/list_add_currency',$data);
		}

		public function currency_add(){
			//process the insertion
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('currency_name'),
					'value'=>$this->input->post('currency_value'),
					'last_update'=>date('Y-m-d H:i:s')
				);
				
				$this->crud_model->insert_data('currency',$data);
				$data_history = array(
					'currency_id'=>$this->db->insert_id(),
					'value'=> $this->input->post('currency_value'),
					'date' => date('Y-m-d H:i:s')
				);
				$this->crud_model->insert_data('currency_history',$data_history);
				$this->session->set_flashdata('currency',"$.gritter.add({
					class_name: 'gritter-light',
				    title: 'Berhasil',
				    text: 'Kurs telah ditambahkan',
				    sticky: 'false'
				});");
				redirect('configuration/currency');
			}
			//show the form view
			else{
				$this->currency();
			}
		}

		public function update_currency($id){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('update_currency_name'),
					'value'=>$this->input->post('update_currency_value'),
					'last_update'=>date('Y-m-d H:i:s')
				);
				$this->crud_model->update_data('currency',$data,array('id'=>$id));
				$data_history=array(
					'currency_id'=>$id,
					'value'=>$this->input->post('update_currency_value'),
					'date' => date('Y-m-d H:i:s')
				);
				$this->crud_model->insert_data('currency_history',$data_history);
				$this->session->set_flashdata('currency',"$.gritter.add({
					class_name : 'gritter-light',
					title: 'Berhasil',
					text : 'Kurs berhasil diupdate',
					sticky: 'false'
				});");
				redirect('configuration/currency');
			}
			else{
				$data['title'] = 'Update Kurs';
				$data['currency'] = $this->crud_model->get_by_condition('currency',array('id'=>$id))->row();
				$data['histories'] = $this->crud_model->get_by_condition('currency_history',array('currency_id'=>$id))->result();
				$this->template->load($this->default,'configuration/currency/update_currency',$data);
			}
		}

		public function delete_currency($id){
			if($this->crud_model->delete_data('currency',array('id'=>$id))){
				$this->session->set_flashdata('currency',"$.gritter.add({
					class_name : 'gritter-light',
					title: 'Berhasil',
					text : 'Kurs berhasil dihapus',
					sticky: 'false'
				});");
				redirect('configuration/currency');
			}else{
				$this->session->set_flashdata('currency',"$.gritter.add({
					title: 'Gagal!',
					text : 'Kurs gagal dihapus',
					sticky: 'false'
				});");
				redirect('configuration/currency');
			}
		}
		/*End currency*/
		/*Diamond*/
		public function add_diamond_type(){
			$data['title'] = 'Tambah Tipe Diamond';
			$data['gold_amount'] = $this->crud_model->get_data('gold_amount')->result();
			$this->template->load($this->default,'configuration/diamond/add_diamond_type',$data);
		}

	}

 ?>