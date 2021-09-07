<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('kt_string_helper');
	}
	public function update($post){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'upload_messages'	=> NULL,
			'redirect'	=> NULL
		);

		if(
			(isset($post) && count($post) > 0) 
			&& (isset($post['pk']) && !empty($post['pk']))

		){
            $result['message'] 	= "Data failed to save.";
            $data['value']      = $post['value'];

			$this->db->where('setting_id', (int)$post['pk']);
			if( $this->db->update('settings', $data) ){
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
    public function update_logo(){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'redirect'	=> NULL
		);

        if(	isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']) ){
			$old_data = $this->db->query("SELECT * FROM settings where keyword = 'logo_image'")->row();
			$old_photo = UPLOADS_FOLDER . DS . $old_data->value;
			if( is_file($old_photo) ){
				unlink($old_photo);
			}
			$result = array(
				'status'	=> 'success',
				'message'	=> 'Data has been deleted.',
				'redirect'	=> ''
			);
			

            $folder 	= UPLOADS_FOLDER . DS;
            $rename_to 	= 'logo';


            $this->load->library('upload', 
                array(
                    'upload_path' 	=> $folder,
                    'file_name'		=> $rename_to,
                    'allowed_types' => 'jpg|png',
                    'max_size'		=> 2000,
                    'max_width'		=> 1000, 
                    'max_height'	=> 1000
                )
            );

            if ($this->upload->do_upload('file')){
                $image = $this->upload->data();
                $reimage = $this->create_image(	
                    $image['full_path'], 
                    $image['full_path'],
                    264,41
                );
                $result['upload_messages']  = ($reimage !== TRUE) ? $reimage : '';
				$data['value']              = $image['file_name'];
				$this->db->where('keyword', 'logo_image');
				if( $this->db->update('settings', $data) ){
					$result = array(
						'status'	=> 'success',
						'message'	=> 'Data has been save.',
						'upload_messages'	=> $result['upload_messages'],
						'redirect'	=> ''
					);
				}
				unset($data);
            } else {
                $result['upload_messages']  = $this->upload->display_errors();
            }
			
        }

        return $result;
		unset($result);
	}
    public function update_favicon(){
		$result = array(
			'status'	=> 'error',
			'message'	=> 'Please complete the form field requirements.',
			'redirect'	=> NULL
		);

        if(	isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']) ){
			$old_data = $this->db->query("SELECT * FROM settings where keyword = 'favicon_image'")->row();
			$old_photo = UPLOADS_FOLDER . 'favicon' . DS . $old_data->value;
			if( is_file($old_photo) ){
				unlink($old_photo);
			}
			$result = array(
				'status'	=> 'success',
				'message'	=> 'Data has been deleted.',
				'redirect'	=> ''
			);

            $folder 	= UPLOADS_FOLDER . 'favicon' . DS;
			$rename_to 	= 'favicon';
			
            $this->load->library('upload', 
                array(
                    'upload_path' 	=> $folder,
                    'file_name'		=> $rename_to,
                    'allowed_types' => 'jpg|png',
                    'max_size'		=> 2000,
                    'max_width'		=> 300, 
                    'max_height'	=> 300
                )
			);
			
            if ($this->upload->do_upload('file')){
				$image = $this->upload->data();
				
                $reimage = $this->create_image(	
                    $image['full_path'], 
                    $image['full_path'],
                    300, 300
				);
				
                $result['upload_messages']  = ($reimage !== TRUE) ? $reimage : '';
				$data['value']              = $image['file_name'];
				$this->db->where('keyword', 'favicon_image');
				if( $this->db->update('settings', $data) ){
					$this->create_favicon();
					$result = array(
						'status'	=> 'success',
						'message'	=> 'Data has been save.',
						'upload_messages'	=> $result['upload_messages'],
						'redirect'	=> ''
					);
				}
				unset($data);
            } else {
                $result['upload_messages']  = $this->upload->display_errors();
            }
        }
        return $result;
		unset($result);
	}
    public function data_settings(){
		$result = $this->db->query("SELECT * FROM settings ORDER BY setting_id ASC")->result_array();
		return $result;
	}
	public function create_image($source, $destination, $width = 300, $height = 300){
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
	public function create_favicon(){
		$sizes 		= array(228,192,180,152,128,96,76,57,64,32,16);
		$favicon 	= UPLOADS_FOLDER . 'favicon/favicon.png';
		$extension 	= pathinfo($favicon,PATHINFO_EXTENSION);
		$this->load->library('image_lib');
		foreach($sizes AS $size){
			$init = array(
				'image_library' 	=> 'gd2',
				'source_image' 		=> $favicon,
				'new_image' 		=> UPLOADS_FOLDER . 'favicon' . DS . 'favicon-' . $size . '.' . $extension,
				'maintain_ratio'	=> TRUE,
				'width' 			=> $size,
				'height' 			=> $size
			);
			$this->image_lib->initialize($init);
			if(!$this->image_lib->resize()){
				return $this->image_lib->display_errors();
			}
			$this->image_lib->clear();
		}
	}
}