<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
		$this->load->model('frontend/Berita_model');
		$this->load->model('frontend/Berita_foto_model');
		$this->load->model('frontend/Infografis_model');
		$this->load->model('frontend/Kupas_tv_model');
		$this->load->model('frontend/E_paper_model');
		$this->load->model('frontend/Page_model');
	}
	public function data($slug = '', $page = 1){
		$model = $this->get_model_by_slug($slug);
		if(!empty($model)){
			$data = $this->{$model}->single($slug);
			$content = explode('<hr class="KT_PAGE_BREAK">', $data['content']);
			$data['total_page'] = count($content);
			$page = empty($page) ? 1 : $page;
			if($page != 'all'){
				$page = (int)$page - 1;
				$data['content'] = isset($content[$page]) ? $content[$page] : implode('',$content);
			} else {
				$data['content'] = implode('',$content);
			}
			if ($this->security->xss_clean($this->uri->segment(5)) == '') {
				$data['current_page'] = 1;
			}else{
				$data['current_page'] = $this->security->xss_clean($this->uri->segment(5));
			}
			return $data;
		}
		return array();
	}
	public function get_model_by_slug($slug = ''){
		$slug 	= $this->db->escape_str(slug($this->security->xss_clean($slug)));
		$this->db->select('module');
		$result = $this->db->get_where('posts', array('slug' => $slug), 1, 0)->row_array();
		if(isset($result['module'])){
			return ucfirst(trim(str_replace('-','_',$result['module']))) . '_model';
		}
		return NULL;
	}

}