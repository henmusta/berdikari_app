<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class E_paper extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/E_paper_model');
		$this->load->model('frontend/Settings_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$slug 		= $this->security->xss_clean($this->uri->segment(1));
		$category 	= $this->Settings_model->single_category($slug);
		
		$data = array(
			'lists' => $this->E_paper_model->lists(8,0),
			'url_loadmore' => 'e-paper-ajax/'
		);

		$this->render_meta_header($category);

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
			'title'         => 'E Paper'
		);

		$heading = $this->meta_header;

		$footer = array(
			'scripts'	=> array(
				$this->load->view('frontend/initjs/epaperList', array(), TRUE)
			),
			'footer_menu'	=> $this->Settings_model->footer_menu()
		);

		//if (!isset($category['title']) OR !isset($data['lists']) OR (count($data['lists']) < 1) ) {
			//show_404();
		//}

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/e-paper/lists',$data);
		$this->load->view('frontend/parts/footer', $footer);
	}
	public function loadmore(){
		$page = $this->security->xss_clean($this->uri->segment(2));
		$data = array(
			'lists' => $this->E_paper_model->loadmore($page)
		);
		//if (!isset($data['lists']) OR (count($data['lists']) < 1) ) {
			//show_404();
		//}
		$this->load->view('frontend/e-paper/ajax-loadmore',$data);
	}
}