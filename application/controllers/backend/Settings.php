<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/websettings/Settings_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/bootstrap4-editable/css/bootstrap-editable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web Settings',
				'subtitle' 		=> '__Settings',
				'breadcrumbs' => array(
					array('title'=>'Web Settings'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'settings'	,	'is_active'=>TRUE,	'href'=>'settings')
				)
			)
		);

		$data = array(
			'title' 	=> "Settings",
			'settings' 	=> $this->Settings_model->data_settings(),
			'logo'		=> $this->db->query("SELECT * FROM settings WHERE keyword = 'logo_image'")->row(),
			'favicon'	=> $this->db->query("SELECT * FROM settings WHERE keyword = 'favicon_image'")->row(),
		);

		$footer = array(
			'javascripts' => array(
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
				'../assets/backend/js/plugins/bootstrap4-editable/js/bootstrap-editable.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/settings/js/pages', array() ,TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/settings/html/pages', $data);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function update(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Settings_model->update($this->input->post(NULL, FALSE))
			)
		);
	}
	public function update_logo(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Settings_model->update_logo()
			)
		);
	}
	public function update_favicon(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Settings_model->update_favicon($this->input->post(NULL, TRUE))
			)
		);
	}
}