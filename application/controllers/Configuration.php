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
			if($this->input->post()){
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
		/*Check product type code uniqueness*/
		public function check_type_code($type_code){
			if ($type_code != '') {
				if ($this->configuration_model->check_type_code($type_code)) {
					echo 'taken';
				}
				else{
					echo 'available';
				}
			}
		}

		/*End Product Type*/
		/*Category LIST ADD EDIT CHECK*/
		public function category(){
			if($this->input->post('submit')){
				$data= array(
						'name'	=> $this->input->post('category_name'),
						'code' => ucfirst($this->input->post('category_code')),
				);
	            $this->crud_model->insert_data('category',$data);
	            $this->session->set_flashdata('category',"$.gritter.add({
	            	class_name:'gritter-light',
				    title: 'Success!',
				    text: 'Kategori telah ditambahkan',
				    time:2000
				});");
				redirect('configuration/category');
			}else{
				$data['title'] = 'Daftar Kategori';
				$data['is_mobile'] = $this->is_mobile;
				$data['categories'] = $this->crud_model->get_data('category')->result();
				$this->template->load($this->default,'configuration/category/list_category',$data);
			}
		}
		/*Edit*/
		public function edit_category($id){
			if($this->input->post('submit')){
				$data=array(
					'code'=>$this->input->post('category_code'),
					'name'=>$this->input->post('category_name'),
				);
				if($this->crud_model->update_data('category',$data,array('id'=>$id))){
					$this->session->set_flashdata('category',"$.gritter.add({
						class_name:'gritter-light',
						title:'Success',
						text:'Kategori telah diubah',
						time:1500
					});");
					redirect('configuration/category');	
				}
				else{
					$this->session->set_flashdata('category',"$.gritter.add({
						title:'Gagal',
						text:'Kategori gagal diubah',
						time:1500
					});");
					redirect('configuration/category');		
				}
				
			}
			else{
				$data['title']='Edit Kategori';
				$data['is_mobile']=$this->is_mobile;
				$data['category']=$this->crud_model->get_by_condition('category',array('id'=>$id))->row();
				$data['types']=$this->crud_model->get_data('type')->result();
				$this->template->load($this->default,'configuration/category/edit_category',$data);
			}
		}
		/*DeletE*/
		public function delete_category($id){
			if($this->crud_model->delete_data('category',array('id'=>$id))){
				$this->session->set_flashdata('category',"$.gritter.add({
					class_name:'gritter-light',
					title:'Success',
					text:'Kategori telah sukses dihapus',
					time:1500
				})");
				redirect('configuration/category');
			}
			else{
				$this->session->set_flashdata('category',"
					$.gritter.add({
						title:'Gagal',
						text:'Kategori gagal sukses dihapus',
						time:1500
					})");
				redirect('configuration/category');
			}
		}
		/*Check*/
		//ajax to check category uniqueness in database
		public function check_category_code($category_code){
			if ($category_code != '') {
				if ($this->configuration_model->check_category_code($category_code)) {
					echo 'taken';
				}
				else{
					echo 'available';
				}
			}
		}

		/*Ajax to get item category IN ADD PRODUCT PAGE*/
		public function get_category_data($type_code=''){
			$this->load->model('configuration_model');
			$type=$this->db->get_where('type',array('code'=>$type_code))->row();
			$categories = $this->configuration_model->get_category($type_code);	
			$output='';
			if($categories){
				// $output.="<option value=''>--Pilih Kategori ".$type->name."--</option>";
				foreach ($categories as $category) {
					$output.="<option value='".$category->code."'>".$category->code." - ".$category->name."</option>";
				}
				echo $output;
			}else{
				echo 'Belum ada kategori';
			}
		}

		/*End Category*/
		/*MODEL STARTS*/
		public function model(){
			if($this->input->post('submit')){
				$data= array(
						'name'	=> $this->input->post('model_name'),
						'code' => ucfirst($this->input->post('model_code')),
				);
	            $this->crud_model->insert_data('model',$data);
	            $this->session->set_flashdata('model',"$.gritter.add({
	            	class_name:'gritter-light',
				    title: 'Success!',
				    text: 'Model telah ditambahkan',
				    time:2000
				});");
				redirect('configuration/model');
			}else{
				$data['title'] = 'Daftar Koleksi';
				$data['is_mobile'] = $this->is_mobile;
				$data['models']=$this->crud_model->get_data('model')->result();
				$this->template->load($this->default,'configuration/model/list_add_model',$data);
			}
		}
		/*Edit*/
		public function edit_model($id){
			if($this->input->post('submit')){
				$data= array(
						'name'	=> $this->input->post('model_name'),
						'code' => ucfirst($this->input->post('model_code')),
				);
				if($this->crud_model->update_data('model',$data,array('id'=>$id))){
					$this->session->set_flashdata('model',"$.gritter.add({
						class_name:'gritter-light',
						title:'Success',
						text:'Model telah diubah',
						time:1500
					});");
					redirect('configuration/model');	
				}
				else{
					$this->session->set_flashdata('model',"$.gritter.add({
						title:'Gagal',
						text:'Model gagal diubah',
						time:1500
					});");
					redirect('configuration/model');		
				}
				
			}
			else{
				$data['title']='Edit Model';
				$data['is_mobile']=$this->is_mobile;
				$data['model']=$this->crud_model->get_by_condition('model',array('id'=>$id))->row();
				$this->template->load($this->default,'configuration/model/edit_model',$data);
			}
		}
		/*Delete*/
		public function delete_model($id){
			if($this->crud_model->delete_data('model',array('id'=>$id))){
				$this->session->set_flashdata('model',"$.gritter.add({
					class_name:'gritter-light',
					title:'Success',
					text:'Kategori telah sukses dihapus',
					time:1500
				})");
				redirect('configuration/model');
			}
			else{
				$this->session->set_flashdata('model',"
					$.gritter.add({
						title:'Gagal',
						text:'Kategori gagal sukses dihapus',
						time:1500
					})");
				redirect('configuration/model');
			}
		}

		/*Check model uniqueness*/
		public function check_model_code($model_code){
			if ($model_code != '') {
				if ($this->configuration_model->check_model_code($model_code)) {
					echo 'taken';
				}
				else{
					echo 'available';
				}
			}
		}
		/*MODEL ENDS*/
		/*========================SALES TARGET=========================*/
		/*LIST AND ADD*/
		public function sales_target(){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('target_name'),
					'target'=>$this->input->post('target_amount'),
					'description'=>$this->input->post('target_desc')
				);
				$this->crud_model->insert_data('sales_target',$data);
				$this->session->set_flashdata('target',"$.gritter.add({
					class_name : 'gritter-light',
					title:'Success',
					text:'Target telah ditambahkan',
					time: 1500
				});");
				redirect('configuration/sales_target');
			}
			else{
				$data['title'] = 'Target Sales';
				$data['is_mobile']=$this->is_mobile;
				$data['targets'] = $this->crud_model->get_data('sales_target')->result();
				$this->template->load($this->default,'configuration/sales_target/list_add_sales_target',$data);	
			}
		}
		/*EDIT*/
		public function edit_target($id=''){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('target_name'),
					'target'=>$this->input->post('target_amount'),
					'description'=>$this->input->post('target_desc')
				);
				if($this->crud_model->update_data('sales_target',$data,array('id'=>$id))){
					$this->session->set_flashdata('target',"$.gritter.add({
						class_name:'gritter-light',
						title:'Success',
						text:'Target telah diubah',
						time:1500
					});");
					redirect('configuration/sales_target');	
				}
				else{
					$this->session->set_flashdata('target',"$.gritter.add({
						title:'Gagal',
						text:'Model gagal diubah',
						time:1500
					});");
					redirect('configuration/sales_target');		
				}
				
			}
			else{
				$data['title']='Edit Target';
				$data['is_mobile']=$this->is_mobile;
				$data['target']=$this->crud_model->get_by_condition('sales_target',array('id'=>$id))->row();
				$this->template->load($this->default,'configuration/sales_target/edit_target',$data);
			}
		}
		/*========================END SALES TARGET=========================*/
		/*========================CUSTOMER SETTINGS (for customer grade)=========================*/
		public function customer_settings(){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('target_name'),
					'target'=>$this->input->post('target_amount'),
					'description'=>$this->input->post('target_desc')
				);
				$this->crud_model->insert_data('sales_target',$data);
				$this->session->set_flashdata('customer_setting',"$.gritter.add({
					class_name : 'gritter-light',
					title:'Success',
					text:'Target telah ditambahkan',
					time: 1500
				});");
				redirect('configuration/sales_target');
			}
			else{
				$data['title'] = 'Customer Settings';
				$data['is_mobile']=$this->is_mobile;
				$data['grades'] = $this->crud_model->get_data('customer_grade')->result();
				$this->template->load($this->default,'configuration/customer_settings/list_customer_grade',$data);	
			}
		}
		public function edit_grade($id=''){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('grade_name'),
					'target'=>$this->input->post('grade_amount')
				);
				if($this->crud_model->update_data('customer_grade',$data,array('id'=>$id))){
					$this->session->set_flashdata('customer_setting',"$.gritter.add({
						class_name:'gritter-light',
						title:'Success',
						text:'Grade telah diubah',
						time:1500
					});");
					redirect('configuration/customer_settings');	
				}
				else{
					$this->session->set_flashdata('customer_setting',"$.gritter.add({
						title:'Gagal',
						text:'Grade gagal diubah',
						time:1500
					});");
					redirect('configuration/customer_settings');		
				}
				
			}
			else{
				$data['title']='Edit Grade';
				$data['is_mobile']=$this->is_mobile;
				$data['grade']=$this->crud_model->get_by_condition('customer_grade',array('id'=>$id))->row();
				$this->template->load($this->default,'configuration/customer_settings/edit_customer_grade',$data);
			}
		}
		/*======================== END CUSTOMER SETTINGS (for customer grade)=========================*/
		/*========================MEMBER POINT SETTINGS=========================*/
		public function member_points(){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('point_name'),
					'target'=>$this->input->post('point_target'),
					'amount'=>$this->input->post('point_amount')
				);
				$this->crud_model->insert_data('member_point_target',$data);
				$this->session->set_flashdata('member_point',"$.gritter.add({
					class_name : 'gritter-light',
					title:'Success',
					text:'Target member point telah ditambahkan',
					time: 1500
				});");
				redirect('configuration/member_points');
			}
			else{
				$data['title'] = 'Customer Settings';
				$data['is_mobile']=$this->is_mobile;
				$data['point_targets'] = $this->crud_model->get_data('member_point_target')->result();
				$this->template->load($this->default,'configuration/member_points/list_member_points',$data);	
			}
		}
		public function edit_member_points($id=''){
			if($this->input->post('submit')){
				$data=array(
					'name'=>$this->input->post('point_name'),
					'target'=>$this->input->post('point_target'),
					'amount'=>$this->input->post('point_amount')
				);
				if($this->crud_model->update_data('member_point_target',$data,array('id'=>$id))){
					$this->session->set_flashdata('member_point',"$.gritter.add({
						class_name:'gritter-light',
						title:'Success',
						text:'Target point member telah diubah',
						time:1500
					});");
					redirect('configuration/member_points');	
				}
				else{
					$this->session->set_flashdata('member_point',"$.gritter.add({
						title:'Gagal',
						text:'Target poin member gagal diubah',
						time:1500
					});");
					redirect('configuration/member_points');		
				}
				
			}
			else{
				$data['title']='Edit Target Point Member';
				$data['is_mobile']=$this->is_mobile;
				$data['point']=$this->crud_model->get_by_condition('member_point_target',array('id'=>$id))->row();
				$this->template->load($this->default,'configuration/member_points/edit_member_points',$data);
			}
		}
	}

 ?>