<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Advertising extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/websettings/Advertising_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Advertising',
				'breadcrumbs' => array(
					array('title'=>'web settings'		,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'advertising'		,	'is_active'=>TRUE,	'href'=>'advertising')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-advertising',
			'title'			=> 'list of advertising',
			'subtitle'		=> '',
			'thead'			=> trim('
				<thead>
					<tr>
						<th style="vertical-align:middle;padding:0px!important;"><i class="fa fa-2x fa-image"></i></th>
						<th>Title</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'advertising/datatables',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>3,'dir'=>'asc'),
			'columns' => array(
				'{ data: "image", orderable:false, className:"text-center p-1", width:"50px" },',
				'{ data: "title" },',
				'{ data: "type" },',
				'{ data: "actions", className:"text-center", width:"50px"}'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/datatables/jquery.dataTables.min.js',
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',

			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/advertising/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/advertising/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Advertising',
				'breadcrumbs' => array(
					array('title'=>'web settings'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'advertising'	,	'is_active'=>FALSE,	'href'=>'advertising'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'advertising/edit')
				)
			)
		);

		$form = array(
			'id'				=> 'form-advertising',
			'title'				=> 'form edit advertising',
			'subtitle'			=> '',
			'method'			=> 'POST',
			'action_url'		=> 'advertising/update',
			'data'				=> $this->Advertising_model->single($pk),
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/advertising/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/advertising/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Advertising_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Advertising_model->update($this->input->post(NULL))
				)
			);
	}
}