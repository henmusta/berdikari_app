<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Indeks extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Indeks_model');
		$this->load->model('frontend/Settings_model');
		$this->load->library('pagination');
		$this->ads = $this->Settings_model->ads();
	} 

	public function index(){
		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
			'title'         => 'Indeks'
		);

		$heading = array(
			'title' => 'Indeks'
		);
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
		$config['base_url']   			= base_url("indeks/");
		$config['total_rows'] 			= $this->Indeks_model->get_numrows();
		$config['per_page']	  			= 10;
		$config['uri_segment'] 			= 2;
    	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
   		
		$this->pagination->initialize($config);
		$data = array(
			'lists' => $this->Indeks_model->lists($config['per_page'], $page),
			'links' => $this->pagination->create_links(),
			'url_loadmore' => 'indeks-ajax/'
		);

		$footer = array(
			'scripts'	=> array(
				$this->load->view('frontend/initjs/beritaList', array(), TRUE)
			),
			'footer_menu'	=> $this->Settings_model->footer_menu()
		);

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/parts/pre-header', $heading);
		$this->load->view('frontend/berita/lists', $data);
		$this->load->view('frontend/parts/footer', $footer);
	}
	public function loadmore(){
		$categoryslug = $this->security->xss_clean($this->uri->segment(2));
		$page = $this->security->xss_clean($this->uri->segment(3));
		$data = array(
			'lists' => $this->Indeks_model->loadmore($categoryslug,$page)
		);
		if (!isset($data['lists']) OR (count($data['lists']) < 1) ) {
			show_404();
		}
		$this->load->view('frontend/berita/ajax-loadmore',$data);
	}
}