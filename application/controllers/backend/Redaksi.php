<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Redaksi extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/master/Redaksi_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Redaksi',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'redaksi'		,	'is_active'=>TRUE,	'href'=>'redaksi')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-redaksi',
			'title'			=> 'list of redaksi',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'redaksi/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th style="vertical-align:middle;padding:0px!important;"><i class="far fa-user"></i></th>
						<th>Name</th>
						<th>Position</th>
						<th>Location</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'redaksi/datatables',
			'delete_url' 		=> 'redaksi/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>1,'dir'=>'asc'),
			'columns' => array(
				'{ data: "image", orderable:false, className:"text-center p-1", width:"50px" },',
				'{ data: "fullname" },',
				'{ data: "nama", width:"100px", className:"text-center" },',
				'{ data: "loc", width:"50px", className:"text-center" },',
				'{ data: "actions", className:"text-center", width:"50px", orderable: false }'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/datatables/jquery.dataTables.min.js',
				'../assets/backend/js/plugins/datatables/datatables.bootstrap4.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/redaksi/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/redaksi/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function add(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/select2/css/select2.min.css',
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Redaksi',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'redaksi'		,	'is_active'=>FALSE,	'href'=>'redaksi'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'redaksi/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-redaksi',
			'title'			=> 'form add new redaksi',
			'subtitle'		=> '',
			'method'		=> 'POST',
			// 'sort'			=> $this->Redaksi_model->sort(),
			'action'		=> 'redaksi/insert',
			'select2_position' => array(
				'id' 	=> 'select2-position',
				'url'	=> 'redaksi/select2-position'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/master/redaksi/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/redaksi/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/select2/css/select2.min.css',
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Redaksi',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'redaksi'		,	'is_active'=>FALSE,	'href'=>'redaksi'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'redaksi/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-redaksi',
			'title'			=> 'form edit redaksi',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'redaksi/update',
			// 'sort'			=> $this->Redaksi_model->sort(),
			'data'			=> $this->Redaksi_model->single($pk),
			'select2_position' => array(
				'id' 	=> 'select2-position',
				'url'	=> 'redaksi/select2-position'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/master/redaksi/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/redaksi/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Redaksi_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Redaksi_model->insert($this->input->post(NULL, TRUE))
				)
			);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Redaksi_model->update($this->input->post(NULL, TRUE))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Redaksi_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
	public function select2_position(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Redaksi_model->select2_position($this->input->post(NULL, TRUE))
			)
		);
	}

}
