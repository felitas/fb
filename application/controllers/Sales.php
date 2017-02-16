<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sales extends MY_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('sales_model');
			if($this->session_role=='sales'){
				redirect('home');
			}

		}

		public function index(){
			
			$data['title'] = 'Sales';
			$data['sales'] = $this->sales_model->get_all_sales();
			$data['is_mobile'] = $this->is_mobile;
			$this->template->load($this->default,'sales/list_sales',$data);
		
		}

		public function upload(){
			//upload image via webcam

			$this->load->library('image_moo');

			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;					
			$config['upload_path']          = 'uploads/temp/sales/'.$this->session_outlet.'/'.$this->session_id.'/';
			$config['overwrite']			= True;
			$config['file_name']			= 'sales'.$this->session_id.'.jpg';
			$this->upload->initialize($config);

			//Check if the folder for the upload existed
			if(!file_exists($config['upload_path']))
			{
				//if not make the folder so the upload is possible
				mkdir($config['upload_path'], 0777, true);
			}

            if($this->upload->do_upload('webcam'))
            {
                //Get the link for the database
                $photo = $config ['upload_path'] . '/' . $config ['file_name'];
            }

            //resize image
            $this->image_moo
				->load($photo)
				->resize_crop(300,400)
				->save($photo,TRUE);

		}

		public function add_sales(){
			if($this->input->post()){

				$this->load->library('image_moo');

				$config['allowed_types']        = 'jpg|png|jpeg';
	            $config['max_size']             = 5000;					
				$config['upload_path']          = 'uploads/photo/sales/'.$this->input->post('sales_username').'/';
				$config['overwrite']			= false;
				$config['file_name']			= 'sales-'.substr($this->input->post('sales_name'),0,3).'.jpg';
				$this->upload->initialize($config);

				//Check if the folder for the upload existed
				if(!file_exists($config['upload_path']))
				{
					//if not make the folder so the upload is possible
					mkdir($config['upload_path'], 0777, true);
				}

	            if($this->upload->do_upload('capture'))
	            {
	                //Get the link for the database
	                $photo = $config ['upload_path'] . '/' . $config ['file_name'];
	            }else{

	            	$photo = $config ['upload_path'] . '/' . $config ['file_name'];

					rename('uploads/temp/sales/'.$this->session_outlet.'/'.$this->session_id.'/'.'sales'.$this->session_id.'.jpg' , $photo);	
					
	            }

	             //resize image
            	$this->image_moo
					->load($photo)
					->resize_crop(300,400)
					->save($photo,TRUE);

	            //check if user upload a photo or not.
				if(!file_exists($photo))
				{
					
					$photo = '';
				}				
		            
	            $data_sales = array(
	            		'name'		=> $this->input->post('sales_name'),
	            		'photo'		=> $photo,
	            		'address'	=> $this->input->post('sales_address'),
	            		'phone'		=> $this->input->post('sales_phone'),
	            		'email'		=> $this->input->post('sales_email'),
	            		'username'	=> $this->input->post('sales_username'),
	            		'password'	=> hash_password($this->input->post('sales_password')),
	            		'outlet_id'	=> $this->input->post('sales_outlet'),
	            		'workers_code' => $this->input->post('sales_code'),
	            		'role'		=> 'sales'
	            	);

	            if($this->crud_model->insert_data('accounts',$data_sales)){
	            	$this->session->set_flashdata('sales',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Sales berhasil dibuat',
				 		time: 2000
				 	});");
	            }else{
	            	$this->session->set_flashdata('sales',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Gagal!',
				 		text:	'Sales gagal dibuat',
				 		time: 2000
				 	});");
	            }

	            redirect('sales/add_sales');

			}else{
				$data['title'] = 'Sales';
				$data['outlets'] = $this->crud_model->get_data('outlets')->result();
				$data['is_mobile'] = $this->is_mobile;
				$this->template->load($this->default,'sales/add_sales',$data);
			}
		}

		public function edit_sales($sales_id = ''){
			if($this->input->post()){
				$sales = $this->crud_model->get_by_condition('accounts',array('id' => $sales_id))->row();

				$this->load->library('image_moo');

				$config['allowed_types']        = 'jpg|png|jpeg';
	            $config['max_size']             = 5000;					
				$config['upload_path']          = 'uploads/photo/sales/'.$this->input->post('sales_username').'/';
				$config['overwrite']			= true;
				$config['file_name']			= 'sales-'.substr($this->input->post('sales_name'),0,3).'.jpg';
				$this->upload->initialize($config);

				//Check if the folder for the upload existed
				if(!file_exists($config['upload_path']))
				{
					
					mkdir($config['upload_path'], 0777, true);
				}

	            if($this->upload->do_upload('capture'))
	            {
	                //Get the link for the database
	                $photo = $config ['upload_path'] . '/' . $config ['file_name'];

	                if($this->input->post('username') != $sales->username){
						unlink(base_url().$sales->photo);
					}
	            }else{

	            	$photo = $config ['upload_path'] . '/' . $config ['file_name'];

					rename('uploads/temp/sales/'.$this->session_outlet.'/'.$this->session_id.'/'.'sales'.$this->session_id.'.jpg' , $photo);	

					if($this->input->post('username') != $sales->username){
						unlink(base_url().$sales->photo);
					}
	            }

	            //resize image
            	$this->image_moo
					->load($photo)
					->resize_crop(300,400)
					->save($photo,TRUE);

	            //check if user upload a photo or not.
				if(!file_exists($photo))
				{
					//if not make the folder so the upload is possible
					$photo = '';
				}				
		            
	            $data_sales = array(
	            		'name'		=> $this->input->post('sales_name'),
	            		'photo'		=> $photo,
	            		'address'	=> $this->input->post('sales_address'),
	            		'phone'		=> $this->input->post('sales_phone'),
	            		'email'		=> $this->input->post('sales_email'),
	            		'username'	=> $this->input->post('sales_username'),
	            		'outlet_id'	=> $this->input->post('sales_outlet'),
	            		'workers_code' => $this->input->post('sales_code'),
	            		'role'		=> 'sales'
	            	);

	            //check if user input new password or not
				if($this->input->post('sales_password') != ''){
					//update the password
					$data_account['password'] = hash_password($this->input->post('sales_password'));
				}

	            if($this->crud_model->update_data('accounts',$data_sales,array('id' => $sales_id))){
	            	$this->session->set_flashdata('sales',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Sales berhasil diubah',
				 		time: 2000
				 	});");	
	            }else{
	            	$this->session->set_flashdata('sales',"$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Sales gagal diubah',
				 		time: 2000
				 	});");
	            }        

	            redirect('sales');

			}else{
				$data['title'] = 'Sales';
				$data['outlets'] = $this->crud_model->get_data('outlets')->result();
				$data['sales'] = $this->crud_model->get_by_condition('accounts',array('id' => $sales_id,'role' => 'sales'))->row();
				$data['is_mobile'] = $this->is_mobile;
				$this->template->load($this->default,'sales/edit_sales',$data);
			}
		}
		
		public function delete_sales($sales_id = ''){
			$sales = $this->crud_model->get_by_condition('accounts',array('id' => $sales_id,'role' => 'sales'))->row();
			if($sales){
				$dir = 'uploads/photo/sales/'.$sales->username;
				unlink($sales->photo);
				rmdir($dir);	
				if($this->crud_model->delete_data('accounts',array('id' => $sales_id))){
					$this->session->set_flashdata('sales',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Sales berhasil dihapus!',
				 		time: 2000
				 	});");
				}else{
					$this->session->set_flashdata('sales',"$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Sales gagal dihapus!',
				 		time: 2000
				 	});");
				}
			}else{
				$this->session->set_flashdata('sales',"$.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Sales tidak ditemukan',
				 		time: 2000
				 	});");
			}
			redirect('sales');

			



		}

		public function check_sales_code($code = ''){
			if ($code != '') {
				if ($this->sales_model->check_code($code)) {
					echo 'taken';
				}
				else{
					echo 'available';
				}
			}
		}
			
		

	}

 ?>