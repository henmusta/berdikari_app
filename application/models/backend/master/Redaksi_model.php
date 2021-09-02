<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Redaksi_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("redaksi.photo","redaksi.fullname","employment.nama", "redaksi.location","redaksi.redaksi_id");
		$select_total 		= "SELECT COUNT(redaksi_id) AS total ";
		$select 			= "SELECT *, redaksi.location AS loc ";
		$from 				= "FROM redaksi1 ";
		$join				= "LEFT JOIN employment ON redaksi.pos_id =  employment.id ";
		$where 				= "WHERE redaksi_id > 0 ";
		$group_by 			= "GROUP BY redaksi_id ";
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

		$sql_total_data 	= $select_total . $from . $join . ";";
		$sql_total_filtered = $select_total . $from . $join . $where . $having . ";";
		$sql_data 			= $select . $from . $join . $where . $having . $order_by . $limit . ";";

		$totalData 		= $this->db->query($sql_total_data);
		$totalFiltered 	= $this->db->query($sql_total_filtered);
		$results 		= $this->db->query($sql_data);

		$data = array();

		foreach($results->result_array() AS $row){
			$image = isset($row['photo']) && is_file(UPLOADS_FOLDER . 'redaksi' . DS . $row['photo']) ? 
                            '../uploads/redaksi/'. $row['photo'] :   
                            '../assets/backend/media/avatars/avatar.jpg';

			$row['image'] = '<img src="'. $image .'" style="max-height:50px; max-width:50px;">';
			$row['actions'] = trim('
				<div class="btn-group">
					<a href="redaksi/edit/'. $row['redaksi_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" data-pk="'. $row['redaksi_id'] .'">
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
		$this->db->select("redaksi.photo,redaksi.fullname,employment.nama, employment.id, redaksi.location,redaksi.redaksi_id, redaksi.phone");
		$this->db->from("redaksi");
		$this->db->join("employment","redaksi.pos_id = employment.id", "left");
		$this->db->where("redaksi.redaksi_id", $id);
		return $this->db->get()->row_array();
	}
	public function sort(){
		$query = $this->db->query("SELECT sort FROM redaksi");

		$result = array();
		foreach($query->result_array() AS $key => $val):
			$result[$key] = $val['sort'];
		endforeach;
		return $result;
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

				$folder 	= UPLOADS_FOLDER . 'redaksi' . DS;
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
						'allowed_types' => 'jpg|png|jpeg',
						'max_size'		=> 400,
						'max_width'		=> 1200, 
						'max_height'	=> 1200
					)
				);

				if ($this->upload->do_upload('photo')){
					$image = $this->upload->data();
					$this->load->library('image_lib', array(
						'image_library' => 'gd2',
						'source_image'	=> $image['full_path'],
						'width'			=> 320,
						'height'		=> 370
					));					
					
					$post['data']['photo'] = $image['file_name'];
					if(!$this->image_lib->resize()){
						$result['upload_messages'] = $this->image_lib->display_errors();
					}
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}

			}

			if( $this->db->insert('redaksi', $post['data']) ){
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

				$folder 	= UPLOADS_FOLDER . 'redaksi' . DS;
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
						'max_size'		=> 400,
						'max_width'		=> 1200, 
						'max_height'	=> 1200
					)
				);

				if ($this->upload->do_upload('photo')){
					$old_data = $this->single((int)$post['pk']);
					$old_photo = UPLOADS_FOLDER . 'redaksi' . DS . $old_data['photo'];
					if( is_file($old_photo) ){
						unlink($old_photo);
					}

					$image = $this->upload->data();
					$this->load->library('image_lib', array(
						'image_library' => 'gd2',
						'source_image'	=> $image['full_path'],
						'width'			=> 320,
						'height'		=> 370
					));					
					$post['data']['photo'] = $image['file_name'];
					if(!$this->image_lib->resize()){
						$result['upload_messages'] = $this->image_lib->display_errors();
					}
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}

			}

			$this->db->where('redaksi_id', (int)$post['pk']);
			if( $this->db->update('redaksi', $post['data']) ){
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
			$this->db->where('redaksi_id', (int)$post['pk']);
			if( $this->db->delete('redaksi') ){
				$old_photo = UPLOADS_FOLDER . 'redaksi' . DS . $old_data['photo'];
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
	public function select2_position($filter){
		$row_per_page 	= 10;
		$select_total 	= "SELECT COUNT(id) AS total ";
		$select_data	= "SELECT id AS id, nama AS text ";
		$from 			= "FROM employment ";
		$where 			= NULL;
		if(isset($filter['q']) && !empty($filter['q'])){
			$q = $this->db->escape_str($filter['q']);
			$where = "WHERE nama ILIKE '%". $filter['q'] ."%' ";
		}
		$order_by		= "ORDER BY nama ASC";

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
}
