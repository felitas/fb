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
					time: 2000
				});");
				redirect('configuration/currency');
			}else{
				$this->session->set_flashdata('currency',"$.gritter.add({
					title: 'Gagal!',
					text : 'Kurs gagal dihapus',
					time : 2000
				});");
				redirect('configuration/currency');
			}
		}
		/*End currency*/
		/*Diamond Type*/
		/*LIST ADD DIAMOND TYPE*/
		public function diamond_type(){
			if($this->input->post('submit')){
				$data=array(
					'code'=>$this->input->post('diamond_code'),
					'name'=>$this->input->post('diamond_name')
				);
				$this->crud_model->insert_data('diamond_type',$data);
				$this->session->set_flashdata('diamond_type',"$.gritter.add({
					class_name : 'gritter-light',
					title:'Success',
					text:'Tipe diamond telah ditambahkan',
					time: 2000
				});");
				redirect('configuration/diamond_type');
			}
			else{
				$data['title'] = 'Tipe Berlian untuk Spesifikasi';
				$data['diamonds'] = $this->crud_model->get_data('diamond_type')->result();
				$this->template->load($this->default,'configuration/diamond/list_add_diamond_type',$data);	

			}
			
		}
		/*Edit diamond type*/
		public function edit_diamond_type($id){
			if($this->input->post('submit')){
				$data=array(
					'code'=>$this->input->post('diamond_type_code'),
					'name'=>$this->input->post('diamond_type_name')
				);
				$this->crud_model->update_data('diamond_type',$data,array('id'=>$id));
				redirect('configuration/diamond_type');
			}
			else{
				$data['title']='Edit Tipe Berlian';
				$data['diamond_type']=$this->crud_model->get_by_condition('diamond_type',array('id'=>$id))->row();
				$this->template->load($this->default,'configuration/diamond/edit_diamond_type',$data);
			}
		}
		/*End Diamond Type*/
		/*Product Type*/
		/*List and add product type*/
		public function product_type(){
			if($this->input->post('submit')){
				$data=array(
					'code'=>$this->input->post('product_type_code'),
					'name'=>$this->input->post('product_type_name')
				);
				$this->crud_model->insert_data('type',$data);
				$this->session->set_flashdata('type',"$.gritter.add({
					class_name : 'gritter-light',
					title:'Success',
					text:'Tipe produk telah ditambahkan',
					time: 2000
				});");
				redirect('configuration/product_type');
			}
			else{
				$data['title'] = 'Tipe Produk';
				$data['types'] = $this->crud_model->get_data('type')->result();
				$this->template->load($this->default,'configuration/product_type/list_add_product_type',$data);	

			}
			
		}
		/*Delete product type*/
		public function delete_product_type($id){
			if($this->crud_model->delete_data('type',array('id'=>$id))){
				$this->session->set_flashdata('type',"$.gritter.add({
					class_name: 'gritter-light',
					title: 'Success',
					text: 'Tipe produk berhasil dihapus',
					time:2000
				});");
				redirect('configuration/product_type');
			}
			else{
				$this->session->set_flashdata('type',"$.gritter.add({
					title: 'Success',
					text: 'Tipe produk gagal dihapus',
					time:2000
				});");
			}		
		}
		/*Edit Product Type*/
		public function edit_product_type($id){
			if($this->input->post('submit')){
				$data=array(
					'code'=>$this->input->post('product_type_code'),
					'name'=>$this->input->post('product_type_name')
				);
				if($this->crud_model->update_data('type',$data,array('id'=>$id))){
					$this->session->set_flashdata('type',"$.gritter.add({
						class_name:'gritter-light',
						title:'Success!',
						text:'Tipe produk berhasil di edit',
						time:2000
					});");
					redirect('configuration/product_type');
				}
				else{
					$this->session->set_flashdata('type',"$.gritter.add({
						title:'Gagal!',
						text:'Tipe produk gagal di edit',
						time:2000
					});");
				}

			}
			else{
				$data['title'] = "Edit Tipe Produk";
				$data['type'] = $this->crud_model->get_by_condition('type',array('id'=>$id))->row();
				$this->template->load('default','configuration/product_type/edit_product_type',$data);

			}
		}
		/*End Product Type*/
		/*Category LIST ADD EDIT*/
		public function category(){
			if($this->input->post('submit')){
				$data= array(
						'name'	=> $this->input->post('category_name'),
						'code' => ucfirst($this->input->post('category_code')),
						'type_id'=> $this->input->post('category_type')
				);
	            $this->crud_model->insert_data('category',$data);
	            $this->session->set_flashdata('category',"$.Notify({
				    caption: 'Berhasil',
				    content: 'Kategori telah ditambahkan',
				    type: 'success'
				});");
				redirect('category');
			}else{
				$data['title'] = 'Daftar Kategori';
				$data['is_mobile'] = $this->is_mobile;
				$data['category_diamond'] = $this->crud_model->get_by_condition('category',array('type_id' => 2))->result();
				$data['category_gold'] = $this->crud_model->get_by_condition('category',array('type_id' => 1))->result();
				$this->template->load($this->default,'configuration/category/list_category',$data);
			}
		}
		/*End Category*/
	}

 ?>