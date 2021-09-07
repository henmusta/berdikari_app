<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_count_model extends CI_Model {
    public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
    }
    
	public function insert($post){
		if( isset($post['type']) && isset($post['pk']) ){
            $post_id    = $this->db->escape_str((int)$this->security->xss_clean($post['pk']));
            $type       = $this->db->escape_str($this->security->xss_clean($post['type']));
            $this->db->where('post_id',$post_id);
            $ck_pc = $this->db->get('post_count');
            if($ck_pc->num_rows()>0){
                $ck_pc_row = $ck_pc->row();
                $count = $ck_pc_row->$type;
                $this->db->where('post_id',$post_id);
                $this->db->update('post_count',[$type=>$count+1]);
            }else{
                $this->db->insert('post_count',['post_id'=>$post_id,$type=>1]);
            }
            return TRUE;
            /*
            $query = "
            INSERT INTO post_count (post_id, ".$type.") 
                VALUES (".$post_id.", 1)
                ON CONFLICT (post_id) 
            DO UPDATE 
                SET ".$type." = ".$type." + 1 
            ";
            if($this->db->query($query)){
                return TRUE;
            }
            echo $this->db->last_query();
            */
			unset($ck_pc);
			
		}
		return FALSE;
	}
}