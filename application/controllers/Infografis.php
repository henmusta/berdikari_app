<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Infografis extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Infografis_model');
		$this->load->model('frontend/Settings_model');
		$this->load->model('frontend/Count_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$slug 		= $this->security->xss_clean($this->uri->segment(1));
		$category 	= $this->Settings_model->single_category($slug);

		$data = array(
			'infographic' => $this->Infografis_model->lists(6,0),
			'url_loadmore' => 'infografis-ajax'
		);

		$this->render_meta_header($category);

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0)
		);

		$heading = $this->meta_header;

		$footer = array(
			'scripts'	=> array(
				$this->load->view('frontend/initjs/infografisList', array(), TRUE)
			),
			'footer_menu'	=> $this->Settings_model->footer_menu()
		);

		if (!isset($category['title']) OR !isset($data['infographic']) OR (count($data['infographic']) < 1) ) {
			show_404();
		}

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/infografis/lists',$data);
		$this->load->view('frontend/parts/modalInfografis');
		$this->load->view('frontend/parts/footer', $footer);
	}
	
	public function loadmore(){
		$page = $this->security->xss_clean($this->uri->segment(2));
		$data = array(
			'infographic' => $this->Infografis_model->loadmore($page)
		);
		if (!isset($data['infographic']) OR (count($data['infographic']) < 1) ) {
			show_404();
		}
		$this->load->view('frontend/infografis/ajax-loadmore',$data);
	}

}