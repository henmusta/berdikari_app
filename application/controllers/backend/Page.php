<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/posts/Page_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__Page',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'page'	,	'is_active'=>TRUE,	'href'=>'page')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-page',
			'title'			=> 'list of page',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'page/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Title</th>
						<th>Status</th>
						<th>Date Publish</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'page/datatables',
			'delete_url' 		=> 'page/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>2,'dir'=>'desc'),
			'columns' => array(
				'{ data: "title" },',
				'{ 
					data: "status", width:"50px", className:"text-center",
					render : function(data, type, row, meta){
						let status_class = "secondary";
						if(data == "Publish"){
							status_class = "success";
						}
						return \'<label class="badge badge-pill badge-\' + status_class + \'">\'+ data +\'</label>\';
					}
				},',
				'{ data: "date_publish", width:"250px" },',
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
				$this->load->view('backend/posts/page/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/page/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function add(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/select2/css/select2.min.css',
				'../assets/backend/js/plugins/summernote-0.8.12/summernote-bs4.css',
				'../assets/backend/js/plugins/flatpicker/flatpicker.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__page',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'page'		,	'is_active'=>FALSE,	'href'=>'page'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'page/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-page',
			'title'			=> 'form add new page',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'page/insert',
			'validation'	=> array(
				'check_title' => 'page/check-title'
			),
			'select2_categories' => array(
				'id' 	=> 'select2-categories',
				'url'	=> 'page/select2-categories'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'page/select2-authors'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/moment/moment.min.js',
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
				'../assets/backend/js/plugins/summernote-0.8.12/summernote-bs4.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/flatpicker/flatpicker.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/posts/page/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/page/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/select2/css/select2.min.css',
				'../assets/backend/js/plugins/summernote-0.8.12/summernote-bs4.css',
				'../assets/backend/js/plugins/flatpicker/flatpicker.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__page',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'page'		,	'is_active'=>FALSE,	'href'=>'page'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'page/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-page',
			'title'			=> 'form edit page',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'page/update',
			'validation'	=> array(
				'check_title' => 'page/check-title'
			),
			'select2_categories' => array(
				'id' 	=> 'select2-categories',
				'url'	=> 'page/select2-categories'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'page/select2-authors'
			),
			'data'		=> $this->Page_model->single($pk)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/moment/moment.min.js',
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
				'../assets/backend/js/plugins/summernote-0.8.12/summernote-bs4.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/flatpicker/flatpicker.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/posts/page/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/page/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Page_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Page_model->insert($this->input->post(NULL))
			)
		);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Page_model->update($this->input->post(NULL))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Page_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
	public function select2_categories(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Page_model->select2_categories($this->input->post(NULL, TRUE))
			)
		);
	}
	public function select2_authors(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Page_model->select2_authors($this->input->post(NULL, TRUE))
			)
		);
	}
	public function check_title(){
		$title 		= isset($_POST['data']['title']) ? trim($_POST['data']['title']) : NULL;
		$pk_except 	= isset($_POST['pk_except']) ? (int)$_POST['pk_except'] : 0;
		$result 	= $this->Page_model->check_title($title,$pk_except);
		$this->output->set_output(
			((isset($result['status']) && $result['status'] == 'success') ? 'true' : 'false')
		);
		unset($title,$result);
	}
}