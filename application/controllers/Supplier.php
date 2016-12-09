<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Supplier extends MY_Controller{
		function __construct(){
			parent::__construct();
			if($this->session_role=='sales'){
				redirect('home');
			}
		}

		public function index(){
			
			$data['title'] = 'Supplier';
			$data['is_mobile'] = $this->is_mobile;
			$data['suppliers'] = $this->crud_model->get_data('suppliers')->result();
			$this->template->load($this->default,'supplier/list_supplier',$data);
		
		}

		public function add_supplier(){
			if($this->input->post('submit')){
				$data= array(
						'name' => $this->input->post('supplier_name'),
						'phone' => $this->input->post('supplier_phone'),
						'address' => $this->input->post('supplier_address'),
						'email' => $this->input->post('supplier_email'),
						'description' => $this->input->post('supplier_desc')
					);
	            $this->crud_model->insert_data('suppliers',$data);
	            $this->session->set_flashdata('supplier',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Supplier berhasil dibuat!',
				 		sticky: false
				 	});");
				redirect('supplier/add_supplier');
			}else{
				$data['title'] = 'Supplier';
				$data['is_mobile'] = $this->is_mobile;
				$this->template->load($this->default,'supplier/add_supplier',$data);
			}
		}
		
		public function edit_supplier($supp_id = ''){
			if($this->input->post()){
	            $data_supplier = array(

	            		'name' => $this->input->post('supplier_name'),
						'phone' => $this->input->post('supplier_phone'),
						'address' => $this->input->post('supplier_address'),
						'email' => $this->input->post('supplier_email'),
						'description' => $this->input->post('supplier_desc')

	            	);

	            if($this->crud_model->update_data('suppliers',$data_supplier,array('id' => $supp_id))){
	            	$this->session->set_flashdata('supplier',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Supplier berhasil diubah!',
				 		sticky: false
				 	});");
	            }else{
	            	$this->session->set_flashdata('supplier',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Gagal!',
				 		text:	'Supplier gagal diubah!',
				 		sticky: false
				 	});");
	            }
	            
	            redirect('supplier');

			}else{
				$data['title'] = 'Supplier';
				$data['is_mobile'] = $this->is_mobile;
				$data['supplier'] = $this->crud_model->get_by_condition('suppliers',array('id' => $supp_id))->row();
				$this->template->load($this->default,'supplier/edit_supplier',$data);
			}
		}

		public function delete_supplier($supp_id = ''){
		
			if($this->crud_model->delete_data('suppliers',array('id' => $supp_id))){
				$this->session->set_flashdata('supplier',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Supplier berhasil dihapus!',
				 		sticky: false
				 	});");
			}else{
				$this->session->set_flashdata('supplier',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Gagal!',
				 		text:	'Supplier gagal dihapus!',
				 		sticky: false
				 	});");
			
			redirect('supplier');
		}

	}

?>