<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends My_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function lists($tag_slug = '' , $limit = 10 , $offset = 0, $except_id = 0){

		$except_id 	= (int)$this->security->xss_clean($except_id);
		$tag_slug 	= $this->db->escape_str($this->security->xss_clean($tag_slug));
		
		$limit 		= (int)$limit;
		$offset  	= (int)$offset;

		$query = "
		SELECT 
			p.title, p.slug, p.synopsis, p.date_publish, p.media_source
		FROM posts p
		WHERE p.post_id!=". $except_id ." AND p.status='publish'  AND p.date_publish <= NOW() AND p.module IN ('berita')
			AND keywords ILIKE '%". $tag_slug ."%'
		GROUP BY p.post_id 
		ORDER BY date_publish DESC
		LIMIT ". $limit ." OFFSET ". $offset ."
		";
		$results = $this->db->query($query);

		$data = array();
		foreach( $results->result_array() AS $row ) {
			$row['date_publish'] 	= $row['date_publish'];
			$row['date']			= date_indonesia($row['date_publish'],'l, d F Y');
			$row['time']			= date_indonesia($row['date_publish'],'H.i');
			$row['url'] 			= date_indonesia($row['date_publish'],'Y/m/d') . '/' . $row['slug'];
			$row['image_large']		= $this->image_post_url($row['media_source'],'uploads/no-image/berita-large.jpg');
			$row['image_medium']	= $this->image_post_url($row['media_source'],'uploads/no-image/berita-medium.jpg');
			$row['image_small']		= $this->image_post_url($row['media_source'],'uploads/no-image/berita-small.jpg');
			$row['synopsis']		= $this->security->xss_clean($row['synopsis']);
			array_push($data,$row);
		}
		return $data;
	}
	public function get_total_berita($tag_slug){
		$tag_slug 	= $this->db->escape_str($this->security->xss_clean($tag_slug));
		$query = "
		SELECT COUNT(p.post_id) AS total
		FROM posts p
		WHERE p.status='publish' AND p.date_publish <= NOW() AND p.module IN ('berita')
			AND p.keywords ILIKE '%". $tag_slug ."%'
		GROUP BY p.post_id
		ORDER BY p.date_publish DESC
		";
		return (int)$this->db->query($query)->row()->total;
	}
	public function loadmore($tag_slug,$page){

		$row_per_page 	= 8;
		$total_data 	= $this->get_total_berita($tag_slug);
		$total_page		= ceil((int)$total_data/$row_per_page);
		$page 			= isset($page) ? (int)$page : 1;
		$offset 		= (($page - 1) * $row_per_page);

		return $this->lists($tag_slug,$row_per_page,$offset);
	}
}