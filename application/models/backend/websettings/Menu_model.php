<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function autocomplete(){
		$q = $_POST['q'];
		$html = "";
		if($q !== ""){
			$query = "
				WITH RECURSIVE news_categories (category_id, level, title, url, slug) AS (
					SELECT 	category_id, 0, title, ARRAY[slug], slug
					FROM 	categories
					WHERE 	parent_id=0 OR parent_id is null
					UNION ALL
					SELECT 	p.category_id, t0.level + 1, p.title, ARRAY_APPEND(t0.url, p.slug), p.slug
					FROM 	categories p
						INNER JOIN news_categories t0 ON t0.category_id = p.parent_id
				)
				SELECT 
					title, 
					ARRAY_TO_STRING(url, '/'), 
					'News Categories' AS type,
					ts_rank(
						to_tsvector('english', title) , 
						to_tsquery('english', '". $q ."')
					) AS score
				FROM news_categories  
				WHERE title ILIKE '%". $q ."%' 
				UNION
				SELECT 
					title, 
					'page/' || slug AS url , 
					'Page' AS type,
					ts_rank(
						to_tsvector('english', title) , 
						to_tsquery('english', '". $q ."')
					) AS score
				FROM posts
				WHERE module='page' AND status='publish' AND title ILIKE '%". $q ."%' 
				ORDER BY score DESC
				LIMIT 10
			";


			foreach($this->db->query($query)->result_array() AS $val){
				$html .= '
				<div class="link-item" data-href="'. $val['array_to_string'] .'">
					<strong>'. ucwords($val['title']) .'</strong>
					<small>'. ucwords($val['type']) .'</small>
				</div>';
			}
		}
		return $html;
	}
	public function single($id){
		$id = $this->db->escape_str((int)$id);
		$result = $this->db->query("SELECT * FROM menu WHERE menu_id='". $id ."'")->row_array();
		return $result;
	}
	public function show_nestable_menu($menu_type, $parent_id = 0){
        $menu_type = $this->db->escape_str($menu_type);
        $parent_id = $this->db->escape_str($parent_id);
		$query = "SELECT * FROM menu WHERE menu_type='".$menu_type."' AND parent_id='". $parent_id ."' ORDER BY sort ASC";
		$data = $this->db->query($query);
		$html = "";
		$edit = "";
		$menu_type == 'top-menu' ? $edit = 'edit': $edit = 'edit-footer';

		if( $data->num_rows() > 0 ){
			$html .= '<ol class="dd-list">';
			foreach ($data->result_array() AS $val):
			$html .= '<li class="dd-item dd3-item" data-id="'. $val['menu_id'] .'">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content">'. $val['title'] .'</div>
						<div class="dd3-actions">
							<div class="btn-group">
								<a href="menu/'.$edit.'/'. $val['menu_id'] .'" class="btn btn-sm btn-info" 
									><i class="fa fa-fw fa-edit"></i>
								</a>
								<button 
									type="button" 
									class="btn-ajax btn btn-sm btn-danger" 
									data-id="' . $val['menu_id'] . '" 
									data-action="menu/delete-item"
									><i class="fa fa-fw fa-trash"></i>
								</button>
							</div>
						</div>
					';
			$html .= $this->show_nestable_menu($menu_type,$val['menu_id']);
			$html .= '</li>';
			endforeach;
			$html .= '</ol>';
		}
		return $html;
	}
	public function add_item($post){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);
		$data = $post['menu'];
		$data['sort'] = $this->db->query("SELECT * FROM menu WHERE menu_type='". $post['menu']['menu_type'] ."';")->num_rows() + 1;
		if(isset($data)  && count($data) > 0){
			if( $this->db->insert('menu', $data) ){
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
	}
	public function edit_item($post){

		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);

		if(
			(isset($post['menu']) && count($post['menu']) > 0) 
			&& (isset($post['pk']) && !empty($post['pk']))

		){
			$result['message'] 	= "Data failed to save.";

			$this->db->where('menu_id', (int)$post['pk']);
			if( $this->db->update('menu', $post['menu']) ){
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
	public function delete_item(){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Cannot complete action.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);
		$id = $this->db->escape_str($_POST['id']);
		if(isset($id)) {
			$olddata 	= $this->db->query("SELECT * FROM menu WHERE menu_id='". $id ."'")->row();
			$delete 	= $this->db->delete("menu","menu_id='". $id ."'");
			if(isset($delete) && $delete == TRUE){
				$result = array(
					'status'	=> 'error',
					'message'	=> 'Cannot complete action.',
					'upload_messages'	=> NULL,
					'redirect'	=> NULL
				);
				$query = $this->db->query("SELECT menu_id FROM menu WHERE parent_id='". $olddata->parent_id ."'");
				$no_urut = $query->num_rows();
				$querymulti = "
				UPDATE menu 
					SET sort=sort- 1 
				WHERE 
					parent_id='". $olddata->parent_id ."' AND 
					sort > '". $olddata->sort ."';
				UPDATE menu 
					SET sort=sort+". $no_urut .",
						parent_id='". $olddata->parent_id ."' 
				WHERE parent_id='". $olddata->menu_id ."';
				";
				$this->db->query($querymulti);
				$result = array(
					'status'			=> 'success',
					'message'			=> 'Data has been save.',
					'upload_messages'	=> $result['upload_messages'],
					'redirect'			=> ''
				);
				unset($query, $querymulti);
			}
		}
		return $result;
	}
	public function render_menu_hierarchy($data = array(), $parentMenu = 0, $result = array()){
		foreach($data AS $key => $val){
			$row['menu_id'] = $val['id'];
			$row['parent_id'] = $parentMenu;
			$row['sort'] = ($key + 1);
			array_push($result,$row);
			if(isset($val['children']) && $val['children'] > 0){
				$result = array_merge($result,$this->render_menu_hierarchy($val['children'], $val['id']));
			}
		}
		return $result;
	}
	public function change_hierarchy(){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Cannot complete action.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);

		$data 					= json_decode($_POST['hierarchy'],TRUE);
		$items 					= $this->render_menu_hierarchy($data);
		$query = "";
		if($items > 0){
			foreach($items AS $val){
				$query .= "
				UPDATE menu 
					SET 
						parent_id='". $val['parent_id'] ."',
						sort='". $val['sort'] ."'
				WHERE menu_id='". $val['menu_id'] ."'
				;";
				$this->db->query($query);
			}
			
			$result = array(
				'status'			=> 'success',
				'message'			=> 'Data has been save.',
				'upload_messages'	=> NULL,
				'redirect'			=> ''
			);
		}
		return $result;
	}
}