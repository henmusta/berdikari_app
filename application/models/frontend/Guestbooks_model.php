<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestbooks_model extends MY_Model {

	public function __construct(){
		parent::__construct();
	}

	public function send($post = array()){
		$data = array(
			'name' 			=> filter_var($post['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
			'email' 		=> filter_var($post['email'], FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH),
			'phone' 		=> filter_var($post['phone'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH),
			'subject' 		=> filter_var($post['subject'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
			'message' 		=> filter_var($post['message'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)
		);
		$diff = array_diff(array('name','email','phone','subject','message','captcha'), array_keys($post));		
		$result = array(
			'status' 	=> 'error',
			'message' 	=> 'Please complete field of : ' . implode(',',$diff)
		);
		if(count($diff) < 1) {
			$empty_field = array_search(NULL, $post);
			$result['message'] = 'Please insert field : ' . $empty_field;
			if(empty($empty_field)){
				$result['message'] = 'Please Input Captcha';
				if( isset($post['captcha']) ){
					$result['message'] = 'Your captcha code doesn\'t match';
					$code_captcha 			= $this->session->captcha['code'] ;
					$input_code_captcha 	= trim($post['captcha']);
					if($code_captcha === $input_code_captcha){
						if($this->db->insert('guestbooks',$data)){
							$result = array(
								'status' 	=> 'success',
								'message' 	=> 'Yout message has been sent'
							);
						}
					}
				}
			}
		}
		return $result;
	}

}