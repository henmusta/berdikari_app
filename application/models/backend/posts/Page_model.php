<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("p.title","p.status","p.date_publish","p.post_id");
		$sql_total_data 	= "SELECT COUNT(DISTINCT post_id) AS total FROM posts WHERE module='page';";
		$select 			= "
		SELECT 
			p.post_id AS post_id,
			p.slug AS slug,
			p.title AS title,
			p.status AS status,
			p.date_publish AS date_publish
		";
		$from 				= "
		FROM posts p
		
		";
		$where 				= "WHERE p.module='page' ";
		$group_by 			= "GROUP BY p.post_id ";
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

		$sql_total_filtered =  " SELECT COUNT(DISTINCT p.post_id) AS total " . $from . $where . $having . ";";
		$sql_data 			=  $select . $from . $where . $group_by . $having . $order_by . $limit . ";";

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
					<a href="page/edit/'. $row['post_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
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
	public function single($id){
		$id = (int)$id;
		$sql = "
		SELECT 
			p.*
		FROM posts p
		WHERE p.post_id=". $id ."
		";
		$result = $this->db->query($sql)->row_array();

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
			$post['data']['module']				= 'page';
			$post['data']['media_type']			= 'image';
			$post['data']['slug']				= trim(slug($post['data']['title']));
			$post['data']['date_create']		= date('Y-m-d H:i');
			$post['data']['date_modified']		= date('Y-m-d H:i');
			$post['data']['synopsis']			= empty($post['data']['synopsis']) ? trim(kt_synopsis($post['data']['content'])) : $post['data']['synopsis'];

			if( $this->db->insert('posts', $post['data']) ){
                $result = array(
					'status'			=> 'success',
					'message'			=> 'Data has been save.',
					'upload_messages'	=> $result['upload_messages'],
					'redirect'			=> isset($post['redirect']) ? $post['redirect'] : ''
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

			$this->db->where('post_id', (int)$post['pk']);
			if( $this->db->update('posts', $post['data']) ){
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
			$this->db->where('post_id', (int)$post['pk']);
			if( $this->db->delete('posts') ){
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
}