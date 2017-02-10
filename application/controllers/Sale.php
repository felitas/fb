<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sale extends MY_Controller{

		function __construct(){
			parent::__construct();
			
			$this->load->model('sale_model','sale');
			$this->load->model('type_model','type');
		}

		/****List Penjualan****/
		public function index(){
			$data['title'] = 'Daftar Penjualan';
			if ($this->session_role == 'admin') {
				$data['outlets'] = $this->db->get('outlets')->result();
				//$data['sale'] = $this->sale->get_sale_by_outlet(1);
				if($this->input->post())
				{
					if(!empty($this->input->post('keyword')))
					{
						$this->db->where("(sale.sale_code LIKE '%".$this->input->post('keyword')."%' OR 
							sale.qty LIKE '%".$this->input->post('keyword')."%' OR
							s1.name LIKE '%".$this->input->post('keyword')."%' OR
							c1.name LIKE '%".$this->input->post('keyword')."%' OR
							o1.name LIKE '%".$this->input->post('keyword')."%' OR
							c2.name LIKE '%".$this->input->post('keyword')."%' OR
							sale.total_price LIKE '%".$this->input->post('keyword')."%')", NULL, FALSE);
						$data['keyword']	= $this->input->post('keyword');
					}
					if(!empty($this->input->post('date')))
					{
						$date 		= explode('-', $this->input->post('date'));
						$newdate	= date("Y-m-d H:i:s", mktime(0,0,0,$date[1],$date[2],$date[0]));
						$this->db->where('sale.date', $newdate);
						$data['date']	= $this->input->post('date');
					}
					if(!empty($this->input->post('outlet_id')))
					{
						$this->db->where('sale.outlet_id', $this->input->post('outlet_id'));
						$data['outlet_id']	= $this->input->post('outlet_id');
					}
					if(!empty($this->input->post('type_id')))
					{
						$this->db->where('products.type_id', $this->input->post('type_id'));
						$data['type_id']	= $this->input->post('type_id');
					}
					if(!empty($this->input->post('omzet')))
					{
						$this->db->where('sale.total_price >= '.$this->input->post('omzet'), NULL, FALSE);
						$data['omzet']	= $this->input->post('omzet');
					}
					if(!empty($this->input->post('timbangan')))
					{
						$this->db->where('products.real_weight >= '.$this->input->post('timbangan'), NULL, FALSE);
						$data['timbangan']	= $this->input->post('timbangan');
					}
				}

				$data['sale'] = $this->sale->get_all();
				$data['type'] = $this->type->get_all();
			}else{
				$data['outlets'] = NULL;
				//$data['sale'] = $this->sale->get_sale_by_outlet($this->session_outlet);	
				$data['sale'] = $this->sale->get_many_by($this->sale->_table.'.outlet_id',$this->session_outlet);	
			}
			
			$this->template->load($this->default,'sale/list_sale',$data);
		}
		/****list Penjualan END****/

		/****Detail Transaksi Penjualan****/
		public function detail($code = ''){
			$data['title'] = 'Detail Penjualan';
			$data['details'] = $this->sale->get_sale_detail($this->session_outlet,$code);
			
			$this->template->load($this->default,'sale/sale_detail',$data);
		}
		/****Detail Transaksi Penjualan END****/

		/**** SELLING START ****/
		public function new_sale(){
			
			if($this->input->post()){
				print_r($this->input->post());
				exit;
				/**kalo ada customer baru di insert**/
				
				if($this->input->post('new_customer') == 'on'){
					$data_customer = array(
							'code'		=> $this->input->post('customer_code'),
							'name'		=> $this->input->post('customer_name'),
							'phone'		=> $this->input->post('customer_phone'),
							'email'		=> $this->input->post('customer_email'),
							'address'	=> $this->input->post('customer_address'),
							'type'		=> $this->input->post('customer_type')
						);

					$this->db->insert('customers', $data_customer);
					$this->db->update('code',array('count' => $this->input->post('hidden_customer_count') + 1 ),array('code' => $this->input->post('hidden_customer_code')));
				}

				

				if($this->input->post('customer_type') == 'Member' || $this->input->post('customer_type_hidden') == 'Member' ){
					
					$member_point = $this->db->get_where('member_point',array('active' => 1))->row();

					if($this->input->post('total_price') >= $member_point->target){
						$add_point = floor($this->input->post('total_price') / $member_point->target);
						$curr_point = $this->db->get_where('customers',array('code' => $this->input->post('customer_code')))->row('member_point');

						$this->db->update('customers',array('member_point' => $curr_point+$add_point),array('code' => $this->input->post('customer_code')));
					}
				}

				$data_sale = array(
						'sale_code' => $this->input->post('sale_code'),
						'date' => date('Y-m-d H:i'),
						'outlet_id' => $this->session_outlet,
						'sales_id' => $this->input->post('sales_id'),
						'cashier_id' => $this->session_id,
						'customer_code' => $this->input->post('customer_code'),
						'qty' => count($this->input->post('product_code')),
						'total_price' => $this->input->post('total_price')
					);


				if($this->db->insert('sale',$data_sale)){
					for($i = 0; $i < count($this->input->post('product_code')); $i++){
						$data_detail = array(
								'product_code' => $this->input->post('product_code')[$i],
								'discount' => $this->input->post('discount')[$i],
								'sale_code' => $this->input->post('sale_code'),
								'selling_price' => $this->input->post('product_price')[$i],
								'total_price' => $this->input->post('discount')[$i],
							);
						/**update barang kejual**/
						$this->db->update('products', array('status' => 'terjual','selling_price' => $this->input->post('discount')[$i]), array('product_code' => $this->input->post('product_code')[$i]));
						$this->db->insert('sale_detail',$data_detail);
					}
					/**update count code**/
					$this->db->update('code',array('count' => $this->input->post('hidden_count') + 1 ),array('code' => $this->input->post('hidden_code')));

					$this->session->set_flashdata('sale',"$.Notify({
					    caption: 'Berhasil',
					    content: 'Penjualan Berhasil',
					    type: 'success'
					});");

					redirect('sale/new_sale');
				}else{
					$this->session->set_flashdata('sale',"$.Notify({
					    caption: 'Gagal',
					    content: 'Gagal transaksi',
					    type: 'alert'
					});");

					redirect('sale/new_sale');
				}

			}else{
				$outlet_code = $this->db->get_where('outlets',array('id' => $this->session_outlet))->row('code');
				$code = $this->db->get_where('code',array('code' => $outlet_code.'JU'))->row();
				if($code){
					$data['sale_code'] = $code->code.sprintf("%05d", $code->count);
					$data['hidden_code'] = $code->code;
					$data['hidden_count'] = $code->count;
				}else{
					$this->db->insert('code',array('code' => $outlet_code.'JU','count' => 1));
					$data['sale_code'] = $outlet_code.'JU'.sprintf("%05d", 1);
					$data['hidden_code'] = $outlet_code.'JU';
					$data['hidden_count'] = 1;	
				}
				$this->load->model('sales_model');

				$data['sales'] = $this->sales_model->get_outlet_sales($this->session_outlet);
				$data['title'] = 'Penjualan';
				$this->template->load($this->default,'sale/new_sale',$data);	
			}
				
		
		}

		public function get_customer($code = ''){
			$customer = $this->db->get_where('customers',array('code' => $code))->row();
			if($customer == NULL){
				echo 'not found';
			}else{
				$customer = (Object) $customer;
				echo json_encode($customer);	
			}
		}

		public function get_new_customer_code(){
			$code = $this->db->get_where('code',array('code' => 'MKM'))->row();
			if($code){
				$data['customer_code'] = $code->code.sprintf("%07d", $code->count);
				$data['hidden_customer_code'] = $code->code;
				$data['hidden_customer_count'] = $code->count;
			}else{
				$this->db->insert('code',array('code' => 'MKM','count' => 1));
				$data['customer_code'] = 'MKM'.sprintf("%07d", 1);
				$data['hidden_customer_code'] = 'MKM';
				$data['hidden_customer_count'] = 1;
			}
			$data = (Object) $data;
			echo json_encode($data);
		}

		/**** SELLING ENDS ****/
		
		public function get_sale_by_outlet($outlet_id = ''){
			$sale = $this->sale->get_sale_by_outlet($outlet_id);
			if($sale == NULL){
				echo 'not found';
			}else{
				$sale = (Object) $sale;
				echo json_encode($sale);	
			}
			
		}
		
		public function get_sale_by_type($type_id = ''){
			$type = $this->type->get($type_id);

			$sale = $this->sale->get_sale_by_type($type_id,$type->name);
			if($sale == NULL){
				echo 'not found';
			}else{
				$sale = (Object) $sale;
				echo json_encode($sale);	
			} 
			
		}

		

	}

 