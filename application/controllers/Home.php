<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('frontend/Berita_model');
		$this->load->model('frontend/E_paper_model');
		$this->load->model('frontend/Kupas_tv_model');
		$this->load->model('frontend/Settings_model');

		$this->ads = $this->Settings_model->ads();
	}
	public function index(){

		$header = array(
			'metadata' 		=> $this->meta_header,
			'main_menu' 	=> $this->Settings_model->main_menu(0),
		);
		
		$footer = array(
			'scripts'	=> array(
				$this->load->view('frontend/initjs/modalInfografis', array(), TRUE)
			),
			'footer_menu'	=> $this->Settings_model->footer_menu(),
			'metadata' 		=> $this->meta_header
		);
		$data = array(
			'latest_news'     => $this->Berita_model->lists('',3,0),
			'option_news'     => $this->Berita_model->lists('berita-pilihan',4,0),
			'populer'	      => $this->Berita_model->lists('populer',4,0),
			'politik'	      => $this->Berita_model->lists('politik',4,0),
			'e_paper'	  	  => $this->E_paper_model->lists(3,0),
			'seputar_lampung' => $this->Berita_model->category_hierarchy_lists('daerah-lampung',5,0),
			'kupas_tv'        => $this->Kupas_tv_model->lists(6,0)
		);

		$this->load->view('frontend/parts/header', $header);
		$this->load->view('frontend/home/home', $data);
		$this->load->view('frontend/parts/footer', $footer);


		// echo "<pre>";
		// echo print_r($data);
		// echo "</pre>";
		// die();


	}

/*	public function create_favicon(){

		$sizes 		= array(228,192,180,152,128,96,76,57,64,32,16);
		$favicon 	= UPLOADS_FOLDER . 'favicon/favicon.png';
		$extension 	= pathinfo($favicon,PATHINFO_EXTENSION);

		$this->load->library('image_lib');

		foreach($sizes AS $size){
			$init = array(
				'image_library' 	=> 'gd2',
				'source_image' 		=> $favicon,
				'new_image' 		=> UPLOADS_FOLDER . 'favicon' . DS . 'favicon-' . $size . '.' . $extension,
				'maintain_ratio'	=> TRUE,
				'width' 			=> $size,
				'height' 			=> $size
			);
			$this->image_lib->initialize($init);
			if(!$this->image_lib->resize()){
				return $this->image_lib->display_errors();
			}
			$this->image_lib->clear();
		}

	}*/
}