<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class E_paper extends Backend_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('backend/posts/E_paper_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__E-Paper',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'e-paper'	,	'is_active'=>TRUE,	'href'=>'e-paper')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-e-paper',
			'title'			=> 'list of e-paper',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'e-paper/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Status</th>
						<th>Date Publish</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'e-paper/datatables',
			'delete_url' 		=> 'e-paper/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>3,'dir'=>'desc'),
			'columns' => array(
				'{ data: "title" },',
				'{ data: "author", width:"80px" },',
				'{ 
					data: "status",
					render : function(data, type, row, meta){
						let status_class = "secondary";
						if(data == "Publish"){
							status_class = "success";
						}
						return \'<label class="badge badge-pill badge-\' + status_class + \'">\'+ data +\'</label>\';
					}
				},',
				'{ data: "date_publish", width:"100px" },',
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
				$this->load->view('backend/posts/e-paper/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/e-paper/html/datatables', $datatables);
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
				'subtitle' 		=> '__E-Paper',
				'breadcrumbs' => array(
					array('title'=>'Posts'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'e-paper'	,	'is_active'=>FALSE,	'href'=>'e-paper'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'e-paper/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-e-paper',
			'title'			=> 'form add new e-paper',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'e-paper/insert',
			'validation'	=> array(
				'check_title' => 'e-paper/check-title'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'e-paper/select2-authors'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/moment/moment.min.js',
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
				'../assets/backend/js/plugins/summernote-0.8.12/summernote-bs4.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/flatpicker/flatpicker.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/posts/e-paper/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/e-paper/html/form', $form);
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
				'subtitle' 		=> '__E-Paper',
				'breadcrumbs' => array(
					array('title'=>'Posts'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'e-paper'	,	'is_active'=>FALSE,	'href'=>'e-paper'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'e-paper/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-e-paper',
			'title'			=> 'form edit e-paper',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'e-paper/update',
			'validation'	=> array(
				'check_title' => 'e-paper/check-title'
			),
			'select2_categories' => array(
				'id' 	=> 'select2-categories',
				'url'	=> 'e-paper/select2-categories'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'e-paper/select2-authors'
			),
			'data'		=> $this->E_paper_model->single($pk)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/moment/moment.min.js',
				'../assets/backend/js/plugins/select2/js/select2.full.min.js',
				'../assets/backend/js/plugins/summernote-0.8.12/summernote-bs4.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/flatpicker/flatpicker.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/posts/e-paper/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/e-paper/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->E_paper_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->E_paper_model->insert($this->input->post(NULL))
			)
		);
	}
	public function update(){
		$this->output
			//->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->E_paper_model->update($this->input->post(NULL))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->E_paper_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
	public function select2_authors(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->E_paper_model->select2_authors($this->input->post(NULL, TRUE))
			)
		);
	}
	public function check_title(){
		$title 		= isset($_POST['data']['title']) ? trim($_POST['data']['title']) : NULL;
		$pk_except 	= isset($_POST['pk_except']) ? (int)$_POST['pk_except'] : 0;
		$result 	= $this->E_paper_model->check_title($title,$pk_except);
		$this->output->set_output(
			((isset($result['status']) && $result['status'] == 'success') ? 'true' : 'false')
		);
		unset($title,$result);
	}
}