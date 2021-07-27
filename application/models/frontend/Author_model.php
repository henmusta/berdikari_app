<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends My_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function lists($author_slug = '' , $limit = 10 , $offset = 0, $except_id = 0){

		$except_id = (int)$this->security->xss_clean($except_id);
		$where = '';

		if(!empty($author_slug)){
			$author_slug = $this->db->escape(slug($this->security->xss_clean($author_slug)));
			$where 	.= " AND a.slug=". $author_slug . " ";
		}
		
		$limit 		= (int)$limit;
		$offset  	= (int)$offset;

		$query = "
		SELECT 
			p.title, p.slug, p.synopsis, p.date_publish, p.media_source
		FROM posts p
			INNER JOIN authors AS a ON a.author_id=p.author_id
		WHERE p.post_id!=". $except_id ." AND p.status='publish' ". $where ." AND p.date_publish <= NOW() AND p.module IN ('berita')
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
	public function category_hierarchy_lists($parent_author_slug = '' , $limit = 10 , $offset = 0){

		$author_slug = $this->db->escape(slug($this->security->xss_clean($parent_author_slug)));
		$where 	= " AND slug=". $author_slug . " ";
		$query 	= "
		WITH RECURSIVE news_categories (category_id, level, title, path, slug) AS (
			SELECT 	category_id, 0, title, ARRAY[title], slug
			FROM 	categories
			WHERE 	category_id!=0 ". $where ."
			UNION ALL
			SELECT 	p.category_id, t0.level + 1, p.title, ARRAY_APPEND(t0.path, p.title), p.slug
			FROM 	categories p
				INNER JOIN news_categories t0 ON t0.category_id = p.parent_id
		) SELECT category_id, title, slug , ARRAY_TO_STRING(path, ' > ') AS path 
		FROM news_categories;
		";
		$categories = array();
		foreach($this->db->query($query)->result_array() AS $row){
			array_push($categories, $row['slug']);
		}
		return $this->lists($categories, $limit);
	}
	public function thousandsCurrencyFormat($num) {
	  if($num>1000) {

	        $x = round($num);
	        $x_number_format = number_format($x);
	        $x_array = explode(',', $x_number_format);
	        $x_parts = array('k', 'm', 'b', 't');
	        $x_count_parts = count($x_array) - 1;
	        $x_display = $x;
	        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
	        $x_display .= $x_parts[$x_count_parts - 1];

	        return $x_display;

	  }

	  return $num;
	}
	public function get_total_berita($author_slug){
		$author_slug = $this->db->escape(slug($this->security->xss_clean($author_slug)));
		$where 	= " AND a.slug=". $author_slug . " ";
		$query = "
		SELECT COUNT(p.post_id) AS total
		FROM posts p
			INNER JOIN authors AS a ON a.author_id=p.author_id
			LEFT JOIN post_category_relations r ON r.post_id=p.post_id
			LEFT JOIN categories c ON c.category_id=r.category_id
		WHERE p.status='publish' ". $where ." AND p.date_publish <= NOW() AND p.module IN ('berita')
		GROUP BY p.post_id
		ORDER BY date_publish DESC
		";
		return (int)$this->db->query($query)->row()->total;
	}
	public function loadmore($author_slug,$page){

		$row_per_page 	= 8;
		$total_data 	= $this->get_total_berita($author_slug);
		$total_page		= ceil((int)$total_data/$row_per_page);
		$page 			= isset($page) ? (int)$page : 1;
		$offset 		= (($page - 1) * $row_per_page);

		return $this->lists($author_slug,$row_per_page,$offset);
	}
	public function single_author($author_slug){
		$author_slug = $this->db->escape_str(slug($this->security->xss_clean($author_slug)));
		$author = $this->db->query("SELECT * FROM authors WHERE slug='". $author_slug ."' LIMIT 1;")->row_array();
		$author['photo'] 	= isset($author['photo']) && is_file(UPLOADS_FOLDER . 'authors' . DS . $author['photo']) ? 
			'uploads/authors/'. $author['photo'] :
			'uploads/no-image/author.png';
		return $author;
	}
}