<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("nama","location","sort","id");
		$select_total 		= "SELECT COUNT(id) AS total ";
		$select 			= "SELECT * ";
		$from 				= "FROM employment ";
		$where 				= "WHERE id > 0 ";
		$group_by 			= "GROUP BY id ";
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
			$row['actions'] = trim('
				<div class="btn-group">
					<a href="jabatan/edit/'. $row['id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" data-pk="'. $row['id'] .'">
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
		$query = $this->db->get_where('employment', array('id' => $id), 1);
		return $query->row_array();
	}
	public function sort(){
		$query = $this->db->query("SELECT sort FROM employment");

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
			'redirect'	=> NULL
		);

		if(isset($post['data']) && count($post['data']) > 0){
			$result['message'] 	= "Data failed to save.";

			if( $this->db->insert('employment', $post['data']) ){
				$result = array(
					'status'	=> 'success',
					'message'	=> 'Data has been save.',
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
			'redirect'	=> NULL
		);

		if(
			(isset($post['data']) && count($post['data']) > 0) 
			&& (isset($post['pk']) && !empty($post['pk']))

		){
			$result['message'] 	= "Data failed to save.";

			$this->db->where('id', (int)$post['pk']);
			if( $this->db->update('employment', $post['data']) ){
				$result = array(
					'status'	=> 'success',
					'message'	=> 'Data has been save.',
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
			$this->db->where('id', (int)$post['pk']);
			if( $this->db->delete('employment') ){
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
