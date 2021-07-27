<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kontak_kami extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Guestbooks_model');
		$this->load->model('frontend/Settings_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){

		$this->load->helper('captcha_helper');
		$this->session->set_userdata('captcha', simple_php_captcha());

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
			'title'         => 'Kontak kami'
		);

		$heading = array(
			'title' => 'Kontak Kami'
		);

		$datasettings 	= $this->db->get('settings')->result_array();

		$results = array();

		if(count($datasettings) > 0){
			foreach($datasettings AS $row){
				$results[trim($row['keyword'])] = $row['value'];
			}
		}

		$data = array(
			'captcha' => $this->session->userdata('captcha')
		);
		$data['contactad1'] = explode('|',$results['contact_ad_1']);
		$data['contactad2'] = explode('|',$results['contact_ad_2']);
		$data['contactad3'] = explode('|',$results['contact_ad_3']);

		$footer = array(
			'footer_menu'	=> $this->Settings_model->footer_menu(),
			'scripts'		=> array(
				$this->load->view('frontend/initjs/kontakKami',array(),TRUE)
			)
		);

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/kontak-kami/kontak-kami', $data);
		$this->load->view('frontend/parts/footer', $footer);

	}

	public function send(){
		$response =	$this->Guestbooks_model->send($this->input->post(NULL, TRUE));
		$response_code = isset($response['status']) && $response['status'] == 'success'  
			? 'HTTP/1.0 200 OK' 
			: 'HTTP/1.0 406 Not Acceptable'; 
		$this->output
		->set_header($response_code)
		->set_content_type('application/json')
		->set_output(
			json_encode($response)
		);
	}


}