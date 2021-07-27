<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Indeks_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function lists($limit = 10 , $offset = 0){

		
		$limit 		= (int)$limit;
		$offset  	= (int)$offset;

		$query = "
		SELECT 
			p.title,p.slug,p.synopsis,p.date_publish,p.media_source,p.others
		FROM posts p
			LEFT JOIN post_category_relations r ON r.post_id=p.post_id
			LEFT JOIN categories c ON c.category_id=r.category_id
		WHERE p.status='publish' AND p.date_publish <= NOW()  
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
	public function get_numrows(){
		$query = "
		SELECT 
			p.title,p.slug,p.synopsis,p.date_publish,p.media_source,p.others
		FROM posts p
			LEFT JOIN post_category_relations r ON r.post_id=p.post_id
			LEFT JOIN categories c ON c.category_id=r.category_id
		WHERE p.status='publish' AND p.date_publish <= NOW()  
		GROUP BY p.post_id
		ORDER BY date_publish DESC
		";
		
		$results = $this->db->query($query);

		return $results->num_rows();
	}
	public function get_total(){
		$query = "
		SELECT COUNT(p.post_id) AS total
		FROM posts p
		WHERE p.status='publish' AND p.date_publish <= NOW()
		GROUP BY p.post_id
		ORDER BY date_publish DESC
		";
		return (int)$this->db->query($query)->row()->total;
	}
	public function loadmore($page = 1){
		$row_per_page 	= 6;
		$total_data 	= $this->get_total() - 4;
		$total_page		= ceil((int)$total_data/$row_per_page);
		$page 			= isset($page) ? (int)$page : 1;
		$offset 		= (($page - 1) * $row_per_page);
		return $this->lists($row_per_page,$offset);
	}

}