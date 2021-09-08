<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('assets/plugins/TwitterAPIExchange.php');
class berita_foto_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){

		$columns 			= array("p.title","a.fullname","p.status","p.date_publish","p.post_id");
		$sql_total_data 	= "SELECT COUNT(post_id) AS total FROM posts WHERE module='berita-foto';";
		$select 			= "
		SELECT 
			p.post_id AS post_id,
			p.slug AS slug,
			p.title AS title,
			p.status AS status,
			p.date_publish AS date_publish,
			a.fullname AS author 
		";
		$from 				= "
		FROM posts p
			LEFT JOIN authors a ON a.author_id=p.author_id
		";
		$where 				= "WHERE p.module='berita-foto' ";
		$group_by 			= "GROUP BY p.post_id,a.fullname ";
		$having 			= "";
		$order_by 			= "";
		$limit 				= "";

		if( isset($request["search"]["value"]) && !empty($request["search"]["value"]) ) {
			$q	= $this->db->escape_str(strip_tags($request["search"]["value"]));
			$fields = array();
			foreach( $columns AS $col ){
				array_push($fields,"(CAST(".$col." AS TEXT) ILIKE '%".$q."%')");
			}
			$where .= "AND (" . implode(" OR ",$fields) . ") ";
			unset($fields,$col,$q);
		}
		if( isset($request['order'][0]['column']) ){
			$field 	= $columns[$request["order"][0]["column"]];
			$dir 	= strtoupper($this->db->escape_str($request["order"][0]["dir"]));
			$order_by = "ORDER BY " . $field . " " . $dir . " "; 
			unset($field,$dir);
		}
		if ( isset( $request["start"] ) && $request["length"] != '-1' ) {
			$limit = "LIMIT " . (int)$request["length"] . " OFFSET " . (int)$request["start"];
		}

		$sql_total_filtered = "SELECT COUNT(DISTINCT p.post_id) AS total " . $from . $where . $group_by . $having . ";";
		$sql_data 			= $select . $from . $where . $group_by . $having . $order_by . $limit . ";";

		$totalData 		= $this->db->query($sql_total_data);
		$totalFiltered 	= $this->db->query($sql_total_filtered);
		$results 		= $this->db->query($sql_data);

		$data = array();

