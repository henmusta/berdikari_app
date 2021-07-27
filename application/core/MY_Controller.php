<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Backend_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->is_login();
	}

	protected function is_login(){
		$auth = $this->session->userdata('auth');
        if($auth['status'] !== 'logged_in' 
			&& $auth['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] 
			&& $auth['ip_address'] !== $this->input->ip_address()
        ){ 
            redirect('backend/auth');
            exit;
        }
	}

}
class Frontend_Controller extends CI_Controller {

	protected $meta_header;

	public function __construct(){
		parent::__construct();
		$this->get_meta_header();
	}
	protected function get_meta_header(){

		$data 	= $this->db->get('settings')->result_array();

		$results = array();

		if(count($data) > 0){
			foreach($data AS $row){
				$results[trim($row['keyword'])] = $row['value'];
			}
		}

		$this->meta_header = array(
			'title'  			=> (isset($results['web_title']) ? htmlentities($results['web_title'],ENT_QUOTES) : ''),
			'description'  		=> (isset($results['web_description']) ? htmlentities($results['web_description'],ENT_QUOTES) : ''),
			'keyword'  			=> (isset($results['web_keyword']) ? htmlentities($results['web_keyword'],ENT_QUOTES) : ''),
			'image'				=> base_url('uploads/default_share.jpg'),
			'facebook_url' 		=> (isset($results['facebook_url']) ? htmlentities($results['facebook_url'],ENT_QUOTES) : ''),
			'twitter_url' 		=> (isset($results['twitter_url']) ? htmlentities($results['twitter_url'],ENT_QUOTES) : ''),
			'instagram_url' 	=> (isset($results['instagram_url']) ? htmlentities($results['instagram_url'],ENT_QUOTES) : ''),
			'whatsapp_number' 	=> (isset($results['whatsapp']) ? htmlentities($results['whatsapp'],ENT_QUOTES) : ''),
			'google_analitycs' 	=> (isset($results['google_analitycs']) ? $results['google_analitycs'] : ''),
			'address' 			=> (isset($results['address']) ? htmlentities($results['address'],ENT_QUOTES) : ''),
			'telp'				=> (isset($results['telp']) ? htmlentities($results['telp'],ENT_QUOTES) : ''),
			'fax'				=> (isset($results['fax']) ? htmlentities($results['fax'],ENT_QUOTES) : ''),
			'email'				=> (isset($results['email']) ? htmlentities($results['email'],ENT_QUOTES) : ''),
			'site_name'			=> 'Kupas Tuntas',
			'og_type'			=> 'website'
		);
	}

	protected function render_meta_header($new_value){
		if(is_array($new_value)){
			$this->meta_header = array_unique(array_merge($this->meta_header, $new_value));
		}
	}

}