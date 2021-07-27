<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Redaksi_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function lists(){
	    $this->db->order_by('sort', 'ASC');
		$results = $this->db->get('redaksi');
		$data = array();
		foreach( $results->result_array() AS $row ) {
			$row['photo']	= isset($row['photo']) && is_file(UPLOADS_FOLDER . 'redaksi' . DS . $row['photo']) ? 
				'uploads/redaksi/'. $row['photo'] :
				'uploads/no-image/author.png';
			array_push($data,$row);
		}
		return $data;
	}
}