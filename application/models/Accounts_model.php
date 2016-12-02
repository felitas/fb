<?php 
	
class Accounts_model extends CI_Model{

	function check_user($username = '',$password = ''){
		if($user = $this->db->get_where('accounts',array('username' => $username, 'password' => $password))->row()){
			return $user;
		}else{
			return false;
		}
	}

	function check_username($username){
		if($this->db->get_where('accounts',array('username' => $username))->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

}

?>