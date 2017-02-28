<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Loan extends MY_Controller{

		function __construct(){
			parent::__construct();
			
			$this->load->model('loan_model');
		
		}

		/****List Loan****/
		public function index(){
			$data['title'] = 'Daftar Gadai';
			$data['is_mobile'] = $this->is_mobile;
			$data['role']=$this->session_role;
			if ($this->session_role == 'admin') {
				$data['loans'] = $this->loan_model->get_loan_all_outlet();
			}
			else{
				$data['loans'] = $this->loan_model->get_loan_this_outlet($this->session_outlet);
			}
			$this->template->load($this->default,'loan/list_loan',$data);
		}
		/****list loan END****/


		/**** LOAN START ****/
		public function upload(){
			//upload image via webcam

			$this->load->library('image_moo');

			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;					
			$config['upload_path']          = 'uploads/temp/loan/'.$this->session_outlet;
			$config['overwrite']			= True;
			$config['file_name']			= 'loan_items_'.$this->session_outlet.'.jpg';
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
				->resize_crop(400,400)
				->save($photo,TRUE);

		}


		public function new_loan(){
			if($this->input->post()){

				$this->load->library('image_moo');

				$config['allowed_types']        = 'jpg|png|jpeg';
	            $config['max_size']             = 5000;					
				$config['upload_path']          = 'uploads/photo/loan/'.$this->session_outlet;
				$config['overwrite']			= false;
				$config['file_name']			= $this->input->post('loan_code').'.jpg';
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

					rename('uploads/temp/loan/'.$this->session_outlet.'/'.'loan_items_'.$this->session_outlet.'.jpg' , $photo);	
					
	            }

	             //resize image
            	$this->image_moo
					->load($photo)
					->resize_crop(400,400)
					->save($photo,TRUE);

	            //check if user upload a photo or not.
				if(!file_exists($photo))
				{
					
					$photo = '';
				}
				//---------------------------DATA INSERTING----------------------//
	            /**kalo ada customer baru di insert**/
				if($this->input->post('new_customer') == 'on'){
					$data_customer = array(
							'customer_code'		=> $this->input->post('customer_code'),
							'name'		=> $this->input->post('customer_name'),
							'phone'		=> $this->input->post('customer_phone'),
							'email'		=> $this->input->post('customer_email'),
							'address'	=> $this->input->post('customer_address'),
							'type'		=> $this->input->post('customer_type'),
							'birthday'=> $this->input->post('customer_birthday')
						);

					$this->db->insert('customers', $data_customer);
					$this->db->update('code',array('count' => $this->input->post('hidden_customer_count') + 1 ),array('code' => $this->input->post('hidden_customer_code')));
				}
            	//input loan item/s//
            	for($i = 0; $i < count($this->input->post('item_name')); $i++){
            		$data_item = array(
            			'loan_code' 	=> $this->input->post('loan_code'),
            			'item_name'	 	=> $this->input->post('item_name')[$i],
            			'weight' 		=> $this->input->post('item_weight')[$i],
            			'gold_amount' 	=> $this->input->post('item_gold_amount')[$i],
            			'loan_price' 	=> $this->input->post('item_loan_price')[$i],
            			'interest_rate'	=> $this->input->post('item_interest_rate')[$i],
            			'description' 	=> $this->input->post('item_description')[$i]

            		);
            		$this->db->insert('loan_detail',$data_item);
            	}


	          	$code_count = array(
          			'code' => $this->input->post('hidden_code'),
          			'count'=> 1
	          	);


	          	$data_loan = array(
	          		'outlet_id' 	=> $this->session_outlet,
	          		'workers_code'	=> $this->input->post('loan_sales'),
	          		'loan_code' 	=> $this->input->post('loan_code'),
	          		'customer_code'	=> $this->input->post('customer_code'),
	          		'date_due'		=> $this->input->post('loan_due'),
	          		'total_loan'	=> $this->input->post('loan_total'),
	          		'total_item'	=> $this->input->post('loan_item_total'),
	          		'items_photo'	=> $photo,
	          		'description'	=> $this->input->post('loan_description')
	          	);
	          	//input loan data and update code count
	            if($this->crud_model->insert_data('loan',$data_loan)){
	            	if($this->db->get_where('code',array('code'=>$this->input->post('hidden_code')))->num_rows()>0){
	            		$count = $this->db->get_where('code',array('code'=>$this->input->post('hidden_code')))->row('count');
	            		$this->db->update('code',array('count'=> $count+1),array('code'=>$this->input->post('hidden_code')));
		            }else{
		            	$this->crud_model->insert_data('code',$code_count);
		            }
	            	$this->session->set_flashdata('loan',"$.gritter.add({
	            		class_name : 'gritter-light',
					    title: 'Berhasil',
					    text: 'Berhasil input transaksi gadai',
					    time: 1200
					});");	
	            }else{
	            	$this->session->set_flashdata('loan',"$.gritter.add({
					    title: 'Gagal',
					    text: 'Transaksi gagal diinput',
					    time: 1200
					});");
	            }
	            
	            redirect('loan/new_loan');

			}
			else{
				$year = date('y');
				$month = date('m');
				$outlet_code = $this->db->get_where('outlets',array('id' => $this->session_outlet))->row('code');
				$code = $this->db->get_where('code',array('code' => $outlet_code.'GD'.$year.$month))->row();
				if($code){
					$data['loan_code'] = $code->code.sprintf("%06d", $code->count);
					$data['hidden_code'] = $code->code;
					$data['hidden_count'] = $code->count;
				}else{
					$this->db->insert('code',array('code' => $outlet_code.'GD'.$year.$month,'count' => 1));
					$data['loan_code'] = $outlet_code.'SL'.$year.$month.sprintf("%06d", 1);
					$data['hidden_code'] = $outlet_code.'SL'.$year.$month;
					$data['hidden_count'] = 1;	
				}
				$this->load->model('sales_model');
				$data['is_mobile'] = $this->is_mobile;
				$data['sales'] = $this->sales_model->get_outlet_sales($this->session_outlet);
				$data['title'] = 'Gadai';
				$this->template->load($this->default,'loan/new_loan',$data);	
			}
		}

		/*DELETE LOAN AJAX*/
		public function delete_loan($code=''){
			$loan = $this->crud_model->get_by_condition('loan',array('loan_code' => $code))->row();
			if($loan){
				if($loan->photo){
					$dir = 'uploads/photo/loan/'.$this->session_outlet;
					unlink($loan->photo);
					rmdir($dir);	
				}
				if($this->crud_model->delete_data('loan',array('loan_code'=>$code)) && $this->crud_model->delete_data('loan_detail',array('loan_code'=>$code)) ){
					$this->session->set_flashdata('loan',"$.gritter.add({
							class_name : 'gritter-light',
					 		title:	'Berhasil!',
					 		text:	'Transaksi gadai berhasil dihapus!',
					 		time: 1200
					});");
					
				}
				else{
					$this->session->set_flashdata('loan',"$.gritter.add({
					 		title:	'Gagal',
					 		text:	'Transaksi gadai gagal dihapus!',
					 		time: 1200
					});");	
					
				}	
			}else{
				$this->session->set_flashdata('loan',"$.gritter.add({
				 		title:	'Gagal',
				 		text:	'Transaksi gadai gagal dihapus!',
				 		time: 1200
				});");	
				
			}
			redirect('loan');
		}

		public function loan_detail($code = ''){
			$data['title']	= 'Detail Gadai';
			$data['loan']	= $this->loan_model->get_loan_data($code);
			$data['loan_details'] = $this->loan_model->get_loan_details($code);
			$data['loan_histories'] = $this->loan_model->get_loan_history($code);
			$this->template->load($this->default,'loan/loan_detail',$data);
		}

		

	}

 