		foreach($results->result_array() AS $row){
			$row['url']				= base_url(date_indonesia($row['date_publish'],'Y/m/d') . '/' . $row['slug']);
			$row['date_publish'] 	= date_indonesia($row['date_publish'],'d F Y H:i');
			$row['status'] 			= trim(ucfirst($row['status']));
			$row['actions'] 		= trim('
				<div class="btn-group">
					<a href="berita-foto/gallery/'. $row['post_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-images"></i>
					</a>
					<a href="berita-foto/edit/'. $row['post_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" data-pk="'. $row['post_id'] .'">
					<i class="fas fa-fw fa-trash"></i>
					</button>
					<button type="button" class="btn-copy-url btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Copy Url" data-url="'. $row['url'] .'">
					<i class="fas fa-fw fa-copy"></i>
					</button>
				</div>
			');
			
			array_push($data,$row);
		}

		return array(
			"draw" 				=> intval( isset($request['draw']) ? $request['draw'] : 1 ),
			"recordsTotal" 		=> intval( isset($totalData->row()->total) ? $totalData->row()->total : 0 ),
			"recordsFiltered" 	=> intval( isset($totalFiltered->row()->total) ? $totalFiltered->row()->total : 0 ),
			"data"				=> $data
		);
	}
	public function datatables_gallery($request){

		$post_id = isset($request['post_id']) ? (int)$request['post_id'] : 0;

		$columns 			= array("source","caption","post_image_id");
		$sql_total_data 	= "SELECT COUNT(post_image_id) AS total FROM post_images ";
		$select 			= "SELECT * ";
		$from 				= "FROM post_images ";
		$where 				= "WHERE  post_id=" . $post_id . " ";
		$group_by 			= "";
		$having 			= "";
		$order_by 			= "";
		$limit 				= "";

		if( isset($request["search"]["value"]) && !empty($request["search"]["value"]) ) {
			$q	= $this->db->escape_str(strip_tags($request["search"]["value"]));
			$fields = array();
			foreach( $columns AS $col ){
				array_push($fields,"(CAST(".$col." AS TEXT) ILIKE '%".$q."%')");
			}
			$where .= "AND (" . implode(" OR ",$fields) . ") ";
			unset($fields,$col,$q);
		}
		if( isset($request['order'][0]['column']) ){
			$field 	= $columns[$request["order"][0]["column"]];
			$dir 	= strtoupper($this->db->escape_str($request["order"][0]["dir"]));
			$order_by = "ORDER BY " . $field . " " . $dir . " "; 
			unset($field,$dir);
		}
		if ( isset( $request["start"] ) && $request["length"] != '-1' ) {
			$limit = "LIMIT " . (int)$request["length"] . " OFFSET " . (int)$request["start"];
		}

		$sql_total_filtered = "SELECT COUNT(DISTINCT post_image_id) AS total " . $from . $where . $group_by . $having . ";";
		$sql_data 			= $select . $from . $where . $group_by . $having . $order_by . $limit . ";";

		$totalData 		= $this->db->query($sql_total_data . $where . ";");
		$totalFiltered 	= $this->db->query($sql_total_filtered);
		$results 		= $this->db->query($sql_data);

		$data = array();

		foreach($results->result_array() AS $row){
            $photo = isset($row['source']) && is_file(UPLOADS_FOLDER . 'posts/small/' . DS . $row['source']) ? 
            '../uploads/posts/small/'. $row['source'] :
            '../assets/backend/media/posts/berita.jpg';
            $row['source']			= $photo;
			$row['actions'] 		= trim('
				<div class="btn-group">
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" data-pk="'. $row['post_image_id'] .'">
					<i class="fas fa-fw fa-trash"></i>
					</button>
				</div>
			');
			array_push($data,$row);
		}

		return array(
			"draw" 				=> intval( isset($request['draw']) ? $request['draw'] : 1 ),
			"recordsTotal" 		=> intval( isset($totalData->row()->total) ? $totalData->row()->total : 0 ),
			"recordsFiltered" 	=> intval( isset($totalFiltered->row()->total) ? $totalFiltered->row()->total : 0 ),
			"data"				=> $data
		);
	}
	public function single($id){
		$id = (int)$id;
		$sql = "
		SELECT 
			p.*, a.fullname AS author_fullname
		FROM posts p
			LEFT JOIN authors a ON a.author_id=p.author_id
		WHERE p.post_id=". $id ."
		";
		$result = $this->db->query($sql)->row_array();
		$sql_categories = "
		SELECT 
			c.category_id , ARRAY_TO_STRING(c.path, ' > ') AS path
		FROM post_category_relations r 
		WHERE r.post_id=". $id ."
		ORDER BY c.path ASC;
		";
		return $result;
	}
	public function insert($post){

		$result = array(
			'status'			=> 'error',
			'message'			=> 'Please complete the form field requirements.',
			'upload_messages'	=> NULL,
			'redirect'			=> NULL
		);

		if(isset($post['data']) && count($post['data']) > 0){
			$result['message'] 	= "Data failed to save.";

			$post['data']['administrator_id'] 	= $this->session->user->administrator_id;
			$post['data']['module']				= 'berita-foto';
			$post['data']['media_type']			= 'image';
			$post['data']['slug']				= trim(slug($post['data']['title']));
			$post['data']['date_create']		= date('Y-m-d H:i');
			$post['data']['date_modified']		= date('Y-m-d H:i');
			$post['data']['synopsis']			= empty($post['data']['synopsis']) ? trim(kt_synopsis($post['data']['content'])) : $post['data']['synopsis'];
			if(	isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name']) ){

				$folder 	= UPLOADS_FOLDER . 'posts' . DS;
				$rename_to 	= strtolower(
					substr(
						preg_replace('!\s+!',' ', $post['data']['slug'])
					, 0, 50) 
					. '_' 
					. date('YmdHis') 
					. '.' 
					. pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION)
				);

				$this->load->library('upload', 
					array(
						'upload_path' 	=> $folder,
						'file_name'		=> $rename_to,
						'allowed_types' => 'jpg|png',
						'max_size'		=> 2000,
						'max_width'		=> 1920, 
						'max_height'	=> 1920
					)
				);

				if ($this->upload->do_upload('photo')){
					$image = $this->upload->data();
					$reimage = $this->create_image(	
						$image['full_path'], 
						$image['full_path'],
						840,484
					);
					if($reimage === TRUE){
						$reimage = $this->create_image(	
							$image['full_path'], 
							$image['file_path'] . 'medium/' . $image['file_name'],
							450,304
						);
						if($reimage === TRUE){
							$reimage = $this->create_image(	
								$image['full_path'], 
								$image['file_path'] . 'small/' . $image['file_name'],
								300,173
							);
						}
					}
					$result['upload_messages'] = ($reimage !== TRUE) ? $reimage : '';

					$post['data']['media_source'] = $image['file_name'];
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}

			}

			if( $this->db->insert('posts', $post['data']) ){
			    $post_id = $this->db->insert_id();
			    if($post['data']['status'] == 'publish'){
				    $str = explode(',', $post['data']['keywords']);
                    $hashtag = '';
                    for ($i=0; $i < count($str); $i++) { 
                        $hashtag .= '#'.str_replace(' ', '', $str[$i]).' ';
                    }
                    $hashtag = substr($hashtag,0,55);

				    $settingsTwitter = array(
                        'oauth_access_token' => "849799685258657792-5fEY69Kq0AtRea3EVJGfppDU1YLw6wu",
                        'oauth_access_token_secret' => "CEPe7ENk5JFwP5372kSwT73CEiC4r7TUekYMxerl5LD8c",
                        'consumer_key' => "fZG7s1AEcDo9RcoZLGAbAgKrh",
                        'consumer_secret' => "p0JNwra6SKXo89uTXivCocozTAKv3KrJ1FOOJtpMFMCJyu3Y3p"
                    );
                    $urlTwitter = "https://api.twitter.com/1.1/statuses/update.json";
                    $requestMethodTwitter = 'POST';
				    $url_socmed = base_url(date_indonesia($post['data']['date_publish'],'Y/m/d') . '/' . $post['data']['slug']);
    				$descriptionTwitter = $post['data']['synopsis'];
    	            $descriptionTwitter = substr($descriptionTwitter, 0, 100).'...';
    	            $postfieldsTwitter = array('status' => $descriptionTwitter.'  '.$hashtag.'  '.$url_socmed);
    	            $twitter = new TwitterAPIExchange($settingsTwitter);
                    $twitter->buildOauth($urlTwitter, $requestMethodTwitter)->setPostfields($postfieldsTwitter)->performRequest();
                    
                    $page_access_token = 'EAAHT5NeVAhMBAN6RCACY3ji8uOu1VHHfs4eozNG2199ZC240Aiszd8Y9k0IHYo7RKp4WSgKzDT90nIw6VTdDscXpaJy1uqZCQsUo1QSxzz9Esq5HhfSmgePYKTdENNOfh6wHX88EUUIkROxSKDMCmf4FhCnNxFltivjDAyHNZBKOIvl508JZC6akqP5wy34ZD';
	                $page_id = '420018014806199';
	                $dataFB['message'] = $post['data']['synopsis'].'  '.$hashtag;
                	$dataFB['link'] = $url_socmed;
                	$dataFB['access_token'] = $page_access_token;
                	$post_urlFB = 'https://graph.facebook.com/'.$page_id.'/feed';
                	static $ch_called = false;
                	if (!$ch_called) {
                		$ch_called = true;
                		static $ch_exec_called = false;
                		$ch = curl_init();
                		curl_setopt($ch, CURLOPT_URL, $post_urlFB);
                		curl_setopt($ch, CURLOPT_POST, 1);
                		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataFB);
                		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                		if (!$ch_exec_called) {
                			$ch_exec_called = true;
                			curl_exec($ch);
                		}
                		curl_close($ch);
                	}
                	$update_publish_socmed = array(
					    'publish_socmed' => '1'
					);
        			$this->db->where('post_id', (int)$post_id);
        			$this->db->update('posts', $update_publish_socmed);
				}
				$redirect = 'berita-foto/gallery/' . $this->db->insert_id();
				$result = array(
					'status'			=> 'success',
					'message'			=> 'Data has been save.',
					'upload_messages'	=> $result['upload_messages'],
					'redirect'			=> isset($post['redirect']) ? $post['redirect'] : $redirect
				);
			}
			unset($data);

		}
		return $result;
		unset($result);
	}
	public function update($post){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);

		if(
			(isset($post['data']) && count($post['data']) > 0) 
			&& (isset($post['pk']) && !empty($post['pk']))

		){
			$result['message'] 	= "Data failed to save.";

			$post['data']['administrator_id'] 	= $this->session->user->administrator_id;
			$post['data']['slug']				= trim(slug($post['data']['title']));
			$post['data']['date_modified']		= date('Y-m-d H:i');
			$post['data']['synopsis']			= empty($post['data']['synopsis']) ? trim(kt_synopsis($post['data']['content'])) : $post['data']['synopsis'];

			if(	isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name']) ){

				$folder 	= UPLOADS_FOLDER . 'posts' . DS;
				$rename_to 	= strtolower(
					substr(
						preg_replace('!\s+!',' ', $post['data']['slug'])
					, 0, 50) 
					. '_' 
					. date('YmdHis') 
					. '.' 
					. pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION)
				);

				$this->load->library('upload', 
					array(
						'upload_path' 	=> $folder,
						'file_name'		=> $rename_to,
						'allowed_types' => 'jpg|png',
						'max_size'		=> 2000,
						'max_width'		=> 1920, 
						'max_height'	=> 1920
					)
				);

				if ($this->upload->do_upload('photo')){

					$old_data = $this->single((int)$post['pk']);
					$old_photo = UPLOADS_FOLDER . 'posts' . DS . $old_data['media_source'];
					$old_photo_m = UPLOADS_FOLDER . 'posts' . DS . 'medium' . DS . $old_data['media_source'];
					$old_photo_s = UPLOADS_FOLDER . 'posts' . DS . 'small' . DS . $old_data['media_source'];
					if( is_file($old_photo) ){
						unlink($old_photo);
					}
					if( is_file($old_photo_m) ){
						unlink($old_photo_m);
					}
					if( is_file($old_photo_s) ){
						unlink($old_photo_s);
					}

					$image = $this->upload->data();
					$reimage = $this->create_image(	
						$image['full_path'], 
						$image['full_path'],
						840,484
					);
					if($reimage === TRUE){
						$reimage = $this->create_image(	
							$image['full_path'], 
							$image['file_path'] . 'medium/' . $image['file_name'],
							450,304
						);
						if($reimage === TRUE){
							$reimage = $this->create_image(	
								$image['full_path'], 
								$image['file_path'] . 'small/' . $image['file_name'],
								300,173
							);
						}
					}
					$result['upload_messages'] = ($reimage !== TRUE) ? $reimage : '';
					$post['data']['media_source'] = $image['file_name'];
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}
			}
			$this->db->where('post_id', (int)$post['pk']);
			if( $this->db->update('posts', $post['data']) ){
				$this->db->where('post_id', (int)$post['pk']);
				$this->db->delete('post_category_relations');
				if(isset($post['categories']) && is_array($post['categories']) && count($post['categories']) > 0){
					$post_id = (int)$post['pk'];
					$categories_data = array(); 
					foreach($post['categories'] AS $category_id){
						array_push(
							$categories_data,
							array(
								'post_id' 		=> (int)$post_id,
								'category_id' 	=> (int)$category_id
							)
						);
					}
					$this->db->insert_batch('post_category_relations', $categories_data);
				}
				$ps = $this->db->query("SELECT publish_socmed FROM posts WHERE post_id='".(int)$post['pk']."';")->row()->publish_socmed;
				if($post['data']['status'] == 'publish' && $ps != '1'){
				    $str = explode(',', $post['data']['keywords']);
                    $hashtag = '';
                    for ($i=0; $i < count($str); $i++) { 
                        $hashtag .= '#'.str_replace(' ', '', $str[$i]).' ';
                    }
                    $hashtag = substr($hashtag,0,55);

				    $settingsTwitter = array(
                        'oauth_access_token' => "849799685258657792-5fEY69Kq0AtRea3EVJGfppDU1YLw6wu",
                        'oauth_access_token_secret' => "CEPe7ENk5JFwP5372kSwT73CEiC4r7TUekYMxerl5LD8c",
                        'consumer_key' => "fZG7s1AEcDo9RcoZLGAbAgKrh",
                        'consumer_secret' => "p0JNwra6SKXo89uTXivCocozTAKv3KrJ1FOOJtpMFMCJyu3Y3p"
                    );
                    $urlTwitter = "https://api.twitter.com/1.1/statuses/update.json";
                    $requestMethodTwitter = 'POST';
				    $url_socmed = base_url(date_indonesia($post['data']['date_publish'],'Y/m/d') . '/' . $post['data']['slug']);
    				$descriptionTwitter = $post['data']['synopsis'];
    	            $descriptionTwitter = substr($descriptionTwitter, 0, 100).'...';
    	            $postfieldsTwitter = array('status' => $descriptionTwitter.'  '.$hashtag.'  '.$url_socmed);
    	            $twitter = new TwitterAPIExchange($settingsTwitter);
                    $twitter->buildOauth($urlTwitter, $requestMethodTwitter)->setPostfields($postfieldsTwitter)->performRequest();
                    
                    $page_access_token = 'EAAHT5NeVAhMBAN6RCACY3ji8uOu1VHHfs4eozNG2199ZC240Aiszd8Y9k0IHYo7RKp4WSgKzDT90nIw6VTdDscXpaJy1uqZCQsUo1QSxzz9Esq5HhfSmgePYKTdENNOfh6wHX88EUUIkROxSKDMCmf4FhCnNxFltivjDAyHNZBKOIvl508JZC6akqP5wy34ZD';
	                $page_id = '420018014806199';
	                $dataFB['message'] = $post['data']['synopsis'].'  '.$hashtag;
                	$dataFB['link'] = $url_socmed;
                	$dataFB['access_token'] = $page_access_token;
                	$post_urlFB = 'https://graph.facebook.com/'.$page_id.'/feed';
                	static $ch_called = false;
                	if (!$ch_called) {
                		$ch_called = true;
                		static $ch_exec_called = false;
                		$ch = curl_init();
                		curl_setopt($ch, CURLOPT_URL, $post_urlFB);
                		curl_setopt($ch, CURLOPT_POST, 1);
                		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataFB);
                		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                		if (!$ch_exec_called) {
                			$ch_exec_called = true;
                			curl_exec($ch);
                		}
                		curl_close($ch);
                	}
                	$update_publish_socmed = array(
					    'publish_socmed' => '1'
					);
        			$this->db->where('post_id', (int)$post['pk']);
        			$this->db->update('posts', $update_publish_socmed);
				}
				$redirect = 'berita-foto/gallery/' . (int)$post['pk'];
				$result = array(
					'status'			=> 'success',
					'message'			=> 'Data has been save.',
					'upload_messages'	=> $result['upload_messages'],
					'redirect'			=> isset($post['redirect']) ? $post['redirect'] : $redirect
				);
			}
			unset($data);
			
		}
		return $result;
		unset($result);
	}
	public function delete($post){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'redirect'	=> NULL
		);

		if(isset($post['pk'])){
			$result['message'] 	= "Data failed to save.";
			$old_data 	= $this->single((int)$post['pk']);
			$images 	= $this->db->get_where('post_images', array('post_id' => (int)$post['pk']))->result_array();
			$this->db->where('post_id', (int)$post['pk']);
			if( $this->db->delete('posts') ){
				$old_photo = UPLOADS_FOLDER . 'posts' . DS . $old_data['media_source'];
				$old_photo_m = UPLOADS_FOLDER . 'posts' . DS . 'medium' . DS . $old_data['media_source'];
				$old_photo_s = UPLOADS_FOLDER . 'posts' . DS . 'small' . DS . $old_data['media_source'];
				if( is_file($old_photo) ){
					unlink($old_photo);
				}
				if( is_file($old_photo_m) ){
					unlink($old_photo_m);
				}
				if( is_file($old_photo_s) ){
					unlink($old_photo_s);
				}
				if(count($images) > 0){
					foreach($images AS $image ){
						$old_photo = UPLOADS_FOLDER . 'posts' . DS . $image['source'];
						$old_photo_m = UPLOADS_FOLDER . 'posts' . DS . 'medium' . DS . $image['source'];
						$old_photo_s = UPLOADS_FOLDER . 'posts' . DS . 'small' . DS . $image['source'];
						if( is_file($old_photo) ){
							unlink($old_photo);
						}
						if( is_file($old_photo_m) ){
							unlink($old_photo_m);
						}
						if( is_file($old_photo_s) ){
							unlink($old_photo_s);
						}
					}

				}

				/* Mencatat Log delete */
				$log_text = isset($_SESSION['user']->fullname) ? $_SESSION['user']->fullname : "Tidak dikenal ";
				$log_text .= "mengapus berita : " . $old_data['title'];
                $file = FCPATH . 'log_delete.txt';
                $fp = fopen($file, 'a');
                fwrite($fp, $log_text . "\n");
                fclose($fp);

				$result = array(
					'status'	=> 'success',
					'message'	=> 'Data has been deleted.',
					'redirect'	=> isset($post['redirect']) ? $post['redirect'] : ''
				);
			}
			unset($data);
			
		}
		return $result;
		unset($result);
	}
	public function select2_authors($filter){
		$row_per_page 	= 10;
		$select_total 	= "SELECT COUNT(author_id) AS total ";
		$select_data	= "SELECT author_id AS id, fullname AS text ";
		$from 			= "FROM authors ";
		$where 			= NULL;
		if(isset($filter['q']) && !empty($filter['q'])){
			$q = $this->db->escape_str($filter['q']);
			$where = "WHERE fullname ILIKE '%". $filter['q'] ."%' ";
		}
		$order_by		= "ORDER BY fullname ASC";

		$result_total	= $this->db->query($select_total . $from . $where . ";");
		$total_data 	= $result_total->row()->total;
		$total_page		= ceil((int)$total_data/$row_per_page);
		$page 			= isset($filter['page']) ? (int)$filter['page'] : 1;
		$offset 		= (($page - 1) * $row_per_page);

		$result_total->free_result();

		$data = $this->db->query($select_data . $from . $where . $order_by. " LIMIT ". $row_per_page ." OFFSET ". $offset .";");
		return array( 
			'results' 		=> $data->result_array(),
			'pagination' 	=> array('more' => ($page < $total_page)) 
		);
		$data->free_result();
	}
	public function check_title($title, $pk_except = 0){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'User not found',
			'redirect'	=> ''
		);

		if(!empty($title)){
			$pk_except 	= $this->db->escape_str($this->security->xss_clean((int)$pk_except));
			$slug 		= $this->db->escape_str($this->security->xss_clean(slug(trim($title))));
			$sql 		= "SELECT post_id FROM posts WHERE slug = ? AND post_id!=?;";
			$query 		= $this->db->query($sql, array($slug,$pk_except));
			$result['message']	= 'User doesn\'t exist';
			if($query->num_rows() < 1){
				$query->free_result();
				$result = array(
					'status'	=> 'success',
					'message'	=> '',
					'redirect'	=> ''
				);
			}
		}
		return $result;
		unset($title,$slug,$sql,$query,$result);
	}
	public function create_image($source, $destination, $width = 300, $height = 173){
		$this->load->library('image_lib');
		$init = array(
			'image_library' 	=> 'gd2',
			'source_image' 		=> $source,
			'new_image' 		=> $destination,
			'maintain_ratio'	=> FALSE,
			'width' 			=> $width,
			'height' 			=> $height
		);
		$this->image_lib->clear();
		$this->image_lib->initialize($init);
		if(!$this->image_lib->resize()){
			return $this->image_lib->display_errors();
		}
		return TRUE;
	}
	public function upload($post){

		$result = array(
			'status'			=> 'error',
			'message'			=> 'Please complete the form field requirements.'
		);

		if(isset($post['post_id']) && !empty($post['post_id'])){
			$result['message'] 	= "Data failed to save.";

			if(	isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']) ){

				$data['post_id'] 		= (int)$post['post_id'];				
				$data['sort_order']		= 1; 
				$data['date_upload']	= date('Y-m-d H:i:s');
				$data['source']			= '';

				$folder 	= UPLOADS_FOLDER . 'posts' . DS;
				$rename_to 	= strtolower(
					substr(
						preg_replace('!\s+!',' ', $_FILES['file']['name'])
					, 0, 50) 
					. '_' 
					. date('YmdHis') 
					. '.' 
					. pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION)
				);

				$this->load->library('upload', 
					array(
						'upload_path' 	=> $folder,
						'file_name'		=> $rename_to,
						'allowed_types' => 'jpg|png',
						'max_size'		=> 2000,
						'max_width'		=> 1920, 
						'max_height'	=> 1920
					)
				);

				if ($this->upload->do_upload('file')){
					$image = $this->upload->data();
					$reimage = $this->create_image(	
						$image['full_path'], 
						$image['full_path'],
						840,484
					);
					if($reimage === TRUE){
						$reimage = $this->create_image(	
							$image['full_path'], 
							$image['file_path'] . 'medium/' . $image['file_name'],
							450,304
						);
						if($reimage === TRUE){
							$reimage = $this->create_image(	
								$image['full_path'], 
								$image['file_path'] . 'small/' . $image['file_name'],
								300,173
							);
						}
					}
					$result['message'] = ($reimage !== TRUE) ? $reimage : '';
					$data['source'] = $image['file_name'];
					if( $this->db->insert('post_images', $data) ){
						$result = array(
							'status'	=> 'success',
							'message'	=> 'Data has been save.'
						);
					}
				} else {
					$result['message'] = $this->upload->display_errors();
				}

			}
			unset($data);
		}
		return $result;
		unset($result);
	}
	public function delete_image($post){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'redirect'	=> NULL
		);

		if(isset($post['pk'])){
			$result['message'] 	= "Data failed to save.";
			$this->db->where('post_image_id', (int)$post['pk']);

			$old_data = $this->db->get('post_images')->row_array();
			$this->db->where('post_image_id', (int)$post['pk']);
			if( $this->db->delete('post_images') ){
				$old_photo = UPLOADS_FOLDER . 'posts' . DS . $old_data['source'];
				$old_photo_m = UPLOADS_FOLDER . 'posts' . DS . 'medium' . DS . $old_data['source'];
				$old_photo_s = UPLOADS_FOLDER . 'posts' . DS . 'small' . DS . $old_data['source'];
				if( is_file($old_photo) ){
					unlink($old_photo);
				}
				if( is_file($old_photo) ){
					unlink($old_photo);
				}
				if( is_file($old_photo) ){
					unlink($old_photo);
				}
				$result = array(
					'status'	=> 'success',
					'message'	=> 'Data has been deleted.',
					'redirect'	=> isset($post['redirect']) ? $post['redirect'] : ''
				);
			}
			unset($data);
			
		}
		return $result;
		unset($result);
	}
	public function update_field($post){
		$field_available = array('caption');
		$pk 			= $this->db->escape_str((int)trim(strip_tags($post['pk'])));
		$fieldname 		= $this->db->escape_str((string)trim(strip_tags($post['name'])));
		$value			= $this->db->escape_str((string)trim(strip_tags($post['value'])));
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Field tidak terdaftar dalam database.'
		);
		if(in_array($fieldname, $field_available)){
			$result['message'] = 'Data couldnt save';
			$is_valid = TRUE;
			if($is_valid === TRUE){
				$data[$fieldname] = $value;
				if($this->db->update('post_images', $data, " post_image_id = " . $pk)){
					unset($query);
					$result = array(
						'status'	=> 'success',
						'message'	=> 'Data has been updated'
					);
				}
			}
			unset($is_valid);
		}
		unset($field_available,$pk,$fieldname,$value);
		return $result; unset($result);
	}
}