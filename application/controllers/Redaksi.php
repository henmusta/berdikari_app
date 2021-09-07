<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Redaksi extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Redaksi_model');
		$this->load->model('frontend/Settings_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
			'title'         => 'Redaksi'
		);

		$heading = array(
			'title' => 'Redaksi'
		);
		
		$footer = array(
			'footer_menu'	=> $this->Settings_model->footer_menu()
		);
		$list = $this->Redaksi_model->lists();		
		$data = array(
			'lists' => $this->Redaksi_model->lists()
		);
		if (!isset($data['lists']) OR (count($data['lists']) < 1) ) {
			show_404();
		}

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/redaksi/redaksi', $data);
		$this->load->view('frontend/parts/footer', $footer);
	}
}
