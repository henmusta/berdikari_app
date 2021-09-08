<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/master/categories_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Categories',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'categories'		,	'is_active'=>TRUE,	'href'=>'categories')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-categories',
			'title'			=> 'list of categories',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'categories/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Path and Category Title</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'categories/datatables',
			'delete_url' 		=> 'categories/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>0,'dir'=>'asc'),
			'columns' => array(
				'{ 
					data: "path",
					render: function ( data, type, row, meta ) {
						return row.title + "<br/><small>" + data + "</small>";
					}
				},',
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
				$this->load->view('backend/master/categories/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/categories/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function add(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/select2/css/select2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Categories',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'categories'		,	'is_active'=>FALSE,	'href'=>'categories'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'categories/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-category',
			'title'			=> 'form add new category',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'categories/insert',
			'select2_parent' => array(
				'id' 	=> 'select2-parent',
				'url'	=> 'categories/select2-parent'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/categories/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/categories/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/select2/css/select2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'MASTER DATA',
				'subtitle' 		=> '__Categories',
				'breadcrumbs' => array(
					array('title'=>'master data'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'categories'		,	'is_active'=>FALSE,	'href'=>'categories'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'categories/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-category',
			'title'			=> 'form edit category',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'categories/update',
			'data'			=> $this->categories_model->single($pk),
			'select2_parent' => array(
				'id' 	=> 'select2-parent',
				'url'	=> 'categories/select2-parent'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/master/categories/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/master/categories/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->categories_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->categories_model->insert($this->input->post(NULL))
				)
			);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->categories_model->update($this->input->post(NULL))
				)
			);
	}
	public function delete(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->categories_model->delete($this->input->post(NULL, TRUE))
			)
		);
	}
	public function select2_parent(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->categories_model->select2_parent($this->input->post(NULL, TRUE))
			)
		);
	}
}