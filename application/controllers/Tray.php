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
						'description'=>$this->input->post('tray_desc'),
						'outlet_id'=> $this->session_outlet
				);
	            $this->crud_model->insert_data('tray',$data);
	            $this->session->set_flashdata('tray',"$.Notify({
	            	class_name:'gritter-light',
				    caption: 'Berhasil',
				    content: 'Nampan telah ditambahkan',
				    time: 1200
				});");
				redirect('tray');
			}else{
				$this->index();
			}
		}

		public function delete_tray($id){
			if($this->crud_model->delete_data('tray',array('id'=>$id))){
				$this->session->set_flashdata('tray',"$.gritter.add({
					class_name:'gritter-light',
					title: 'Berhasil',
					text : 'Nampan telah dihapus',
					time: 1200
				});");
				
			}else{
				$this->session->set_flashdata('tray',"$.gritter.add({
					
					title: 'Gagal',
					text : 'Nampan gagal dihapus',
					time: 1200
				});");
			}
			redirect('tray');
		}

		public function edit_tray($id){
			if($this->input->post('submit')){
				$data= array(
						'code' => $this->input->post('new_tray'),
						'description'=>$this->input->post('tray_desc'),
						'outlet_id'=> $this->session_outlet
				);
	            $this->crud_model->update_data('tray',$data,array('id'=>$id));
	            $this->session->set_flashdata('tray',"$.gritter.add({
	            	class_name:'gritter-light',
				    title:'Berhasil',
				    text: 'Nampan telah di edit',
				    time: 1200
				});");
				redirect('tray');
			}else{
				$data['title'] = 'Edit Baki';
				$data['is_mobile'] = $this->is_mobile;
				$data['tray']=$this->crud_model->get_by_condition('tray',array('id'=>$id))->row();
				$this->template->load($this->default,'tray/edit_tray',$data);
			}
		}
		
	}

?>