<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_foto_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function lists($limit = 10 , $offset = 0, $except_id = 0){

		$except_id = (int)$this->security->xss_clean($except_id);
		
		$limit 		= (int)$limit;
		$offset  	= (int)$offset;

		$query = "
		SELECT 
			p.title,p.slug,p.synopsis,p.date_publish,p.media_source, p.content
		FROM posts p
		WHERE p.post_id!=". $except_id ." AND p.status='publish' AND p.module='berita-foto' AND p.date_publish <= NOW()
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
			$row['image_large']		= $this->image_post_url($row['media_source'],'uploads/no-image/berita-foto-large.jpg');
			$row['image_medium']	= $this->image_post_url($row['media_source'],'uploads/no-image/berita-foto-medium.jpg');
			$row['image_small']		= $this->image_post_url($row['media_source'],'uploads/no-image/berita-foto-small.jpg');
			$row['synopsis']		= htmlentities($row['synopsis'], ENT_QUOTES);
			$row['content']			= htmlentities($row['content'], ENT_QUOTES);
			array_push($data,$row);
		}
		return $data;
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
	public function single($slug){

		$slug 	= $this->db->escape(slug($this->security->xss_clean($slug)));
		$query = "
		SELECT 
			p.*, 
			a.fullname AS author_fullname, 
			a.photo AS author_photo,
			e.fullname AS editor_fullname,
			pc.read_count AS read_count,
			pc.share_count_facebook AS facebook_count,
			pc.share_count_twitter AS twitter_count,
			pc.share_count_whatsapp AS whatsapp_count
		FROM posts p
			LEFT JOIN administrators e ON e.administrator_id=p.administrator_id
			LEFT JOIN authors a ON a.author_id=p.author_id
			LEFT JOIN post_count pc ON pc.post_id=p.post_id
		WHERE p.status='publish' AND p.module='berita-foto' AND p.slug=". $slug ." LIMIT 1;
		";

		$result = $this->db->query($query)->row_array();
		if(isset($result['post_id'])){
			$result['image_large']		= $this->image_post_url($result['media_source'],'uploads/no-image/berita-foto-large.jpg');
			$result['image_medium']		= $this->image_post_url($result['media_source'],'uploads/no-image/berita-foto-medium.jpg');
			$result['image_small']		= $this->image_post_url($result['media_source'],'uploads/no-image/berita-foto-small.jpg');

			$result['author_photo'] 	= isset($result['author_photo']) && is_file(UPLOADS_FOLDER . 'posts' . DS . $result['author_photo']) ? 
				'uploads/posts/'. $result['author_photo'] :
				'uploads/no-image/author.png';

			$result['date_publish'] 	= $result['date_publish'];
			$result['date']				= date_indonesia($result['date_publish'],'l, d F Y');
			$result['time']				= date_indonesia($result['date_publish'],'H.i');
			$result['facebook_share']	= 'http://facebook.com/sharer.php?u='.base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
			$result['twitter_share']	= 'http://twitter.com/share?url='.base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
			$result['whatsapp_share']	= 'whatsapp://send?text= Baca berita-foto Ini : '.base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
			$result['read_count']		= $this->thousandsCurrencyFormat($result['read_count']);
			$result['facebook_count']	= $this->thousandsCurrencyFormat($result['facebook_count']);
			$result['twitter_count']	= $this->thousandsCurrencyFormat($result['twitter_count']);
			$result['whatsapp_count']	= $this->thousandsCurrencyFormat($result['whatsapp_count']);
			$result['galleries']		= $this->galleries($result['post_id']);
			$result['lainnya'] 			= $this->lists(4, 0 , $result['post_id']);
			$result['current_url']		= base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
		
			$query_category 	= "
			WITH RECURSIVE news_categories (category_id, level, title, url, slug) AS (
				SELECT 	category_id, 0, title, ARRAY[slug], slug
				FROM 	categories
				WHERE 	parent_id=0 OR parent_id is null
				UNION ALL
				SELECT 	p.category_id, t0.level + 1, p.title, ARRAY_APPEND(t0.url, p.slug), p.slug
				FROM 	categories p
					INNER JOIN news_categories t0 ON t0.category_id = p.parent_id
			) 
			SELECT title, slug , ARRAY_TO_STRING(url, '/') AS url 
			FROM news_categories nc			
				INNER JOIN post_category_relations r ON r.category_id=nc.category_id
			WHERE r.post_id=" . (int)$result['post_id'] . " ORDER BY nc.level ASC;";

			$result['categories'] 	= $this->db->query($query_category)->result_array();

			$categories_slug = array();
			foreach($result['categories'] AS $category){
				array_push($categories_slug, $category['slug']);
			}
		
		}
		return $result;
	}
	public function galleries($post_id){
		$result 	= array();
		$post_id 	= $this->db->escape_str((int)$this->security->xss_clean($post_id));
		$query 		= "SELECT source,caption FROM post_images WHERE post_id=". $post_id .";";

		$data = $this->db->query($query);
		foreach($data->result_array() AS $row){
			$row['image_large']		= $this->image_post_url($row['source'],'uploads/no-image/berita-foto-large.jpg');
			$row['image_medium']	= $this->image_post_url($row['source'],'uploads/no-image/berita-foto-medium.jpg');
			$row['image_small']		= $this->image_post_url($row['source'],'uploads/no-image/berita-foto-small.jpg');
			array_push($result,$row);
		}
		return $result;
	}
	public function get_total_berita_foto(){

		$query = "
		SELECT COUNT(p.post_id) AS total
		FROM posts p
		WHERE p.status='publish' AND p.module='berita-foto' AND p.date_publish <= NOW()
		GROUP BY p.post_id
		ORDER BY date_publish DESC
		";
		return (int)$this->db->query($query)->row()->total;
	}
	public function loadmore($page = 1){

		$row_per_page 	= 6;
		$total_data 	= $this->get_total_berita_foto();
		$total_page		= ceil((int)$total_data/$row_per_page);
		$page 			= isset($page) ? (int)$page : 1;
		$offset 		= (($page - 1) * $row_per_page);

		return $this->lists($row_per_page,$offset);
	}

}