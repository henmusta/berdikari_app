<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends My_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function single($slug){

		$slug 	= $this->db->escape(slug($this->security->xss_clean($slug)));
		$query = "
		SELECT 
			p.*, 
			a.fullname AS author_fullname, 
			a.photo AS author_photo,
			e.fullname AS editor_fullname
		FROM posts p
			LEFT JOIN administrators e ON e.administrator_id=p.administrator_id
			LEFT JOIN authors a ON a.author_id=p.author_id
		WHERE p.status='publish' AND p.module='page' AND p.slug=". $slug ." LIMIT 1;
		";

		$result = $this->db->query($query)->row_array();
		if(isset($result['post_id'])){

			$result['image_large']		= $this->image_post_url($result['media_source'],'uploads/no-image/berita-large.jpg','large');
			$result['image_medium']		= $this->image_post_url($result['media_source'],'uploads/no-image/berita-medium.jpg','medium');
			$result['image_small']		= $this->image_post_url($result['media_source'],'uploads/no-image/berita-small.jpg','small');

			$result['author_photo'] 	= isset($result['author_photo']) && is_file(UPLOADS_FOLDER . 'posts' . DS . $result['author_photo']) ? 
				'uploads/posts/'. $result['author_photo'] :
				'uploads/no-image/author.png';

			$result['date_publish'] 	= $result['date_publish'];
			$result['date']				= date_indonesia($result['date_publish'],'l, d F Y');
			$result['time']				= date_indonesia($result['date_publish'],'H.i');
			$result['facebook_share']	= 'http://facebook.com/sharer.php?u='.base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
			$result['twitter_share']	= 'http://twitter.com/share?url='.base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
			$result['whatsapp_share']	= 'https://api.whatsapp.com/send?text= '.$result['title'].' - '.base_url().date_indonesia($result['date_publish'],'Y/m/d') . '/' . $result['slug'];
		}
		return $result;
	}

}