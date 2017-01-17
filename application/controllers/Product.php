<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Product extends MY_Controller{
		function __construct(){
			parent::__construct();
		}

		public function index(){
			$data['title'] = 'Product';
			$data['is_mobile'] = $this->is_mobile;
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
				echo '<pre>';
				print_r($this->input->post());
				echo '</pre>';
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

	            		'name'			=> $this->input->post('product_name'),
	            		// 'product_code'	=> $this->input->post('product_code'),
	            		'type'			=> $this->input->post('product_type'),
	            		// 'category'		=> $this->input->post('product_category'),
	            		// 'real_weight'	=> $this->input->post('product_real_weight'),
	            		// 'rounded_weight'=> $this->input->post('product_rounded_weight'),
	            		// 'selling_price'	=> $this->input->post('product_selling_price'),
	            		// 'gold_amount'	=> $this->input->post('gold_amount'),
	            		// 'tray_id'		=> $this->input->post('product_tray'),
	            		// 'photo'			=> $photo,
	            		// 'outlet_id'		=> $this->session_outlet,

	            	);

	            $this->db->update('code',array('count' => $this->input->post('count')+1),array('code' => $this->input->post('code')));

	            // if($this->input->post('product_type') == 'Berlian'){
	            // 	for($i = 0; $i < count($this->input->post('stone_type')); $i++){
	            // 		$data_spec = array(
	            // 			'product_code' => $this->input->post('product_code'),
	            // 			'stone_type' => $this->input->post('stone_type')[$i],
	            // 			'stone_amount' => $this->input->post('stone_amount')[$i],
	            // 			'stone_ct' => $this->input->post('stone_ct')[$i]

	            // 		);

	            // 		$this->db->insert('specification',$data_spec);
	            // 	}
	            // }

	            if($this->crud_model->insert_data('products',$data_product)){
	            	$this->session->set_flashdata('product',"$.gritter.add({
	            		class_name : 'gritter-light',
					    title: 'Berhasil',
					    text: 'Berhasil tambah produk',
					    time: 2000
					});");	
	            }else{
	            	$this->session->set_flashdata('product',"$.gritter.add({
					    class_name : 'gritter-light',
					    title: 'Berhasil',
					    text: 'Berhasil tambah produk',
					    time: 2000
					});");
	            }
	            
	            redirect('product/add_product');

			}else{
				$data['title'] = 'Product';
				// $data['stone_type'] = $this->db->get('diamond_type')->result();
				$data['is_mobile'] = $this->is_mobile;
				$data['types']= $this->crud_model->get_data('type')->result();
				$data['trays'] = $this->db->get_where('tray', array('outlet_id' => $this->session_outlet))->result();
				$data['diamond_types'] = $this->crud_model->get_data('diamond_type')->result();
				$data['models'] = $this->crud_model->get_data('model')->result();
				$data['outlets']=$this->crud_model->get_data('outlets')->result();
				$data['role']=$this->session_role;
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


		/* end of ajax */

		/*Ajax to get item category*/
		public function get_category_data($type_id=''){
			$this->load->model('configuration_model');
			$type=$this->db->get_where('type',array('id'=>$type_id))->row();
			$categories = $this->configuration_model->get_category($type_id);	
			$output='';
			if($categories){
				// $output.="<option value=''>--Pilih Kategori ".$type->name."--</option>";
				foreach ($categories as $category) {
					$output.="<option value=' ".$category->id."'>".$category->code." - ".$category->name."</option>";
				}
				echo $output;
			}else{
				echo 'Belum ada kategori';
			}
		}

		/*Ajax to get tray data*/
		public function get_tray_data($outlet_id = ''){
			$this->load->model('configuration_model');
			$tray = $this->configuration_model->get_tray($outlet_id);
			$output = '';
			if($tray){
				foreach($tray as $row){
					$output .= "<option value='".$row->id."'>".$row->code." - ".$row->description."</option>";
				}
				echo $output;
			}else{
				echo 'Toko ini belum punya baki';
			}
		}


		/****ADD NEW ITEM END****/
}
?>