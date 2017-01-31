<?php

	defined('BASEPATH') or exit('No direct script access allowed');

	class Mutation extends MY_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('mutation_model');
		}

		public function index(){
			$data['title'] = 'Mutasi';
			$data['is_mobile'] = $this->is_mobile;
			$data['mutations'] = $this->crud_model->get_data('mutation')->result();
			$data['role']=$this->session_role;
			$this->template->load($this->default,'mutation/list_mutation',$data);
		}

		public function sent_item(){
			$data['title'] = 'Daftar Barang Terkirim';
			$data['is_mobile'] = $this->is_mobile;
			$data['role']=$this->session_role;
			$data['sent_items'] = $this->mutation_model->get_sent_items($this->session_outlet);
			$this->template->load($this->default,'mutation/list_sent_item',$data);	
		}

	}
?>