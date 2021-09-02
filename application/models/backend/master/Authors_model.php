<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("photo","fullname","author_id");
		$select_total 		= "SELECT COUNT(author_id) AS total ";
		$select 			= "SELECT * ";
		$from 				= "FROM authors ";
		$where 				= "WHERE author_id > 0 ";
		$group_by 			= "GROUP BY author_id ";
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

		$sql_total_data 	= $select_total . $from . ";";
		$sql_total_filtered = $select_total . $from . $where . $having . ";";
		$sql_data 			= $select . $from . $where . $group_by . $having . $order_by . $limit . ";";

		$totalData 		= $this->db->query($sql_total_data);
		$totalFiltered 	= $this->db->query($sql_total_filtered);
		$results 		= $this->db->query($sql_data);

		$data = array();

		foreach($results->result_array() AS $row){
			$image = isset($row['photo']) && is_file(UPLOADS_FOLDER . 'authors' . DS . $row['photo']) ? 
                            '../uploads/authors/'. $row['photo'] :   
                            '../assets/backend/media/avatars/avatar.jpg';

			$row['image'] = '<img src="'. $image .'" style="max-height:50px; max-width:50px;">';
			$row['actions'] = trim('
				<div class="btn-group">
					<a href="authors/edit/'. $row['author_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" data-pk="'. $row['author_id'] .'">
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
			"data"				=> $data,
			"query"				=> array(
				$sql_total_data, $sql_total_filtered, $sql_data
			)
		);
	}
	public function single($id){
		$query = $this->db->get_where('authors', array('author_id' => $id), 1);
		return $query->row_array();
	}
	public function insert($post){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);

		if(isset($post['data']) && count($post['data']) > 0){
			$result['message'] 	= "Data failed to save.";

			if(	isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name']) ){

				$folder 	= UPLOADS_FOLDER . 'authors' . DS;
				$rename_to 	= strtolower(
					substr(
						preg_replace('!\s+!',' ', trim($post['data']['fullname']))
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
						'max_size'		=> 100,
						'max_width'		=> 1024, 
						'max_height'	=> 1024
					)
				);

				if ($this->upload->do_upload('photo')){
					$image = $this->upload->data();
					$this->load->library('image_lib', array(
						'image_library' => 'gd2',
						'source_image'	=> $image['full_path'],
						'width'			=> 150,
						'height'		=> 150
					));					
					
					$post['data']['photo'] = $image['file_name'];
					if(!$this->image_lib->resize()){
						$result['upload_messages'] = $this->image_lib->display_errors();
					}
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}

			}

			$post['data']['slug'] = slug($post['data']['fullname']);

			if( $this->db->insert('authors', $post['data']) ){
				$result = array(
					'status'	=> 'success',
					'message'	=> 'Data has been save.',
					'upload_messages'	=> $result['upload_messages'],
					'redirect'	=> isset($post['redirect']) ? $post['redirect'] : ''
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

			if(	isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name']) ){

				$folder 	= UPLOADS_FOLDER . 'authors' . DS;
				$rename_to 	= strtolower(
					substr(
						preg_replace('!\s+!',' ', trim($post['data']['fullname']))
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
						'max_size'		=> 100,
						'max_width'		=> 1024, 
						'max_height'	=> 1024
					)
				);

				if ($this->upload->do_upload('photo')){

					$old_data = $this->single((int)$post['pk']);
					$old_photo = UPLOADS_FOLDER . 'authors' . DS . $old_data['photo'];
					if( is_file($old_photo) ){
						unlink($old_photo);
					}

					$image = $this->upload->data();
					$this->load->library('image_lib', array(
						'image_library' => 'gd2',
						'source_image'	=> $image['full_path'],
						'width'			=> 150,
						'height'		=> 150
					));					
					$post['data']['photo'] = $image['file_name'];
					if(!$this->image_lib->resize()){
						$result['upload_messages'] = $this->image_lib->display_errors();
					}
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}

			}

			$post['data']['slug'] = slug($post['data']['fullname']);

			$this->db->where('author_id', (int)$post['pk']);
			if( $this->db->update('authors', $post['data']) ){
				$result = array(
					'status'	=> 'success',
					'message'	=> 'Data has been save.',
					'upload_messages'	=> $result['upload_messages'],
					'redirect'	=> isset($post['redirect']) ? $post['redirect'] : ''
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
			$old_data = $this->single((int)$post['pk']);
			$this->db->where('author_id', (int)$post['pk']);
			if( $this->db->delete('authors') ){
				$old_photo = UPLOADS_FOLDER . 'authors' . DS . $old_data['photo'];
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
}