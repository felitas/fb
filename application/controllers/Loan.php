<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Loan extends MY_Controller{

		function __construct(){
			parent::__construct();
			
			$this->load->model('loan_model');
			$this->load->model('sales_model');
		
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
				$data['loans'] = $this->load_model->get_loan_this_outlet($this->session_outlet);
			}
			$this->template->load($this->default,'loan/list_loan',$data);
		}
		/****list loan END****/

		/****Detail Transaksi Penjualan****/
		public function detail($code = ''){
			$data['title'] = 'Detail Penjualan';
			$data['details'] = $this->sale->get_sale_detail($this->session_outlet,$code);
			
			$this->template->load($this->default,'sale/sale_detail',$data);
		}
		/****Detail Transaksi Penjualan END****/

		/**** LOAN START ****/
		public function new_loan(){
			
			if($this->input->post()){
				
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

				if($this->db->insert('loan',$data_loan)){
					for($i = 0; $i < count($this->input->post('product_code')); $i++){
						$data_detail = array(
								'product_code' => $this->input->post('product_code')[$i],
								'discount' => $this->input->post('discount')[$i],
								'sale_code' => $this->input->post('sale_code'),
								'selling_price' => $this->input->post('product_price')[$i],
								'total_price' => $this->input->post('discount')[$i],
							);
						$this->db->insert('loan_detail',$data_detail);
					}

					$this->session->set_flashdata('loan',"$.gritter.add({
						class_name : 'gritter-light'
					    title: 'Berhasil',
					    text: 'Gadai berhasil di input',
					    time : 1500
					});");

					redirect('loan');
				}else{
					$this->session->set_flashdata('loan',"$.gritter.add({
					    title: 'Gagal',
					    text: 'Gagal transaksi',
					    time: 1500
					});");

					redirect('loan/new_loan');
				}

			}else{
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

				$data['sales'] = $this->sales_model->get_outlet_sales($this->session_outlet);
				$data['title'] = 'Gadai';
				$this->template->load($this->default,'loan/new_loan',$data);	
			}
				
		
		}

		public function get_new_customer_code(){
			$code = $this->db->get_where('code',array('code' => 'MKM'))->row();
			if($code){
				$data['customer_code'] = $code->code.sprintf("%010d", $code->count);
				$data['hidden_customer_code'] = $code->code;
				$data['hidden_customer_count'] = $code->count;
			}else{
				$this->db->insert('code',array('code' => 'MKM','count' => 1));
				$data['customer_code'] = 'MKM'.sprintf("%010d", 1);
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

 