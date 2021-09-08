<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrators_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("photo","fullname","username","status","administrator_id");
		$select_total 		= "SELECT COUNT(administrator_id) AS total ";
		$select 			= "SELECT * ";
		$from 				= "FROM administrators ";
		$where 				= "WHERE administrator_id > 0 ";
		$group_by 			= "GROUP BY administrator_id ";
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
			$image = isset($row['photo']) && is_file(UPLOADS_FOLDER . 'administrators' . DS . $row['photo']) ? 
                            '../uploads/administrators/'. $row['photo'] :   
                            '../assets/backend/media/avatars/avatar.jpg';

			$row['image'] = '<img src="'. $image .'" style="max-height:50px; max-width:50px;">';
			$row['status'] = ucfirst($row['status']);
			$row['actions'] = trim('
				<div class="btn-group">
					<a href="administrators/edit/'. $row['administrator_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
					<button type="button" class="btn-reset btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalreset" data-pk="'. $row['administrator_id'] .'">
					<i class="fas fa-fw fa-key"></i>
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Reset" data-pk="'. $row['administrator_id'] .'">
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
		$query = $this->db->get_where('administrators', array('administrator_id' => $id), 1);
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

				$folder 	= UPLOADS_FOLDER . 'administrators' . DS;
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
			$post['data']['password'] = password_hash($post['data']['username'], PASSWORD_DEFAULT);
			if( $this->db->insert('administrators', $post['data']) ){
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

			if(	isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name']) ){

				$folder 	= UPLOADS_FOLDER . 'administrators' . DS;
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
					$old_photo = UPLOADS_FOLDER . 'administrators' . DS . $old_data['photo'];
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

			$this->db->where('administrator_id', (int)$post['pk']);
			if( $this->db->update('administrators', $post['data']) ){
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
			$this->db->where('administrator_id', (int)$post['pk']);
			if( $this->db->delete('administrators') ){
				$old_photo = UPLOADS_FOLDER . 'administrators' . DS . $old_data['photo'];
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
	public function check_username($username, $pk_except = 0){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'User not found',
			'redirect'	=> ''
		);

		if(!empty($username)){
			$pk_except 	= $this->db->escape_str($this->security->xss_clean((int)$pk_except));
			$slug 		= $this->db->escape_str($this->security->xss_clean(slug(trim($username))));
			$sql 		= "SELECT administrator_id FROM administrators WHERE username = ? AND administrator_id!=? ;";
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
	public function reset_password($post){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Reset password failed',
			'redirect'	=> ''
		);
		if(isset($post) && count($post) > 0){
			$result['message'] 	= "Reset password failed.";
			$sql 		= "SELECT username FROM administrators WHERE administrator_id =? ;";
			$query 		= $this->db->query($sql, array((int)$post['pk']));
			
			$data = array(
				'password' => password_hash(trim($query->row()->username), PASSWORD_DEFAULT)
			);
			$this->db->where('administrator_id', (int)$post['pk']);
			if( $this->db->update('administrators', $data) ){
				$result = array(
					'status'	=> 'success',
					'message'	=> 'Password has been reset.',
					'redirect'	=> isset($post['redirect']) ? $post['redirect'] : ''
				);
			}
			unset($data);
		}
		return $result;
		unset($data,$sql,$query,$result);
	}
	public function update_password($post){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Failed update password',
			'redirect'	=> ''
		);

		if((isset($post['data']) && count($post['data']) > 0) 
		&& (isset($post['pk']) && !empty($post['pk']))){
			$pk 		= $post['pk'];
			$password	= $post['data']['password'];
			$newpassword = $post['data']['newpassword'];
			$sql 		= "SELECT * FROM administrators WHERE administrator_id = ?;";
			$query 		= $this->db->query($sql, array($pk));

			$result['message']	= 'Failed update password';
			if($query->num_rows() > 0){
				$user = $query->row();
				$query->free_result();
				unset($query, $username);
				$result['message']	= 'Your old password doesn\'t match.';
				if(password_verify($password, $user->password)){
					$data = array(
						'password' => password_hash(trim($newpassword), PASSWORD_DEFAULT)
					);
					$this->db->where('administrator_id', (int)$post['pk']);
					if( $this->db->update('administrators', $data)){
						$result = array(
							'status'	=> 'success',
							'message'	=> 'Password has been update.',
							'redirect'	=> isset($post['redirect']) ? $post['redirect'] : ''
						);
					}
					unset($user, $data);
				}
				
			}
		}
		return $result;
		unset($result);
	}
}