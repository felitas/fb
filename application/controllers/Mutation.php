<?php

	defined('BASEPATH') or exit('No direct script access allowed');

	class Mutation extends MY_Controller{
		function __construct(){
			parent::__construct();
		}

		public function index(){
			$data['title'] = 'Mutasi';
			$data['is_mobile'] = $this->is_mobile;
			$data['mutations'] = $this->crud_model->get_data('mutation')->result();
			$data['role']=$this->session_role;
			$this->template->load($this->default,'mutation/list_mutation',$data);
		}

	}
?>