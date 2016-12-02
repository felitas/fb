<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Tray extends MY_Controller{
		function __construct(){
			parent::__construct();
			if($this->session_role=='sales'){
				redirect('home');
			}
		}

		public function index(){
			
			$data['title'] = 'Daftar Baki';
			$data['is_mobile'] = $this->is_mobile;
			$data['trays'] = $this->crud_model->get_data('tray')->result();
			$this->template->load($this->default,'tray/list_tray',$data);
		
		}

		public function add_tray(){
			if($this->input->post('submit')){
				$data= array(
						'code' => $this->input->post('new_tray'),
						'outlet_id'=> $this->session_outlet
				);
	            $this->crud_model->insert_data('tray',$data);
	            $this->session->set_flashdata('tray',"$.Notify({
				    caption: 'Berhasil',
				    content: 'Baki telah ditambahkan',
				    type: 'success'
				});");
				redirect('tray');
			}else{
				$this->index();
			}
		}

		public function delete_tray($id){
			if($this->crud_model->delete_data('tray',array('id'=>$id))){
				$this->session->set_flashdata('tray',"$.Notify({
					caption: 'Berhasil',
					content : 'Baki telah dihapus',
					type: 'success'
				});");
				redirect('tray');
			}else{
				$this->session->set_flashdata('tray',"$.Notify({
					caption: 'Gagal',
					content : 'Baki gagal dihapus',
					type : 'alert'
				});");
			}
		}
		
	}

?>