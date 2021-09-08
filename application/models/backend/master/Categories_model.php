<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function datatables($request){
		$columns 			= array("path","category_id");

		$with 				= "
		WITH RECURSIVE news_categories (category_id, level, title, path) AS (
		   SELECT  category_id, 0, title, ARRAY[title]
		   FROM    categories
		   WHERE   parent_id=0 OR parent_id is null

		   UNION ALL

		   SELECT  p.category_id, t0.level + 1, p.title, ARRAY_APPEND(t0.path, p.title)
		   FROM    categories p
		      INNER JOIN news_categories t0 ON t0.category_id = p.parent_id
		)
		";
		$select_total 		= "SELECT COUNT(category_id) AS total ";
		$select 			= "SELECT category_id, level, title , ARRAY_TO_STRING(path, ' > ') AS path ";
		$from 				= "FROM news_categories ";
		$where 				= "WHERE category_id > 0 ";
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

		$sql_total_data 	= $with . $select_total . $from . ";";
		$sql_total_filtered = $with . $select_total . $from . $where . $having . ";";
		$sql_data 			= $with . $select . $from . $where . $having . $order_by . $limit . ";";

		$totalData 		= $this->db->query($sql_total_data);
		$totalFiltered 	= $this->db->query($sql_total_filtered);
		$results 		= $this->db->query($sql_data);

		$data = array();

		foreach($results->result_array() AS $row){
			$row['actions'] = trim('
				<div class="btn-group">
					<a href="categories/edit/'. $row['category_id'] .'" class="btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
					<i class="fas fa-fw fa-pencil-alt"></i>
					</a>
					<button type="button" class="btn-delete btn btn-sm btn-outline-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" data-pk="'. $row['category_id'] .'">
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
	public function single($id = 0){
		$id = (int)$id;
		$sql = "
		SELECT c.*, p.title AS parent_title
		FROM categories c
			LEFT JOIN categories p ON p.category_id=c.parent_id
		WHERE c.category_id=". $id ."
		";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function insert($post){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'redirect'	=> NULL
		);

		if(isset($post['data']) && count($post['data']) > 0){
			$result['message'] 	= "Data failed to save.";

			$post['data']['slug'] = slug($post['data']['title']);

			if( $this->db->insert('categories', $post['data']) ){
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

			$this->db->where('category_id', (int)$post['pk']);
			if( $this->db->update('categories', $post['data']) ){
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
			$this->db->where('category_id', (int)$post['pk']);
			if( $this->db->delete('categories') ){
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
	public function select2_parent($filter){
		$row_per_page 	= 10;

		$with = "
		WITH RECURSIVE news_categories (category_id, level, title, path, parent_id) AS (
		   SELECT  category_id, 0, title, ARRAY[title], parent_id
		   FROM    categories
		   WHERE   parent_id=0 OR parent_id is null

		   UNION ALL

		   SELECT  p.category_id, t0.level + 1, p.title, ARRAY_APPEND(t0.path, p.title), p.parent_id
		   FROM    categories p
		      INNER JOIN news_categories t0 ON t0.category_id = p.parent_id
		)
		";
		$select_total 	= "SELECT COUNT(category_id) AS total ";
		$select_data	= "SELECT category_id AS id, ARRAY_TO_STRING(path, ' > ') AS text ";
		$from 			= "FROM news_categories ";
		$where 			= "WHERE parent_id=0 OR parent_id is null ";
		if(isset($filter['q']) && !empty($filter['q'])){
			$q = $this->db->escape_str($filter['q']);
			$where .= " AND title ILIKE '%". $filter['q'] ."%' ";
		}

		$result_total	= $this->db->query($with . $select_total . $from . $where . ";");
		$total_data 	= $result_total->row()->total;
		$total_page		= ceil((int)$total_data/$row_per_page);
		$page 			= isset($filter['page']) ? (int)$filter['page'] : 1;
		$offset 		= (($page - 1) * $row_per_page);

		$result_total->free_result();

		$data = $this->db->query($with . $select_data . $from . $where . "LIMIT ". $row_per_page ." OFFSET ". $offset .";");
		return array( 
			'results' 		=> $data->result_array(),
			'pagination' 	=> array('more' => ($page < $total_page)) 
		);
		$data->free_result();
	}
}