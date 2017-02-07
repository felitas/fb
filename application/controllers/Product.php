<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Product extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('product_model');
		}

		public function index(){
			$data['title'] = 'Product';
			$data['is_mobile'] = $this->is_mobile;
			$data['role']=$this->session_role;
			$data['products'] = $this->product_model->get_product_all_outlet();

			$this->template->load($this->default,'product/list_product',$data);
		}

		/****ADD NEW ITEM START****/
		public function upload(){
			//upload image via webcam

			$this->load->library('image_moo');

			$config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 5000;					
			$config['upload_path']          = 'uploads/temp/product/'.$this->session_outlet.'/'.$this->session_id;
			$config['overwrite']			= True;
			$config['file_name']			= 'product'.$this->session_id.'.jpg';
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

		public function add_product(){
			if($this->session_role != 'admin'&&$this->session_role!='manager'){
				redirect('home');
			}
			if($this->input->post()){
				$this->load->library('image_moo');

				$config['allowed_types']        = 'jpg|png|jpeg';
	            $config['max_size']             = 5000;					
				$config['upload_path']          = 'uploads/photo/product/'.$this->input->post('product_tray');
				$config['overwrite']			= false;
				$config['file_name']			= $this->input->post('product_code').'.jpg';
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

					rename('uploads/temp/product/'.$this->session_outlet.'/'.$this->session_id.'/'.'product'.$this->session_id.'.jpg' , $photo);	
					
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

	            $data_product = array(

	            		'name'					=> $this->input->post('product_name'),
	            		// 'product_code'	=> $this->input->post('product_code'),
	            		'product_type'			=> $this->input->post('product_type'),
	            		'product_category'		=> $this->input->post('product_category'),
	            		'product_collection'	=> $this->input->post('product_model'),
	            		// 'real_weight'	=> $this->input->post('product_real_weight'),
	            		// 'rounded_weight'=> $this->input->post('product_rounded_weight'),
	            		'purchase_price'		=> $this->input->post('product_purchase_price'),
	            		'sell_price'			=> $this->input->post('product_selling_price'),
	            		'gold_amount'			=> $this->input->post('product_gold_amount'),
	            		'weight' 				=> $this->input->post('product_weight'),
	            		'photo'					=> $photo,
	            		'outlet_id'				=> $this->input->post('product_outlet'),
	            		'tray_id'				=> $this->input->post('product_tray'),
	            		'barcode_code'			=> $this->input->post('product_barcode_code'),
	            		'product_code' 			=> $this->input->post('product_code')

	            	);
	            // $data_code = array(
	            // 		'code' => $this->input->post('product_barcode_code'),
	            // 		'count'=> $this->input->post('product_count')

	            // 	);
	            //$this->db->update('code',array('count' => $this->input->post('count')+1),array('code' => $this->input->post('code')));
            
            	for($i = 0; $i < count($this->input->post('stone_type')); $i++){
            		$data_spec = array(
            			'product_code' => $this->input->post('product_code'),
            			'stone_type' => $this->input->post('stone_type')[$i],
            			'stone_amount' => $this->input->post('stone_amount')[$i],
            			'stone_ct' => $this->input->post('stone_ct')[$i]

            		);

            		$this->db->insert('specification',$data_spec);
            	}

	          	$code_count = array(
	          			'code' => $this->input->post('product_barcode_code'),
	          			'count'=> 1
	          		);
	            if($this->crud_model->insert_data('products',$data_product)){
	            	if($this->db->get_where('code',array('code'=>$this->input->post('product_barcode_code')))->num_rows()>0){
	            		$count = $this->db->get_where('code',array('code'=>$this->input->post('product_barcode_code')))->row('count');
	            		$this->db->update('code',array('count'=> $count+1),array('code'=>$this->input->post('product_barcode_code')));
		            }else{
		            	$this->crud_model->insert_data('code',$code_count);
		            }
	            	$this->session->set_flashdata('product',"$.gritter.add({
	            		class_name : 'gritter-light',
					    title: 'Berhasil',
					    text: 'Berhasil tambah produk',
					    time: 1200
					});");	
	            }else{
	            	$this->session->set_flashdata('product',"$.gritter.add({
					    title: 'Gagal',
					    text: 'Produk tidak berhasil diinput',
					    time: 1200
					});");
	            }
	            
	            redirect('product/add_product');

			}else{
				$data['title'] = 'Product';
				// $data['stone_type'] = $this->db->get('diamond_type')->result();
				$data['is_mobile'] = $this->is_mobile;
				$data['types']= $this->crud_model->get_data('type')->result();
				$data['categories']=$this->crud_model->get_data('category')->result();
				$data['trays'] = $this->db->get_where('tray', array('outlet_id' => $this->session_outlet))->result();
				$data['diamond_types'] = $this->crud_model->get_data('diamond_type')->result();
				$data['models'] = $this->crud_model->get_data('model')->result();
				$data['outlets']=$this->crud_model->get_data('outlets')->result();
				$data['role']=$this->session_role;
				$data['codes'] = $this->crud_model->get_data('code')->result();
				// $data['gold_amount'] = $this->db->get('gold_amount')->result();
				$this->template->load($this->default,'product/add_product',$data);
			}
		}
		/*ajax for insert product*/		
		// public function get_data_new_product($tray_id = ''){
		// 	$this->load->model('tray_model');
		// 	$outlet_code = $this->db->get_where('outlets',array('id' => $this->session_outlet))->row('code');
		// 	$tray = $this->tray_model->get_specific_tray($tray_id);
		// 	$code = $this->db->get_where('code',array('code' => $outlet_code.$tray->code))->row();
		// 	if($code){
		// 		$data = (array) $tray;
		// 		$data['product_code'] = $code->code.sprintf("%05d", $code->count);
		// 		$data['hidden_code'] = $code->code;
		// 		$data['hidden_count'] = $code->count;
		// 		$data = (Object) $data;
		// 		echo json_encode($data);
		// 	}else{
		// 		$this->db->insert('code',array('code' => $outlet_code.$tray->code,'count' => 1));
		// 		$data = (array) $tray;
		// 		$data['product_code'] = $outlet_code.$tray->code.sprintf("%05d", 1);
		// 		$data['hidden_code'] = $outlet_code.$tray->code;
		// 		$data['hidden_count'] = 1;
		// 		$data = (Object) $data;
		// 		echo json_encode($data);
				
		// 	}
		// }
		/* end of ajax */

		/*ajax for insert product*/
		// public function count_gold_amount($gold_amount_id = ''){
		// 	$gold_amount = $this->db->get_where('gold_amount',array('id'=>$gold_amount_id))->row();
		// 	$gold_amount = (array) $gold_amount;
		// 	$gold_amount['gold_price'] = $this->db->get_where('currency',array('id' => 2))->row('value');
		// 	echo json_encode($gold_amount);

		// }

		/*EDIT PRODUCT*/
		public function edit_product($code){
			if($this->session_role != 'admin'&&$this->session_role!='manager'){
				redirect('home');
			}
			if($this->input->post()){
				$this->load->library('image_moo');

				$config['allowed_types']        = 'jpg|png|jpeg';
	            $config['max_size']             = 5000;					
				$config['upload_path']          = 'uploads/photo/product/'.$this->input->post('product_tray');
				$config['overwrite']			= false;
				$config['file_name']			= $this->input->post('product_code').'.jpg';
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

					rename('uploads/temp/product/'.$this->session_outlet.'/'.$this->session_id.'/'.'product'.$this->session_id.'.jpg' , $photo);	
					
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

	            $data_product = array(
	            		'name'					=> $this->input->post('product_name'),
	            		'purchase_price'		=> $this->input->post('product_purchase_price'),
	            		'sell_price'			=> $this->input->post('product_selling_price'),
	            		'gold_amount'			=> $this->input->post('product_gold_amount'),
	            		'weight' 				=> $this->input->post('product_weight'),
	            		'photo'					=> $photo,
	            		'outlet_id'				=> $this->input->post('product_outlet'),
	            		'tray_id'				=> $this->input->post('product_tray'),
	            	);

	            if($this->input->post('product_type') == 'B'){
	            	for($i = 0; $i < count($this->input->post('stone_type')); $i++){
	            		$data_spec = array(
	            			'product_code' => $this->input->post('product_code'),
	            			'stone_type' => $this->input->post('stone_type')[$i],
	            			'stone_amount' => $this->input->post('stone_amount')[$i],
	            			'stone_ct' => $this->input->post('stone_ct')[$i]

	            		);
	            		$this->db->insert('specification',$data_spec);
	            	}
	            }
	          	$code_count = array(
	          			'code' => $this->input->post('product_barcode_code'),
	          			'count'=> 1
	          	);

	            if($this->crud_model->update_data('products',$data_product,array('product_code'=>$code)) ){
	            	$this->session->set_flashdata('product',"$.gritter.add({
	            		class_name : 'gritter-light',
					    title: 'Berhasil',
					    text: 'Data produk telah di edit',
					    time: 1500
					});");	
	            }else{
	            	$this->session->set_flashdata('product',"$.gritter.add({
					    title: 'Gagal',
					    text: 'Data produk tidak berhasil di edit',
					    time: 1500
					});");
	            }
	            
	            redirect('product');

			}else{
				$data['product']= $this->crud_model->get_by_condition('products',array('product_code'=>$code))->row();
				$data['title'] = 'Product';
				// $data['stone_type'] = $this->db->get('diamond_type')->result();
				$data['is_mobile'] = $this->is_mobile;
				$data['types']= $this->crud_model->get_data('type')->result();
				$data['categories']=$this->crud_model->get_data('category')->result();

				$outlet_id=$data['product']->outlet_id;
				$data['trays'] = $this->crud_model->get_by_condition('tray',array('outlet_id'=>$outlet_id))->result();

				// $data['trays'] = $this->db->get_where('tray', array('outlet_id' => $this->session_outlet))->result();
				$data['diamond_types'] = $this->crud_model->get_data('diamond_type')->result();
				$data['models'] = $this->crud_model->get_data('model')->result();
				$data['outlets']=$this->crud_model->get_data('outlets')->result();
				$data['role']=$this->session_role;
				// $data['specifications'] = $this->crud_model->get_by_condition('')
				$data['codes'] = $this->crud_model->get_data('code')->result();
				
				// $data['gold_amount'] = $this->db->get('gold_amount')->result();
				$this->template->load($this->default,'product/edit_product',$data);
			}
		}

		
		/*DELETE PRODUCT AJAX*/
		public function delete_product($id=''){
			if($this->crud_model->delete_data('products',array('id'=>$id))){
				$this->session->set_flashdata('product',"$.gritter.add({
						class_name : 'gritter-light',
				 		title:	'Berhasil!',
				 		text:	'Produk berhasil dihapus!',
				 		time: 1500
				});");
				redirect('product');
			}
			else{
				$this->session->set_flashdata('product',"$.gritter.add({
				 		title:	'Gagal',
				 		text:	'Produk gagal dihapus!',
				 		time: 1500
				});");	
				redirect('product');
			}
			
		}

		

		/*ajax to get code count*/
		public function get_code_count($product_barcode_code = ''){
			echo $this->db->get_where('code',array('code' => $product_barcode_code))->row('count');
		}

		/*AJAX TO GET PRODUCT THRU BARCODE - USED FOR MUTATION AND SELL ITEM */
		public function get_product_by_code($product_code = '',$outlet_id=''){
			$product = $this->product_model->get_product_by_code($product_code,$outlet_id);
			
			if($product == NULL){
				echo 'not found';
			}else{
				
				$product = (array) $product;
				$product['sell_price'] = number_format($product['sell_price'],0,',','.');
				$product = (Object) $product;
				echo json_encode($product);	
			}
		}



		/****ADD NEW ITEM END****/
}
?>