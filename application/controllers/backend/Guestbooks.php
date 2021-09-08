<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guestbooks extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/interactions/Guestbooks_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Interactions',
				'subtitle' 		=> '__Guestbooks',
				'breadcrumbs' => array(
					array('title'=>'Interactions'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'guestbooks'		,	'is_active'=>TRUE,	'href'=>'guestbooks')
				)
			)
		);

		$datatables = array(
			'id'			=> 'table-guestbooks',
			'title'			=> 'list of guestbooks',
			'subtitle'		=> '',
			'btn_add_new' 	=> 'guestbooks/add',
			'thead'			=> trim('
				<thead>
					<tr>
						<th>Subject</th>
						<th>From</th>
						<th>Date</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
			'),
			'tfoot'				=> trim(''),
			'source_url' 		=> 'guestbooks/datatables',
			'delete_url' 		=> 'guestbooks/delete',
			'reset_url'			=> 'guestbooks/reset-password',
			'display_length' 	=> 10,
			'order_column'		=> array('number'=>2,'dir'=>'desc'),
			'columns' => array(
				'{ data: "subject", width:"200px" },',
				'{ data: "from" },',
				'{ data: "date_create", width:"250px" },',
				'{ data: "status", className:"text-center", width:"90px" },',
				'{ data: "actions", className:"text-center", width:"50px", orderable:false }'
			)
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/datatables/jquery.dataTables.min.js',
				'../assets/backend/js/plugins/datatables/datatables.bootstrap4.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',

			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/guestbooks/js/datatables', $datatables, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/guestbooks/html/datatables', $datatables);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function read(){
        $pk = (int)$this->uri->segment(4);
        
		$header = array(
			'stylesheets'	=> array(),
			'heading' 		=> array(
				'title' 		=> 'Interactions',
				'subtitle' 		=> '__Guestbooks',
				'breadcrumbs' => array(
					array('title'=>'Interactions'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'guestbooks'	    ,	'is_active'=>TRUE,	'href'=>'guestbooks'),
					array('title'=>'add'			,	'is_active'=>TRUE,	'href'=>'guestbooks/add')
				)
			)
        );
        
        $this->Guestbooks_model->update($pk);
		$form = array(
			'id'				=> 'form-guestbooks',
			'title'				=> 'Read Detail guestbooks',
			'subtitle'			=> '',
			'method'			=> 'POST',
            'action'			=> 'guestbooks/insert',
            'data'				=> $this->Guestbooks_model->single($pk),
			'check_username_url'=> 'guestbooks/check-username'
        );

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
				'../assetsatlan/js/plugin/bootstrap-notify/bootstrap-notify.min.js',

			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/guestbooks/js/form', $form, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/guestbooks/html/form', $form);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function datatables(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Guestbooks_model->datatables($this->input->post(NULL, TRUE))
				)
			);
	}
	public function delete(){
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					$this->Guestbooks_model->delete($this->input->post(NULL, TRUE))
				)
			);
	}
}