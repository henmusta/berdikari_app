<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Single extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Single_model');
		$this->load->model('frontend/Settings_model');
		$this->load->model('frontend/Post_count_model');
		$this->ads = $this->Settings_model->ads();
	}

	public function index(){
		$slug = $this->security->xss_clean($this->uri->segment(4));
		$page = $this->security->xss_clean($this->uri->segment(5));
		$data = $this->Single_model->data($slug, $page);
        if( isset($data['title']) ){
    		$this->render_meta_header(
    			array(
    				'title'=> $data['title'],
    				'image'=> $data['image_medium'],
    				'description' => $data['synopsis'],
    				'keyword' => $data['keywords']
    			)
    		);
    
    		$header = array(
    			'metadata' 		=> $this->meta_header,
    			'main_menu' 	=> $this->Settings_model->main_menu(0),
    			'title'=> $data['title'],
    		);
    		
    		if (trim($data['module']) == 'berita-foto') {
    			$footer = array(
    				'scripts'	=> array(
    					$this->load->view('frontend/initjs/beritaFotoCarousel', array(), TRUE),
    					$this->load->view('frontend/initjs/beritaCount', array(
    						'post_id' => $data['post_id']
    					), TRUE)
    				),
    				'footer_menu'	=> $this->Settings_model->footer_menu()
    			);
    		}else{
    			$footer = array(
    				'scripts' => array(
    					$this->load->view('frontend/initjs/beritaCount', array(
    						'post_id' => $data['post_id']
    					), TRUE)
    				),
    				'footer_menu'	=> $this->Settings_model->footer_menu()
    			);
    		}
		
    		$this->load->view('frontend/parts/header', $header);
    		$this->load->view('frontend/'. trim($data['module']) .'/detail', $data);
    		$this->load->view('frontend/parts/footer', $footer);		    
		} else {
    		$header = array(
    			'metadata' 		=> $this->meta_header,
    			'main_menu' 	=> $this->Settings_model->main_menu(0),
    			'title'         => 'Halaman tidak ditemukan',
    		);
    		
		    $this->load->view('frontend/parts/header', $header);
		    $this->load->view('frontend/parts/footer');
		}

	}
}