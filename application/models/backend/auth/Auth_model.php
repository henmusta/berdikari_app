<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}

	public function sign_in($username = '', $password = ''){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please Insert Username and Passsword',
			'redirect'	=> ''
		);

		if(!empty($username) && !empty($password) ){

			$username 	= $this->db->escape_str(alpnum($this->security->xss_clean($username)));

			$sql 		= "SELECT * FROM administrators WHERE username = ?;";
			$query 		= $this->db->query($sql, array($username));

			$result['message']	= 'User doesn\'t exist';
			if($query->num_rows() > 0){
				$user = $query->row();
				$query->free_result();
				unset($query, $username);
				$result['message']	= 'Sorry, your account has been deactivated.';
				if(trim($user->status) == 'active'){
					$result['message']	= 'Your password doesn\'t match.';
					if(password_verify($password, $user->password)){
						unset($password, $user->password);
						$auth = array(
							'auth' => array(
								'status' 		=> 'logged_in',
								'user_agent'	=> $_SERVER['HTTP_USER_AGENT'],
								'ip_address'	=> $this->input->ip_address()
							),
							'user' => $user
						);
						$this->session->set_userdata($auth);
						unset($auth);
						$result = array(
							'status'	=> 'success',
							'message'	=> 'Wellcome ' . $user->fullname,
							'redirect'	=> ''
						);
						unset($user);
					}
				}
			}
		}
		return $result;
		unset($result);
	}

	public function check_user_exists($username = ''){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'User not found',
			'redirect'	=> ''
		);

		if(!empty($username)){
			$username 	= $this->db->escape_str(alpnum($this->security->xss_clean($username)));

			$sql 		= "SELECT administrator_id FROM administrators WHERE username = ?;";
			$query 		= $this->db->query($sql, array($username));

			$result['message']	= 'User doesn\'t exist';
			if($query->num_rows() > 0){
				$query->free_result();
				$result = array(
					'status'	=> 'success',
					'message'	=> '',
					'redirect'	=> ''
				);
			}
		}

		return $result;
		unset($username,$sql,$query,$result);

	}

}