<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/auth/Auth_model');
	}

	public function index($page = 'home'){
		$data = array(
			'form' => array(
				'id'			=> 'sing-in',
				'action' 		=> 'auth/sign-in',
				'validation' 	=> array(
					'find_user_url'	=> 'auth/find-user'
				)
			)
		);

		$this->load->view('backend/auth/sign-in', $data);
		unset($data);

	}

	public function find_user(){

		$username 	= isset($_POST['data']['username']) ? trim($_POST['data']['username']) : NULL;
		$result 	= $this->Auth_model->check_user_exists($username);
		$this->output->set_output(
			((isset($result['status']) && $result['status'] == 'success') ? 'true' : 'false')
		);
		unset($username,$result);

	}	

	public function sign_in(){
		$username = isset($_POST['data']['username']) ? trim(alpnum($_POST['data']['username'])) : NULL;
		$password = isset($_POST['data']['password']) ? trim($_POST['data']['password']) : NULL;
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode($this->Auth_model->sign_in($username, $password))
		);
	}

	public function sign_out(){
		$this->session->unset_userdata(array('auth','user'));
		redirect('backend/auth');
	}
}