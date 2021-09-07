<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Model extends CI_Model {

	protected $meta_header;
	public function __construct(){
		parent::__construct();
	}

	protected function image_post_url($image_url = '', $alt_image_url = '', $type = ''){

		if(filter_var($image_url, FILTER_VALIDATE_URL)){
			return $image_url;
		}
		if (isset($type) && !empty($type) && $type != 'large') {
			return is_file(UPLOADS_FOLDER . 'posts' . DS  . $image_url) ? base_url().'uploads/posts/'.$type.'/'. $image_url : base_url().$alt_image_url;	
		}
		return is_file(UPLOADS_FOLDER . 'posts' . DS  . $image_url) ? base_url().'uploads/posts/' . $image_url : base_url().$alt_image_url;

	}

}