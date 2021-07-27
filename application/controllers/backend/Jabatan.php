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

		$datatables = array(
			'id'			=> 'table-jabatan',
			'title'			=> 'list of jabatan',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'jabatan/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Nama Jabatan</th>
						<th>Aksi<th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'jabatan/datatables',
			'delete_url' 		=> 'jabatan/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>0,'dir'=>'asc'),
			'columns' => array(
				'{ data: "nama" },',
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
}
