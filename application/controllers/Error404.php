<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error404 extends Frontend_Controller {
	public function index(){
		$this->load->view('backend/errors/404');
	}
}