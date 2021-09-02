<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Redaksi_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function lists(){
		$this->db->select("redaksi.photo,redaksi.fullname,employment.nama, employment.id, employment.sort,redaksi.location,redaksi.redaksi_id, redaksi.phone");
		$this->db->from("redaksi");
		$this->db->join("employment","redaksi.pos_id = employment.id", "inner");
		$this->db->order_by("employment.sort", "asc");
		$results = $this->db->get();
		$data = array();
		foreach( $results->result_array() AS $row ) {
			$row['photo']	= isset($row['photo']) && is_file(UPLOADS_FOLDER . 'redaksi' . DS . $row['photo']) ? 
				'uploads/redaksi/'. $row['photo'] :
				'uploads/no-image/author.png';
			array_push($data,$row);
		}
		$this->db->select("*");
		$this->db->from("employment");
		$this->db->where("employment.show", 1);
		$this->db->where("employment.location","pusat");
		$this->db->order_by("employment.sort", "asc");
		$j_pusat = $this->db->get()->result_array();
		
		$pusat = [];
		foreach($j_pusat as $j){
			$l_pusat = [];
			foreach($data as $d){
				if($j['id'] == $d['id'] && $d['location']=='Pusat' ){
					array_push($l_pusat, $d);
				}
			}
			if ($j['location'] == 'pusat') {
				$pusat[$j['nama']] = $l_pusat; 
			}
			unset($l_pusat);
		}
		$this->db->select("*");
		$this->db->from("employment");
		$this->db->where("employment.show",1);
		$this->db->where("employment.location","daerah");
		$j_daerah = $this->db->get()->result_array();
		$loc = [
			"Lampung Barat", 
			"Lampung Selatan", 
			"Lampung Utara", 
			"Lampung Tengah", 
			"Lampung Timur", 
			"Metro", 
			"Tanggamus", 
			"Pringsewu", 
			"Tulang Bawang", 
			"Tulang Bawang Barat",
			"Pesisir Barat",
			"Way Kanan",
			"Mesuji",
			"Pesawaran",
			"Jakarta"
		]; 
		$daerah = [];
		
		foreach($loc AS $l){
			$l_daerah =[];
			foreach($data AS $d){
				if ($l == $d['location']) {
					
					array_push($l_daerah, $d);
				}
			}
			$daerah[$l] = $l_daerah;
		}
		// echo '<pre>'; var_dump($daerah);die;
		$data['pusat'] = $pusat;
		$data['daerah'] = $daerah;
		return $data;
	}
}
