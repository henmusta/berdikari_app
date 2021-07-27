<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertising_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("ads_id","title","type","ads_id");
		$select_total 		= "SELECT COUNT(ads_id) AS total ";
		$select 			= "SELECT * ";
		$from 				= "FROM ads ";
		$where 				= "WHERE ads_id > 0 ";
		$group_by 			= "GROUP BY ads_id ";
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
		$sql_data 			= $select . $from . $where . $having . $order_by . $limit . ";";

		$totalData 		= $this->db->query($sql_total_data);
		$totalFiltered 	= $this->db->query($sql_total_filtered);
		$results 		= $this->db->query($sql_data);

		$data = array();

		foreach($results->result_array() AS $row){
			$image = isset($row['value']) && is_file(UPLOADS_FOLDER . 'banner' . DS . $row['value']) ? 
                            '../uploads/banner/'. $row['value'] :   
                            '../assets/backend/media/avatars/avatar.jpg';

			$row['image'] 	= '<img src="'. $image .'" style="max-height:50px; max-width:50px;">';
			$row['value']	= strip_tags($row['value']);
			$row['type']	= ucfirst($row['type']);
			$row['actions'] = trim('
				<div class="btn-group">
					<a href="advertising/edit/'. $row['ads_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
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
		$query = $this->db->get_where('ads', array('ads_id' => $id), 1);
		return $query->row_array();
	}
	public function update($post){
		$data = $_POST['data'];

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
				$folder 	= UPLOADS_FOLDER . 'banner' . DS;
				$rename_to 	= strtolower(
					substr(
						preg_replace('!\s+!',' ', trim($post['data']['title']))
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
						'max_width'		=> 3000, 
						'max_height'	=> 3000
					)
				);

				if ($this->upload->do_upload('photo')){

					$old_data = $this->single((int)$post['pk']);
					$old_photo = UPLOADS_FOLDER . 'banner' . DS . $old_data['value'];
					if( is_file($old_photo) ){
						unlink($old_photo);
					}

					$image = $this->upload->data();
					$header = array('header', 'home_content', 'detail_content');
					// if (in_array($old_data['position'], $header)){
					// 	$reimage = $this->create_image(	
					// 		$image['full_path'], 
					// 		$image['full_path'],
					// 		728,90
					// 	);
					// }else{
					// 	$reimage = $this->create_image(	
					// 		$image['full_path'], 
					// 		$image['full_path'],
					// 		300,250
					// 	);
					// }
					$result['upload_messages'] = isset($reimage) && ($reimage !== TRUE) ? $reimage : '';
					$data['value'] = $image['file_name'];
				} else {
					$result['upload_messages'] = $this->upload->display_errors();
				}
			}

			// isset($data['target']) && $data['target'] ? $data['target'] : $data['target'] = '_self';
			// if($data['type'] == 'script'){
			// 	$data['target'] = NULL;
			// 	$data['permalink'] = NULL;
			// }

			$this->db->where('ads_id', (int)$post['pk']);
			if( $this->db->update('ads', $data) ){
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

	public function create_image($source, $destination, $width = 1000, $height = 1000){
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

}