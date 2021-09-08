<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrators extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/websettings/Administrators_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Administrators',
				'breadcrumbs' => array(
					array('title'=>'web settings'		,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'administrators'		,	'is_active'=>TRUE,	'href'=>'administrators')
				)
			),
		);

		$datatables = array(
			'id'			=> 'table-administrators',
			'title'			=> 'list of administrators',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'administrators/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th style="vertical-align:middle;padding:0px!important;"><i class="far fa-user"></i></th>
						<th>Name</th>
						<th>Username</th>
						<th>status</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'administrators/datatables',
			'delete_url' 		=> 'administrators/delete',
			'reset_url'			=> 'administrators/reset-password',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>1,'dir'=>'asc'),
			'columns' => array(
				'{ data: "image", orderable:false, className:"text-center p-1", width:"50px" },',
				'{ data: "fullname" },',
				'{ data: "username" },',
				'{ data: "status" },',
				'{ data: "actions", className:"text-center", width:"50px", orderable:false }'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/datatables/jquery.dataTables.min.js',
				'../assets/backend/js/plugins/datatables/datatables.bootstrap4.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',

			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/administrators/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/administrators/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function add(){
		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Administrators',
				'breadcrumbs' => array(
					array('title'=>'web settings'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'administrators'		,	'is_active'=>FALSE,	'href'=>'administrators'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'administrators/add')
				)
			)
        );
        

		$form = array(
			'id'				=> 'form-administrators',
			'title'				=> 'form add new administrators',
			'subtitle'			=> '',
			'method'			=> 'POST',
			'action'			=> 'administrators/insert',
			'check_username_url'=> 'administrators/check-username'
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',

			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/administrators/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/administrators/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Administrators',
				'breadcrumbs' => array(
					array('title'=>'web settings'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'administrators'	,	'is_active'=>FALSE,	'href'=>'administrators'),
					array('title'=>'edit'			,	'is_active'=>TRUE,	'href'=>'administrators/edit')
				)
				
			)
		);

		$form = array(
			'id'				=> 'form-administrators',
			'title'				=> 'form edit administrators',
			'idupdate'			=> 'form-updatepassword',
			'titleupdate'		=> 'form edit password',
			'subtitle'			=> '',
			'method'			=> 'POST',
			'action_url'			=> 'administrators/update',
			'actionupdate'		=> 'administrators/update-password',
			'data'				=> $this->Administrators_model->single($pk),
			'check_username_url'=> 'administrators/check-username'

		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js'
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/administrators/js/edit', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/administrators/html/edit', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Administrators_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function insert(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Administrators_model->insert($this->input->post(NULL))
				)
			);
	}
	public function update(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Administrators_model->update($this->input->post(NULL))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Administrators_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
	public function check_username(){
		$username 		= isset($_POST['data']['username']) ? trim($_POST['data']['username']) : NULL;
		$pk_except 		= isset($_POST['pk_except']) ? (int)$_POST['pk_except'] : 0;
		$result 		= $this->Administrators_model->check_username($username,$pk_except);
		$this->output->set_output(
			((isset($result['status']) && $result['status'] == 'success') ? 'true' : 'false')
		);
		unset($username,$result);

	}
	public function reset_password(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Administrators_model->reset_password($this->input->post(NULL, TRUE))
			)
		);
	}
	public function update_password(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Administrators_model->update_password($this->input->post(NULL, TRUE))
			)
		);
	}
}