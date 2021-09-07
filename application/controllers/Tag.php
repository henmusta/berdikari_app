<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tag extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Tag_model');
		$this->load->model('frontend/Settings_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$slug 				= $this->security->xss_clean($this->uri->segment(2));

		$data = array(
			'lists' 		=> $this->Tag_model->lists($slug,8,0),
			'url_loadmore' 	=> 'tag-ajax/'. $slug
		);

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0)
		);

		$heading = $this->meta_header;

		$footer = array(
			'scripts'	=> array(
				$this->load->view('frontend/initjs/beritaList', array(), TRUE)
			),
			'footer_menu'	=> $this->Settings_model->footer_menu()
		);

		if (count($data['lists']) < 1) {
			show_404();
		}

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/tag/lists', $data);
		$this->load->view('frontend/parts/footer', $footer);
	}

	public function loadmore(){
		$tag_slug = $this->security->xss_clean($this->uri->segment(2));
		$page = $this->security->xss_clean($this->uri->segment(3));
		$data = array(
			'lists' => $this->Tag_model->loadmore($tag_slug,$page)
		);
		if (!isset($data['lists']) OR (count($data['lists']) < 1) ) {
			show_404();
		}
		$this->load->view('frontend/tag/ajax-loadmore',$data);
	}
}