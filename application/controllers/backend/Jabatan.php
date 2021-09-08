<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jabatan extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/master/Jabatan_model');
	}

	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Jabatan',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'jabatan'		,	'is_active'=>TRUE,	'href'=>'jabatan')
				)
			)
		);

		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/datatables.bootstrap4.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Jabatan',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'jabatan'		,	'is_active'=>TRUE,	'href'=>'jabatan')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-jabatan',
			'title'			=> 'list of jabatan',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'jabatan/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Nama Jabatan</th>
						<th>Location</th>
						<th>Sort</th>
						<th>Aksi<th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'jabatan/datatables',
			'delete_url' 		=> 'jabatan/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>2,'dir'=>'asc'),
			'columns' => array(
				'{ data: "nama" },',
				'{ data: "location"},',
				'{ data: "sort" },',
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
				$this->load->view('backend/master/jabatan/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/jabatan/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}

	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Jabatan_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}

	public function add(){
		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Jabatan',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'jabatan'		,	'is_active'=>FALSE,	'href'=>'jabatan'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'jabatan/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-jabatan',
			'title'			=> 'form add jabatan',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'sort'			=> $this->Jabatan_model->sort(),
			'action'		=> 'jabatan/insert'
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/jabatan/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/jabatan/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}

	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Jabatan',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'jabatan'		,	'is_active'=>FALSE,	'href'=>'jabatan'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'jabatan/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-jabatan',
			'title'			=> 'form edit jabatan',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'jabatan/update',
			'sort'			=> $this->Jabatan_model->sort(),
			'data'			=> $this->Jabatan_model->single($pk)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/jabatan/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/jabatan/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}

	public function insert(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Jabatan_model->insert($this->input->post(NULL, TRUE))
				)
			);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Jabatan_model->update($this->input->post(NULL, TRUE))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Jabatan_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
}
