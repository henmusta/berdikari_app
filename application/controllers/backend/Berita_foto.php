<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita_foto extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/posts/Berita_foto_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__Berita Foto',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita-foto'	,	'is_active'=>TRUE,	'href'=>'berita-foto')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-berita-foto',
			'title'			=> 'list of berita foto',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'berita-foto/add',
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
			'source_url' 		=> 'berita-foto/datatables',
			'delete_url' 		=> 'berita-foto/delete',
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
				'{ data: "actions", className:"text-center", width:"50px" }'
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
				$this->load->view('backend/posts/berita-foto/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita-foto/html/datatables', $datatables);
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
				'subtitle' 		=> '__Berita Foto',
				'breadcrumbs' => array(
					array('title'=>'Posts'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita-foto'	,	'is_active'=>FALSE,	'href'=>'berita-foto'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'berita-foto/add')
				)
			)
		);

		$form = array(
			'id'			=> 'form-berita-foto',
			'title'			=> 'form add new berita-foto',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'berita-foto/insert',
			'validation'	=> array(
				'check_title' => 'berita-foto/check-title'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'berita-foto/select2-authors'
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
				$this->load->view('backend/posts/berita-foto/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita-foto/html/form', $form);
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
				'subtitle' 		=> '__berita-foto',
				'breadcrumbs' => array(
					array('title'=>'Posts'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita-foto'	,	'is_active'=>FALSE,	'href'=>'berita-foto'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'berita-foto/edit')
				)
			)
		);

		$form = array(
			'id'			=> 'form-berita-foto',
			'title'			=> 'form edit berita-foto',
			'subtitle'		=> '',
			'method'		=> 'POST',
			'action'		=> 'berita-foto/update',
			'validation'	=> array(
				'check_title' => 'berita-foto/check-title'
			),
			'select2_categories' => array(
				'id' 	=> 'select2-categories',
				'url'	=> 'berita-foto/select2-categories'
			),
			'select2_authors' => array(
				'id' 	=> 'select2-authors',
				'url'	=> 'berita-foto/select2-authors'
			),
			'data'		=> $this->Berita_foto_model->single($pk)
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
				$this->load->view('backend/posts/berita-foto/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita-foto/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Berita_foto_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Berita_foto_model->insert($this->input->post(NULL))
			)
		);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Berita_foto_model->update($this->input->post(NULL))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Berita_foto_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
	public function select2_authors(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Berita_foto_model->select2_authors($this->input->post(NULL, TRUE))
			)
		);
	}
	public function check_title(){
		$title 		= isset($_POST['data']['title']) ? trim($_POST['data']['title']) : NULL;
		$pk_except 	= isset($_POST['pk_except']) ? (int)$_POST['pk_except'] : 0;
		$result 	= $this->Berita_foto_model->check_title($title,$pk_except);
		$this->output->set_output(
			((isset($result['status']) && $result['status'] == 'success') ? 'true' : 'false')
		);
		unset($title,$result);
	}
	public function upload(){
		$upload = $this->Berita_foto_model->upload($this->input->post(NULL, TRUE));
		$header = 'HTTP/1.1 403 Forbidden';
		if($upload['status'] == 'success'){
			$header = 'HTTP/1.1 200 OK';
		}
		$this->output
		->set_header($header)
		->set_content_type('application/json')
		->set_output(
			json_encode($upload)
		);
	}
	public function gallery(){
		$pk = (int)$this->uri->segment(4);
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/dropzone/dist/min/dropzone.min.css',
				'../assets/backend/js/plugins/bootstrap4-editable/css/bootstrap-editable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Posts',
				'subtitle' 		=> '__Gallery Berita Foto',
				'breadcrumbs' => array(
					array('title'=>'Posts'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'berita foto'	,	'is_active'=>FALSE,	'href'=>'berita-foto'),
					array('title'=>'gallery'	,	'is_active'=>TRUE,	'href'=>'gallery')
				)
			)
		);

		$gallery = array(
			'data'	=> $this->Berita_foto_model->single($pk),
			'dropzone' => array(
				'id'		=> 'dropzone',
				'action' 	=> 'berita-foto/upload'
			),
			'datatable'	=> array(
				'id'			=> 'table-berita-foto',
				'title'			=> 'Lists Of Images',
				'subtitle'		=> '',
				'thead'			=> trim('
					<thead>
						<tr>
							<th>Image</th>
							<th>Caption</th>
							<th>Delete</th>
						</tr>
					</thead>
				'),
				'tfoot'				=> trim(''),
				'source_url' 		=> 'berita-foto/datatables-gallery',
				'delete_url' 		=> 'berita-foto/delete-image',
				'display_length' 	=> 5,
				'order_column'		=> array('number'=>0,'dir'=>'asc'),
				'columns' => array(
					'{ 
						data: "source",
						width:"150px",
						render : function(data, type, row, meta){
							return \'<img class="img-thumbnail" src="\' + data + \'">\';
						}
					},',
					'{ 
						data: "caption",
						render : function(data, type, row, meta){
							return \'<a href="#" class="x-editable" data-type="textarea" data-placement="left" data-pk="\' + row.post_image_id + \'" data-url="berita-foto/update-field" data-name="caption">\'+ ((data != null) ? data : "")  +\'</a>\';
						}

					},',
					'{ data: "actions", className:"text-center", width:"50px" }'
				),
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/datatables/jquery.dataTables.min.js',
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
				'../assets/backend/js/plugins/dropzone/dist/min/dropzone.min.js',
				'../assets/backend/js/plugins/bootstrap4-editable/js/bootstrap-editable.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/posts/berita-foto/js/gallery',  $gallery, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/posts/berita-foto/html/gallery', $gallery);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables_gallery(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode($this->Berita_foto_model->datatables_gallery($this->input->post(NULL, TRUE)))
		);
	}
	public function delete_image(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Berita_foto_model->delete_image($this->input->post(NULL, TRUE))
			)
		);
	}
	public function update_field(){
		$upload = $this->Berita_foto_model->update_field($this->input->post(NULL, TRUE));
		$header = 'HTTP/1.1 403 Forbidden';
		if($upload['status'] == 'success'){
			$header = 'HTTP/1.1 200 OK';
		}
		$this->output
		->set_header($header)
		->set_output($upload['message']);
	}
}