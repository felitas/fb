<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class MY_Controller extends CI_Controller{
		protected $is_mobile;
		protected $session_role;
		protected $session_id;
		protected $session_outlet;
		protected $default;

		function __construct(){
			parent::__construct();

			if($this->agent->is_mobile()){
				$this->is_mobile = true;
			}
			if(!$this->session->userdata('is_logged')){
				redirect('accounts');
			}else{
				$this->session_role = $this->session->userdata('user_role');
				$this->session_id = $this->session->userdata('user_id');
				$this->session_outlet = $this->session->userdata('user_outlet');
				if($this->session_role == 'admin'){
					$this->default = 'default';
				}elseif($this->session_role == 'manager'){
					$this->default = 'default_manager';
				}elseif($this->session_role == 'sales'){
					$this->default = 'default_sales';
				}
			}

			// $sales_photo = 'uploads/temp/sales/'.$this->session_outlet.'/'.$this->session_id.'/'.'sales'.$this->session_id.'.jpg';
			// if(file_exists($sales_photo))
			// {
			// 	//if not make the folder so the upload is possible
			// 	unlink($sales_photo);
			// }
					
		}


	}

 ?>