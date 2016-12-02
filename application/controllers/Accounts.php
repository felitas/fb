<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Accounts extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('accounts_model');
			
		}

		public function index(){
			
			$this->login();

		}

		public function login(){
			//check if user has logged in
			if($this->session->userdata('is_logged')){
				//redirect to home if user already logged in
				redirect('home');
			}
			//begin login process
			if($this->input->post()){
				//store username and password to variables
				$username = $this->input->post('username');
				$password = hash_password($this->input->post('password'));

				//check if the username and password exist
				if($user = $this->accounts_model->check_user($username,$password)){
					$data_session = array(
							'user_id'		=> $user->id,
							'user_role'		=> $user->role,
							'user_outlet'	=> $user->outlet_id,
							'user_name'		=> $user->name,
							'is_logged'		=> true,
						);

					//store user information into session
					$this->session->set_userdata($data_session);

					//success notification
					$this->session->set_flashdata('success',"$.Notify({caption: 'Login Sukses !', content: 'Selamat Datang ,".$user->name."', type: 'info'});");

					redirect('home');

				}
				//if user does not exist
				else{
					//failed notification
					$this->session->set_flashdata('failed',"$.Notify({caption: 'Login Gagal !', content: 'Username atau Password salah', type: 'alert'});");

					redirect('accounts/login');
				}


			}
			//if there is no post.
			else{
				//show login page
				$this->load->view('login');
			}
		}

		public function logout(){
			//destroy the session
			$this->session->sess_destroy();
			//notification
			$this->session->set_flashdata('failed',"$.Notify({caption: 'Logout Sukses !', content: '', type: 'alert'});");

			redirect('accounts/login');
		}

		public function check_username($username = ''){
			if ($username != '') {
				if ($this->accounts_model->check_username($username)) {
					echo 'taken';
				}
				else{
					echo 'available';
				}
			}
		}

	}

 ?>