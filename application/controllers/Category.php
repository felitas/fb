<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Category extends MY_Controller{

		function __construct(){
			parent::__construct();
			
		}

		public function index(){

			$data['title'] = 'Category';
			$data['category_diamond'] = $this->crud_model->get_by_condition('category',array('type_id' => 2))->result();
			$data['category_gold'] = $this->crud_model->get_by_condition('category',array('type_id' => 1))->result();
			$this->template->load($this->default,'category/list_category',$data);
			

		}

		public function add_category(){
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
				$this->template->load($this->default,'category/list_category',$data);
			}
		}

	}

 ?>