<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Model extends MY_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('mod_model');
		}

		public function index(){
			$data['title'] = 'Model';
			$data['type'] = $this->crud_model->get_data('type')->result();
			$data['model_gold'] = $this->mod_model->get_model('1');
			$data['model_diamond'] = $this->mod_model->get_model('2');
			$this->template->load($this->default,'model/list_model',$data);
		}

		public function add_model(){
			if($this->input->post('submit')){
				$data= array(
						'name'	=> $this->input->post('model_name'),
						'code' => ucfirst($this->input->post('model_code')),
						'category_id'=> $this->input->post('category_type')
				);
	            $this->crud_model->insert_data('model',$data);
	            $this->session->set_flashdata('model',"$.Notify({
				    caption: 'Berhasil',
				    content: 'Model telah ditambahkan',
				    type: 'success'
				});");
				redirect('model');
			}else{
				$data['title'] = 'Daftar Model';
				$data['is_mobile'] = $this->is_mobile;
				$this->template->load($this->default,'model/list_model',$data);
			}
		}

		function get_category($type_id){
			$categories = $this->crud_model->get_by_condition('category',array('type_id' => $type_id))->result();
			$output = '';
			if($categories){
				foreach ($categories as $category) {
					$output .= '<option value="'.$category->id.'">'.$category->name.'</option>';
				}
			}
			echo $output;
		}

	}

 ?>