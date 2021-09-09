<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/posts/Berita_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__Berita',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita'	,	'is_active'=>TRUE,	'href'=>'berita')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-berita',
			'title'			=> 'list of berita',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'berita/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Categories</th>
						<th>Status</th>
						<th>Date Publish</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'berita/datatables',
			'delete_url' 		=> 'berita/delete',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>4,'dir'=>'desc'),
			'columns' => array(
				'{ data: "title" },',
				'{ data: "author", width:"80px" },',
				'{ 
					data: "category",
					width:"120px",
					render : function(data, type, row, meta){
						let text = "";
						data.forEach(function(val){
							text += \'<label class="badge badge-primary">\' + val + \'</label>\';
						});
						return text;
					}
				},',
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
				'{ data: "actions", className:"text-center", width:"50px" }'
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
				$this->load->view('backend/posts/berita/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita/html/datatables', $datatables);
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
				'subtitle' 		=> '__Berita',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita'		,	'is_active'=>FALSE,	'href'=>'berita'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'berita/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-berita',
			'title'			=> 'form add new berita',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'berita/insert',
			'validation'	=> array(
				'check_title' => 'berita/check-title'
			),
			'select2_categories' => array(
				'id' 	=> 'select2-categories',
				'url'	=> 'berita/select2-categories'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'berita/select2-authors'
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
				$this->load->view('backend/posts/berita/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita/html/form', $form);
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
				'subtitle' 		=> '__Berita',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita'		,	'is_active'=>FALSE,	'href'=>'berita'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'berita/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-berita',
			'title'			=> 'form edit berita',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'berita/update',
			'validation'	=> array(
				'check_title' => 'berita/check-title'
			),
			'select2_categories' => array(
				'id' 	=> 'select2-categories',
				'url'	=> 'berita/select2-categories'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'berita/select2-authors'
			),
			'data'		=> $this->Berita_model->single($pk)
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
				$this->load->view('backend/posts/berita/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Berita_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Berita_model->insert($this->input->post(NULL))
			)
		);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Berita_model->update($this->input->post(NULL))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Berita_model->delete($this->input->post(NULL,TRUE))
				)
			);
	}
	public function select2_categories(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Berita_model->select2_categories($this->input->post(NULL, TRUE))
			)
		);
	}
	public function select2_authors(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Berita_model->select2_authors($this->input->post(NULL, TRUE))
			)
		);
	}
	public function check_title(){
		$title 		= isset($_POST['data']['title']) ? trim($_POST['data']['title']) : NULL;
		$pk_except 	= isset($_POST['pk_except']) ? (int)$_POST['pk_except'] : 0;
		$result 	= $this->Berita_model->check_title($title,$pk_except);
		$this->output->set_output(
			((isset($result['status']) && $result['status'] == 'success') ? 'true' : 'false')
		);
		unset($title,$result);
	}
}