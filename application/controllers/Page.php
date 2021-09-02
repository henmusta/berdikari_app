<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Page_model');
		$this->load->model('frontend/Settings_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$slug 		= $this->security->xss_clean($this->uri->segment(2));

		$data = $this->Page_model->single($slug);

		$this->render_meta_header(
			array(
				'title' => $data['title'],
				'description' => $data['synopsis'],
				'keyword' => $data['keywords']
			)
		);

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
			'title'         => $data['title']
		);

		$heading = $this->meta_header;

		$footer = array(
			'footer_menu'	=> $this->Settings_model->footer_menu(),
			'scripts'		=> array(
				$this->load->view('frontend/initjs/kontakKami',array(),TRUE)
			)
		);

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/page/page', $data);
		$this->load->view('frontend/parts/footer', $footer);

	}

}