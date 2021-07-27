<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_count extends Frontend_Controller {
	public function __construct(){
	    @ob_end_flush();
		parent::__construct();
		$this->load->model('frontend/Post_count_model');
	}
    public function index(){
        $code = 400;
        $messages = ['message'=>''];
        if ($this->input->is_ajax_request()) { 
            if($this->Post_count_model->insert($this->input->post(NULL,TRUE))){
                $code = 200;
                $messages = ['message'=>'OK'];
            }
        }
        
        $this->output
            ->set_status_header($code)
            ->set_output(json_encode($messages))
            ->set_content_type('application/json');
    }

}