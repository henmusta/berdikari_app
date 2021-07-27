<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kupas_tv extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Kupas_tv_model');
		$this->load->model('frontend/Settings_model');
		$this->load->library('pagination');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$slug 		= $this->security->xss_clean($this->uri->segment(1));
		$category 	= $this->Settings_model->single_category($slug);
		$config['attributes'] 			= array('class' => 'page-link');
	    $config['full_tag_open'] 		= '<ul class="pagination">';
	    $config['full_tag_close'] 		= '</ul>';
	    $config['num_tag_open'] 		= '<li class="page-item">';
	    $config['num_tag_close'] 		= '</li>';
	    $config['cur_tag_open'] 		= '<li class="page-item active"><span class="page-link">';
	    $config['cur_tag_close'] 		= '</span></li>';
	    $config['first_tag_open'] 		= '<li class="page-item">';
	    $config['first_link'] 			= '<i class="fas fa-angle-double-left"></i>';
	    $config['first_tag_close'] 		= '</li>';
	    $config['last_tag_open'] 		= '<li class="page-item">';
	    $config['last_link'] 			= '<i class="fas fa-angle-double-right"></i>';
	    $config['last_tag_close'] 		= '</li>';
	    


	    $config['prev_link'] 			= '<i class="fas fa-angle-left"></i>';
	    $config['prev_tag_open'] 		= '<li class="page-item">';
	    $config['prev_tag_close'] 		= '</li>';

	    $config['next_link'] 			= '<i class="fas fa-angle-right"></i>';
	    $config['next_tag_open'] 		= '<li class="page-item">';
	    $config['next_tag_close'] 		= '</li>';

	    $config['num_links'] 			= 1;
		$config['base_url']   			= base_url($slug);
		$config['total_rows'] 			= $this->Kupas_tv_model->get_total($slug);
		$config['uri_segment'] 			= 2;
		$config['per_page']				= 6;
		$page = $this->uri->segment(2);
		$this->pagination->initialize($config);
		$data = array(
			'lists' => $this->Kupas_tv_model->lists($config['per_page'], $page),
			'links' => $this->pagination->create_links(),
			'url_loadmore' => 'kupas-tv-ajax'
		);

		$this->render_meta_header($category);

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0)
		);

		$heading = $this->meta_header;

		$footer = array(
			'scripts'	=> array(
				$this->load->view('frontend/initjs/beritaList', array(), TRUE)
			),
			'footer_menu'	=> $this->Settings_model->footer_menu(),
			'metadata' 		=> $this->meta_header
		);

		if (!isset($category['title']) OR !isset($data['lists']) OR (count($data['lists']) < 1) ) {
			show_404();
		}

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/kupas-tv/lists',$data);
		$this->load->view('frontend/parts/footer', $footer);
	}

	public function loadmore(){
		$page = $this->security->xss_clean($this->uri->segment(2));
		$data = array(
			'lists' => $this->Kupas_tv_model->loadmore($page)
		);
		if (!isset($data['lists']) OR (count($data['lists']) < 1) ) {
			show_404();
		}
		$this->load->view('frontend/kupas-tv/ajax-loadmore',$data);
	}
}