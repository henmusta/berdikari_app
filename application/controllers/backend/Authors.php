<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authors extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/master/Authors_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Authors',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'authors'		,	'is_active'=>TRUE,	'href'=>'authors')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-authors',
			'title'			=> 'list of authors',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'authors/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th style="vertical-align:middle;padding:0px!important;"><i class="far fa-user"></i></th>
						<th>Name</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'authors/datatables',
			'delete_url' 		=> 'authors/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>1,'dir'=>'asc'),
			'columns' => array(
				'{ data: "image", orderable:false, className:"text-center p-1", width:"50px" },',
				'{ data: "fullname" },',
				'{ data: "actions", className:"text-center", width:"50px", orderable: false }'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/datatables/jquery.dataTables.min.js',
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/authors/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/authors/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function add(){
		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Authors',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'authors'		,	'is_active'=>FALSE,	'href'=>'authors'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'authors/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-author',
			'title'			=> 'form add new author',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'authors/insert'
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/authors/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/authors/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Authors',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'authors'		,	'is_active'=>FALSE,	'href'=>'authors'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'authors/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-author',
			'title'			=> 'form edit author',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'authors/update',
			'data'			=> $this->Authors_model->single($pk)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/authors/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/authors/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Authors_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Authors_model->insert($this->input->post(NULL, TRUE))
				)
			);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Authors_model->update($this->input->post(NULL, TRUE))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Authors_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}

}