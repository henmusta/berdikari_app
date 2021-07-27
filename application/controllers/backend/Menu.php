<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/websettings/Menu_model');
	}
	public function index(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/nestable/nestable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Menu',
				'breadcrumbs' => array(
					array('title'=>'web settings'	,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'Menu'			,	'is_active'=>TRUE,	'href'=>'Menu')
				)
			)
		);

     

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
			),
		
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/Menu/html/index', array());
		$this->load->view('backend/parts/footer', $footer);
	}
	public function menu_main(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/nestable/nestable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Menu',
				'breadcrumbs' => array(
					array('title'=>'web settings'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'Menu'					,	'is_active'=>FALSE,	'href'=>'menu'),
					array('title'=>'Menu Manager Main'		,	'is_active'=>TRUE,	'href'=>'menu/menu-main')
				)
			)
		);

        $data = array(
			'title'					=> 'menu manager',
			'title_form'			=> 'form manager',	
			'subtitle'				=> '',
			'menu_type'				=> 'top-menu',
			'form_btn'				=> '<button type="submit" class="btn btn-success btn-sm">Add <i class="fa fa-fw fa-plus"></i></button>',
            'form_title'			=> 'Menu Add',
            'change_hierarchy_url'  => 'menu/change-hierarchy',
            'nestable'              => $this->Menu_model->show_nestable_menu('top-menu',0),
		);
		
		$js = array(
			'autocomplete_url' 	    => 'menu/autocomplete',
			'action_url'		    => 'menu/add-item',
			'number_hierarchy'		=> '3',
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
                '../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
                '../assets/backend/js/plugins/nestable/nestable.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/Menu/js/menu', $js, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/Menu/html/menu', $data);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/nestable/nestable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Menu',
				'breadcrumbs' => array(
					array('title'=>'web settings'		,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'Menu'				,	'is_active'=>FALSE,	'href'=>'menu'),
					array('title'=>'Menu Manager Main'	,	'is_active'=>FALSE,	'href'=>'menu/menu-main'),
					array('title'=>'edit'				,	'is_active'=>TRUE,	'href'=>'')
				)
			)
		);

        $data = array(
			'title'					=> 'menu manager',
			'title_form'			=> 'form manager',			
			'subtitle'				=> '',
			'menu_type'				=> 'top-menu',
			'form_btn'				=> '
										<a href="javascript:history.back()" class="btn btn-sm btn-info text-white"><i class="fa fa-fw fa-reply"></i> Back</a>
										<button type="submit" class="btn btn-sm btn-success text-white">Edit <i class="fa fa-fw fa-save"></i></button>
										',
            'form_title'			=> 'Menu Add',
			'change_hierarchy_url'  => 'menu/change-hierarchy',
			'edited' 				=> $this->Menu_model->single($pk),
            'nestable'              => $this->Menu_model->show_nestable_menu('top-menu',0),
		);

		$js =  array(
			'autocomplete_url' 	    => 'menu/autocomplete',
			'action_url'		    => 'menu/edit-item/' . $pk,
			'number_hierarchy'		=> '3',

		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
                '../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
                '../assets/backend/js/plugins/nestable/nestable.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/Menu/js/menu', $js, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/Menu/html/menu', $data);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function autocomplete(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Menu_model->autocomplete($this->input->post(NULL, TRUE))
			)
		);
	}
	public function add_item(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Menu_model->add_item($this->input->post(NULL, TRUE))
			)
		);
	}
	public function edit_item(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Menu_model->edit_item($this->input->post(NULL, TRUE))
			)
		);
	}
	public function delete_item(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Menu_model->delete_item($this->input->post(NULL, TRUE))
			)
		);
	}
	public function change_hierarchy(){
		$this->output
		->set_content_type('application/json')
		->set_output(
			json_encode(
				$this->Menu_model->change_hierarchy($this->input->post(NULL, TRUE))
			)
		);
	}
	public function menu_footer(){
		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/nestable/nestable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Menu',
				'breadcrumbs' => array(
					array('title'=>'web settings'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'Menu'					,	'is_active'=>FALSE,	'href'=>'menu'),
					array('title'=>'Menu Manager Footer'	,	'is_active'=>TRUE,	'href'=>'menu/menu-footer')
				)
			)
		);

        $data = array(
			'title'					=> 'menu manager',
			'title_form'			=> 'form manager',	
			'subtitle'				=> '',
			'menu_type'				=> 'bottom-menu',
			'form_btn'				=> '<button type="submit" class="btn btn-success btn-sm">Add <i class="fa fa-fw fa-plus"></i></button>',
            'form_title'			=> 'Menu Add',
            'change_hierarchy_url'  => 'menu/change-hierarchy',
            'nestable'              => $this->Menu_model->show_nestable_menu('bottom-menu',0),
		);
		
		$js = array(
			'autocomplete_url' 	    => 'menu/autocomplete',
			'action_url'		    => 'menu/add-item',
			'number_hierarchy'		=> '1',
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
                '../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
                '../assets/backend/js/plugins/nestable/nestable.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/Menu/js/menu', $js, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/Menu/html/menu', $data);
		$this->load->view('backend/parts/footer', $footer);
	}
	public function edit_footer(){
		$pk = (int)$this->uri->segment(4);

		$header = array(
			'stylesheets'	=> array(
				'../assets/backend/js/plugins/datatables/dataTables.bootstrap4.css',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.css',
				'../assets/backend/js/plugins/nestable/nestable.css'
			),
			'heading' 		=> array(
				'title' 		=> 'Web settings',
				'subtitle' 		=> '__Menu',
				'breadcrumbs' => array(
					array('title'=>'web settings'			,	'is_active'=>TRUE,	'href'=>''),
					array('title'=>'Menu'					,	'is_active'=>FALSE,	'href'=>'menu'),
					array('title'=>'Menu Manager Footer'	,	'is_active'=>FALSE,	'href'=>'menu/menu-footer'),
					array('title'=>'edit'					,	'is_active'=>TRUE,	'href'=>'')
				)
			)
		);

        $data = array(
			'title'					=> 'menu manager',
			'title_form'			=> 'form manager',			
			'subtitle'				=> '',
			'menu_type'				=> 'bottom-menu',
			'form_btn'				=> '
										<a href="javascript:history.back()" class="btn btn-sm btn-info text-white"><i class="fa fa-fw fa-reply"></i> Back</a>
										<button type="submit" class="btn btn-sm btn-success text-white">Edit <i class="fa fa-fw fa-save"></i></button>
										',
            'form_title'			=> 'Menu Add',
			'change_hierarchy_url'  => 'menu/change-hierarchy',
			'edited' 				=> $this->Menu_model->single($pk),
            'nestable'              => $this->Menu_model->show_nestable_menu('bottom-menu',0),
		);

		$js =  array(
			'autocomplete_url' 	    => 'menu/autocomplete',
			'action_url'		    => 'menu/edit-item/' . $pk,
			'number_hierarchy'		=> '1',
		);

		$footer = array(
			'javascripts' => array(
				'../assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
				'../assets/backend/js/plugins/es6-promise/es6-promise.auto.min.js',
				'../assets/backend/js/plugins/sweetalert2/sweetalert2.min.js',
                '../assets/backend/js/plugins/jquery-validation/jquery.validate.min.js',
                '../assets/backend/js/plugins/nestable/nestable.js',
			),
			'scripts'	=> array(
				$this->load->view('backend/websettings/Menu/js/menu', $js, TRUE)
			)
		);

		$this->load->view('backend/parts/header', $header);
		$this->load->view('backend/websettings/Menu/html/menu', $data);
		$this->load->view('backend/parts/footer', $footer);
	}
}