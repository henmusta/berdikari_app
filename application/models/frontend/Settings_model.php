<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function main_menu($parent_id = 0){
		$html 	= '';
		$parent_id = (int)$parent_id;
		$query 	= $this->db->query("SELECT menu_id,title,url,target FROM menu WHERE menu_type='top-menu' AND parent_id=". $parent_id ." ORDER BY sort ASC;");
		$data 	= $query->result_array();
		if (count($data) > 0) {
			foreach($data AS $row){
				$html .= '<a id="nav-link" class="nav-link my-1 active ' . '" href="' . $row['url'] . '" target="' . $row['target'] . '">' . $row['title'] . '</a>';
				$html .= $this->main_menu($row['menu_id']);
			}
		}
		$query->free_result();
		return $html;
	}

	public function footer_menu(){
		$html 	= '';
		$query 	= $this->db->query("SELECT menu_id,title,url,target FROM menu WHERE menu_type='bottom-menu' ORDER BY sort ASC;");
		$data 	= $query->result_array();
		if(count($data) > 0){
			$html .= '<ul>';
			foreach($data AS $row){
				$html .= '<li><a href="'. $row['url'] .'" target="'. $row['target'] .'">'. $row['title'] .'</a></li>';
			}
			$html .= '</ul>';
		}
		$query->free_result();
		return $html;
	}

	public function ads(){

		$data = $this->db->get('ads')->result_array();
		$result = array();
		foreach($data AS $row){
			$position = trim($row['position']);
			$no_image = in_array($position,array('header','home_content','detail_content')) ? 'landsape' : 'portrait';

			$image_url = isset($row['value']) && is_file(UPLOADS_FOLDER . 'banner' . DS . $row['value']) ? 
				'uploads/banner/'. $row['value'] :
				'uploads/no-image/banner-'. $no_image .'.jpg';

			$html = ($row['type'] == 'image') 
				? '<a href="'.$row['permalink'].'" target="'. $row['target'] .'"><img src="'. $image_url .'" class="img-fluid"></a>'
				: $row['value'];
			$result[$position] = $html;
		}
		return $result;
	}

	public function single_category($category_slug){
		$category_slug = $this->security->xss_clean($category_slug);
		return $this->db->get_where('categories',array('slug'=>$category_slug))->row_array();
	}
}