<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Indeks_model');
		$this->load->model('frontend/Settings_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
			'title'         => 'Search'
		);

		$heading = array(
			'title' => 'Search'
		);

		$footer = array(
			'footer_menu'	=> $this->Settings_model->footer_menu()
		);

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/search');
		$this->load->view('frontend/parts/footer', $footer);
	}
}